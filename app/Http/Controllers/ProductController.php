<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Products listing page.
     */
    public function index(): View
    {
        return view('pages.products');
    }
    /**
     * Product detail page.
     */
    public function show(string $id, ?string $slug = null): View
    {
        $product = \App\Models\Product::visibleInStore()->findOrFail($id);
        
        // Suggested products: Same category, excluding current
        $suggested = \App\Models\Product::where('category', $product->category)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();
            
        // If not enough suggested, fill with random others
        if ($suggested->count() < 4) {
             $more = \App\Models\Product::active()
                ->where('id', '!=', $id)
                ->whereNotIn('id', $suggested->pluck('id'))
                ->inRandomOrder()
                ->limit(4 - $suggested->count())
                ->get();
             $suggested = $suggested->merge($more);
        }

        // Frequently bought together: Random active products for now (mock logic)
        $frequentlyBought = \App\Models\Product::active()
            ->where('id', '!=', $id)
            ->whereNotIn('id', $suggested->pluck('id'))
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('pages.product_detail', compact('product', 'suggested', 'frequentlyBought'));
    }
}
