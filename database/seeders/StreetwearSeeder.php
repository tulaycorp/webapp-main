<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class StreetwearSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing products
        Product::query()->delete();
        Category::query()->delete();

        // Create categories
        $hoodies = Category::create([
            'name' => 'Hoodies',
            'slug' => 'hoodies',
            'description' => 'Premium heavyweight hoodies for the streets',
            'image_url' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&q=80',
            'sort_order' => 1,
        ]);

        $tshirts = Category::create([
            'name' => 'T-Shirts',
            'slug' => 't-shirts',
            'description' => 'Essential streetwear tees with bold graphics',
            'image_url' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&q=80',
            'sort_order' => 2,
        ]);

        $bottoms = Category::create([
            'name' => 'Bottoms',
            'slug' => 'bottoms',
            'description' => 'Joggers, cargo pants, and streetwear bottoms',
            'image_url' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80',
            'sort_order' => 3,
        ]);

        $outerwear = Category::create([
            'name' => 'Outerwear',
            'slug' => 'outerwear',
            'description' => 'Jackets, bombers, and layering pieces',
            'image_url' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=800&q=80',
            'sort_order' => 4,
        ]);

        $accessories = Category::create([
            'name' => 'Accessories',
            'slug' => 'accessories',
            'description' => 'Caps, bags, and finishing touches',
            'image_url' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=800&q=80',
            'sort_order' => 5,
        ]);

        // Create products
        $products = [
            // Hoodies
            [
                'name' => 'Oversized Logo Hoodie',
                'description' => 'Heavyweight 400gsm cotton hoodie with embroidered chest logo and kangaroo pocket. Relaxed oversized fit.',
                'price' => 129.00,
                'compare_at_price' => 159.00,
                'category' => 'Hoodies',
                'category_id' => $hoodies->id,
                'featured' => true,
                'status' => 'active',
                'stock_quantity' => 45,
                'image_url' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&q=80',
                'tags' => 'oversized, logo, heavyweight, winter',
            ],
            [
                'name' => 'Washed Black Hoodie',
                'description' => 'Vintage washed black hoodie with distressed details. Pre-shrunk cotton blend.',
                'price' => 119.00,
                'category' => 'Hoodies',
                'category_id' => $hoodies->id,
                'featured' => false,
                'status' => 'active',
                'stock_quantity' => 32,
                'image_url' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&q=80',
                'tags' => 'vintage, washed, black',
            ],
            [
                'name' => 'Zip-Up Essential Hoodie',
                'description' => 'Clean minimal zip-up hoodie with metal hardware. Perfect for layering.',
                'price' => 99.00,
                'category' => 'Hoodies',
                'category_id' => $hoodies->id,
                'featured' => false,
                'status' => 'active',
                'stock_quantity' => 28,
                'image_url' => 'https://images.unsplash.com/photo-1578681994506-b8f463449011?w=800&q=80',
                'tags' => 'zip-up, minimal, essential',
            ],

            // T-Shirts
            [
                'name' => 'Graphic Print Tee',
                'description' => 'Oversized t-shirt with bold chest graphic. 100% combed cotton, custom fit.',
                'price' => 59.00,
                'category' => 'T-Shirts',
                'category_id' => $tshirts->id,
                'featured' => true,
                'status' => 'active',
                'stock_quantity' => 75,
                'image_url' => 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=800&q=80',
                'tags' => 'graphic, oversized, print',
            ],
            [
                'name' => 'Essential Box Logo Tee',
                'description' => 'Classic box logo t-shirt. Premium heavyweight cotton.',
                'price' => 49.00,
                'category' => 'T-Shirts',
                'category_id' => $tshirts->id,
                'featured' => false,
                'status' => 'active',
                'stock_quantity' => 120,
                'image_url' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&q=80',
                'tags' => 'essential, box logo, classic',
            ],
            [
                'name' => 'Vintage Racing Tee',
                'description' => 'Retro racing-inspired graphic tee with distressed print.',
                'price' => 55.00,
                'compare_at_price' => 69.00,
                'category' => 'T-Shirts',
                'category_id' => $tshirts->id,
                'featured' => false,
                'status' => 'active',
                'stock_quantity' => 42,
                'image_url' => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=800&q=80',
                'tags' => 'vintage, racing, retro',
            ],

            // Bottoms
            [
                'name' => 'Cargo Joggers',
                'description' => 'Utility cargo joggers with multiple pockets. Tapered fit with elastic cuffs.',
                'price' => 89.00,
                'category' => 'Bottoms',
                'category_id' => $bottoms->id,
                'featured' => true,
                'status' => 'active',
                'stock_quantity' => 38,
                'image_url' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80',
                'tags' => 'cargo, joggers, utility',
            ],
            [
                'name' => 'Wide Leg Pants',
                'description' => 'Relaxed wide leg pants with adjustable waist. Japanese cotton twill.',
                'price' => 109.00,
                'category' => 'Bottoms',
                'category_id' => $bottoms->id,
                'featured' => false,
                'status' => 'active',
                'stock_quantity' => 22,
                'image_url' => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=800&q=80',
                'tags' => 'wide leg, japanese, relaxed',
            ],

            // Outerwear
            [
                'name' => 'Bomber Jacket',
                'description' => 'Classic bomber jacket with satin finish. Ribbed collar and cuffs.',
                'price' => 179.00,
                'compare_at_price' => 219.00,
                'category' => 'Outerwear',
                'category_id' => $outerwear->id,
                'featured' => true,
                'status' => 'active',
                'stock_quantity' => 15,
                'image_url' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=800&q=80',
                'tags' => 'bomber, satin, classic',
            ],
            [
                'name' => 'Puffer Vest',
                'description' => 'Quilted puffer vest with stand collar. Lightweight warmth.',
                'price' => 139.00,
                'category' => 'Outerwear',
                'category_id' => $outerwear->id,
                'featured' => false,
                'status' => 'active',
                'stock_quantity' => 18,
                'image_url' => 'https://images.unsplash.com/photo-1544022613-e87ca75a784a?w=800&q=80',
                'tags' => 'puffer, vest, lightweight',
            ],

            // Accessories
            [
                'name' => 'Five Panel Cap',
                'description' => 'Embroidered five panel cap with adjustable strap.',
                'price' => 45.00,
                'category' => 'Accessories',
                'category_id' => $accessories->id,
                'featured' => false,
                'status' => 'active',
                'stock_quantity' => 85,
                'image_url' => 'https://images.unsplash.com/photo-1588850561407-ed78c282e89b?w=800&q=80',
                'tags' => 'cap, hat, five panel',
            ],
            [
                'name' => 'Crossbody Bag',
                'description' => 'Compact crossbody bag with multiple compartments. Water-resistant nylon.',
                'price' => 69.00,
                'category' => 'Accessories',
                'category_id' => $accessories->id,
                'featured' => false,
                'status' => 'active',
                'stock_quantity' => 52,
                'image_url' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&q=80',
                'tags' => 'bag, crossbody, nylon',
            ],
        ];

        foreach ($products as $productData) {
            Product::create($productData);
        }

        $this->command->info('Created ' . count($products) . ' streetwear products in ' . Category::count() . ' categories.');
    }
}
