<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::with('categoryRelation');
        
        // Search
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }
        
        // Filter by category (supports both category name and category_id)
        if ($categoryId = $request->get('category_id')) {
            $query->where('category_id', $categoryId);
        } elseif ($category = $request->get('category')) {
            // Support legacy string-based filtering
            $query->where('category', $category);
        }
        
        // Filter by featured
        if ($request->has('featured')) {
            $query->where('featured', $request->boolean('featured'));
        }
        
        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);
        
        // Pagination
        $perPage = min($request->get('per_page', 15), 100);
        $products = $query->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ],
        ]);
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'category' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'stock_quantity' => 'required|integer|min:0',
            'image_url' => 'nullable|url|max:500',
        ]);
        
        // Generate ID from name if not provided
        $validated['id'] = $request->get('id', Str::slug($validated['name']) . '-' . Str::random(4));
        $validated['featured'] = $validated['featured'] ?? false;
        
        // If category_id is provided, also set the category name for backward compatibility
        if (!empty($validated['category_id'])) {
            $category = Category::find($validated['category_id']);
            if ($category) {
                $validated['category'] = $category->name;
            }
        }
        
        $product = Product::create($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product->toApiArray(),
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show(string $id): JsonResponse
    {
        $product = Product::with('categoryRelation')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $product->toApiArray(),
        ]);
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'category' => 'nullable|string|max:255',
            'featured' => 'boolean',
            'stock_quantity' => 'sometimes|required|integer|min:0',
            'image_url' => 'nullable|url|max:500',
        ]);
        
        // If category_id is provided, also update the category name for backward compatibility
        if (isset($validated['category_id'])) {
            if ($validated['category_id']) {
                $category = Category::find($validated['category_id']);
                if ($category) {
                    $validated['category'] = $category->name;
                }
            } else {
                // category_id is null, clear both
                $validated['category'] = null;
            }
        }
        
        $product->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product->fresh()->load('categoryRelation')->toApiArray(),
        ]);
    }

    /**
     * Remove the specified product.
     */
    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
        ]);
    }

    /**
     * Get all categories from Category model.
     */
    public function categories(): JsonResponse
    {
        $categories = Category::active()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->map(fn($cat) => [
                'id' => $cat->id,
                'name' => $cat->name,
                'slug' => $cat->slug,
            ]);
        
        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }
}
