<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get all products or filter by category.
     */
    public function list(Request $request): JsonResponse
    {
        $category = $request->query('category', '');

        $query = Product::query();

        if (!empty($category)) {
            $query->byCategory($category)->orderBy('name');
        } else {
            $query->orderBy('category')->orderBy('name');
        }

        $products = $query->get()->map(fn($product) => $product->toApiArray());

        return response()->json([
            'success' => true,
            'products' => $products,
        ]);
    }

    /**
     * Get a single product by ID.
     */
    public function get(string $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'success' => true,
            'product' => $product->toApiArray(),
        ]);
    }

    /**
     * Get featured products.
     */
    public function featured(Request $request): JsonResponse
    {
        $limit = (int) $request->query('limit', 3);

        $products = Product::featured()
            ->orderBy('name')
            ->limit($limit)
            ->get()
            ->map(fn($product) => $product->toApiArray());

        return response()->json([
            'success' => true,
            'products' => $products,
        ]);
    }

    /**
     * Get all product categories.
     */
    public function categories(): JsonResponse
    {
        $categories = Product::distinct()
            ->orderBy('category')
            ->pluck('category');

        return response()->json([
            'success' => true,
            'categories' => $categories,
        ]);
    }
}
