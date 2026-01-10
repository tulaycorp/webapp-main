@extends('layouts.app')

@section('title', $product->name . ' - FRAMEWORK Supply Co.')

@section('content')
<div class="pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-sm font-medium text-secondary dark:text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-primary dark:hover:text-white transition-colors">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products') }}" class="hover:text-primary dark:hover:text-white transition-colors">Products</a>
            <span class="mx-2">/</span>
            <span class="text-primary dark:text-white">{{ $product->name }}</span>
        </nav>

        {{-- Main Product Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-24">
            {{-- Image Gallery --}}
            <div data-animate="fade-in" class="relative aspect-square bg-gray-100 dark:bg-gray-800 rounded-lg overflow-hidden">
                <img src="{{ $product->img }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @if($product->featured)
                    <span class="absolute top-6 left-6 px-4 py-2 bg-primary dark:bg-white text-white dark:text-gray-900 text-sm uppercase tracking-wider font-medium">Featured</span>
                @endif
            </div>

            {{-- Product Info --}}
            <div data-animate="slide-left" data-delay="200">
                <p class="text-secondary dark:text-gray-400 uppercase tracking-widest font-medium mb-4">{{ $product->category }}</p>
                <h1 class="text-4xl lg:text-5xl font-impact uppercase text-primary dark:text-white mb-6 leading-tight">{{ $product->name }}</h1>
                
                <div class="flex items-center gap-6 mb-8">
                    <span class="text-3xl font-bold text-primary dark:text-white">${{ number_format($product->price, 2) }}</span>
                    @if($product->compare_at_price > $product->price)
                        <span class="text-xl text-secondary dark:text-gray-500 line-through">${{ number_format($product->compare_at_price, 2) }}</span>
                    @endif
                </div>

                <div class="prose dark:prose-invert max-w-none text-secondary dark:text-gray-300 mb-10 leading-relaxed">
                    {{ $product->description }}
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button data-add="{{ $product->id }}" 
                            class="flex-1 px-8 py-4 bg-primary dark:bg-white text-white dark:text-gray-900 text-base uppercase tracking-wider font-medium hover:opacity-90 transition-opacity text-center">
                        Add to Cart
                    </button>
                    {{-- Share Button (Mock functionality) --}}
                    <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!');"
                            class="px-8 py-4 border-2 border-primary dark:border-white text-primary dark:text-white text-base uppercase tracking-wider font-medium hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-gray-900 transition-colors">
                        Share <i data-lucide="share-2" class="inline-block w-4 h-4 ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Frequently Bought Together --}}
        @if($frequentlyBought->count() > 0)
        <div class="mb-24">
            <h2 class="text-2xl font-impact uppercase text-primary dark:text-white mb-10 tracking-wide">Frequently Bought Together</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($frequentlyBought as $item)
                    @include('components.product_card', ['product' => $item])
                @endforeach
            </div>
        </div>
        @endif

        {{-- Suggested Products --}}
        @if($suggested->count() > 0)
        <div>
            <h2 class="text-2xl font-impact uppercase text-primary dark:text-white mb-10 tracking-wide">You Might Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($suggested as $item)
                    @include('components.product_card', ['product' => $item])
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Re-bind add buttons for static content
        if(window.Eshop && window.Eshop.bindAddButtons) {
            // Wait for app.js to expose this or manually re-bind if it's not exposed
        }
        // Since app.js binds to document, it might miss these static buttons if logic differs. 
        // But app.js logic mainly targets dynamically rendered lists. 
        // We might need to manually trigger the bind logic.
        // Actually, app.js doesn't expose bindAddButtons globally in the snippet.
        // We'll rely on app.js "pages" logic or modify app.js to bind globally.
        // However, standard HTML buttons with data-add might need manual binding if app.js only runs on "renderCatalog".
        
        // Let's adding a simple inline script to bridge this gap or update app.js to bind universally.
        // Better: Update app.js to handle this page type.
    });
</script>
@endpush
