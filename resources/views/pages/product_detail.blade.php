@extends('layouts.app')

@section('title', ($product->seo_title ?: $product->name) . ' - FRAMEWORK Supply Co.')

@section('meta')
@if($product->seo_description)
<meta name="description" content="{{ $product->seo_description }}">
@endif
<meta property="og:title" content="{{ $product->seo_title ?: $product->name }}">
<meta property="og:description" content="{{ $product->seo_description ?: Str::limit($product->description, 160) }}">
@if($product->image_url)
<meta property="og:image" content="{{ $product->image_url }}">
@endif
<meta property="og:type" content="product">
<meta property="product:price:amount" content="{{ $product->price }}">
<meta property="product:price:currency" content="USD">
@if($product->in_stock)
<meta property="product:availability" content="in stock">
@else
<meta property="product:availability" content="out of stock">
@endif
@endsection

@section('content')
<div class="pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-sm font-medium text-secondary dark:text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-primary dark:hover:text-white transition-colors">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products') }}" class="hover:text-primary dark:hover:text-white transition-colors">Products</a>
            @if($product->category)
            <span class="mx-2">/</span>
            <a href="{{ route('products') }}?category={{ urlencode($product->category) }}" class="hover:text-primary dark:hover:text-white transition-colors">{{ $product->category }}</a>
            @endif
            <span class="mx-2">/</span>
            <span class="text-primary dark:text-white">{{ $product->name }}</span>
        </nav>

        {{-- Main Product Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-24">
            {{-- Image Gallery: Hero + Scrollable Reel --}}
            @php
                // Combine main image with additional images array
                $allImages = collect([$product->image_url])->filter();
                if ($product->images && is_array($product->images)) {
                    $allImages = $allImages->merge($product->images);
                }
                $allImages = $allImages->unique()->values();
            @endphp
            <div data-animate="fade-in" class="w-full">
                {{-- Hero Image --}}
                <div class="relative aspect-square bg-gray-100 dark:bg-gray-800 rounded-lg overflow-hidden w-full">
                    <img id="hero-image" 
                         src="{{ $allImages->first() ?? asset('images/placeholder.png') }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover transition-opacity duration-300">
                    @if($product->featured)
                        <span class="absolute top-6 left-6 px-4 py-2 bg-primary dark:bg-white text-white dark:text-gray-900 text-sm uppercase tracking-wider font-medium">Featured</span>
                    @endif
                    @if($product->on_sale)
                        <span class="absolute top-6 right-6 px-4 py-2 bg-red-600 text-white text-sm uppercase tracking-wider font-medium">{{ $product->discount_percent }}% Off</span>
                    @endif
                </div>

                {{-- Scrollable Thumbnail Carousel - matches hero width --}}
                @if($allImages->count() > 1)
                <div class="mt-4 w-full max-w-full overflow-hidden">
                    {{-- Thumbnail reel container --}}
                    <div id="thumbnail-reel" class="overflow-x-auto scrollbar-hide scroll-smooth">
                        <div class="flex gap-3 py-1">
                            @foreach($allImages as $index => $imageUrl)
                            <button type="button"
                                    class="thumbnail-btn flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all duration-200 {{ $index === 0 ? 'border-primary dark:border-white ring-2 ring-primary/20 dark:ring-white/20' : 'border-transparent opacity-60 hover:opacity-80' }}"
                                    data-index="{{ $index }}"
                                    data-src="{{ $imageUrl }}">
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $product->name }} - Image {{ $index + 1 }}" 
                                     class="w-full h-full object-cover">
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Product Info --}}
            <div data-animate="slide-left" data-delay="200">
                {{-- Vendor / Brand --}}
                @if($product->vendor)
                <p class="text-xs text-secondary dark:text-gray-500 uppercase tracking-widest font-medium mb-2">{{ $product->vendor }}</p>
                @endif
                
                {{-- Category --}}
                <p class="text-secondary dark:text-gray-400 uppercase tracking-widest font-medium mb-4">{{ $product->category }}</p>
                
                {{-- Product Name --}}
                <h1 class="text-4xl lg:text-5xl font-impact uppercase text-primary dark:text-white mb-6 leading-tight">{{ $product->name }}</h1>
                
                {{-- Price Section --}}
                <div class="flex items-center gap-6 mb-6">
                    <span class="text-3xl font-bold text-primary dark:text-white">${{ number_format($product->price, 2) }}</span>
                    @if($product->compare_at_price > $product->price)
                        <span class="text-xl text-secondary dark:text-gray-500 line-through">${{ number_format($product->compare_at_price, 2) }}</span>
                        <span class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 text-sm font-medium rounded">Save ${{ number_format($product->compare_at_price - $product->price, 2) }}</span>
                    @endif
                </div>
                
                {{-- Stock Status --}}
                <div class="mb-6">
                    @if($product->in_stock)
                        <span class="inline-flex items-center gap-2 text-green-600 dark:text-green-400 font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            In Stock
                            @if($product->track_inventory && $product->stock_quantity <= 10 && $product->stock_quantity > 0)
                            <span class="text-orange-500 dark:text-orange-400 text-sm">(Only {{ $product->stock_quantity }} left!)</span>
                            @endif
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 text-red-600 dark:text-red-400 font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                            Out of Stock
                        </span>
                    @endif
                </div>

                {{-- Description --}}
                <div class="prose dark:prose-invert max-w-none text-secondary dark:text-gray-300 mb-8 leading-relaxed">
                    {{ $product->description }}
                </div>
                
                {{-- Product Details Accordion --}}
                <div class="border-t border-b border-gray-200 dark:border-gray-700 mb-8">
                    {{-- SKU & Product Info --}}
                    @if($product->sku || $product->barcode || $product->product_type)
                    <details class="group">
                        <summary class="py-4 flex items-center justify-between cursor-pointer list-none">
                            <span class="font-medium text-primary dark:text-white uppercase tracking-wider text-sm">Product Details</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-secondary transition-transform group-open:rotate-180"></i>
                        </summary>
                        <div class="pb-4 text-sm text-secondary dark:text-gray-400 space-y-2">
                            @if($product->sku)
                            <div class="flex justify-between">
                                <span>SKU:</span>
                                <span class="font-mono">{{ $product->sku }}</span>
                            </div>
                            @endif
                            @if($product->barcode)
                            <div class="flex justify-between">
                                <span>Barcode:</span>
                                <span class="font-mono">{{ $product->barcode }}</span>
                            </div>
                            @endif
                            @if($product->product_type)
                            <div class="flex justify-between">
                                <span>Type:</span>
                                <span>{{ $product->product_type }}</span>
                            </div>
                            @endif
                            @if($product->vendor)
                            <div class="flex justify-between">
                                <span>Vendor:</span>
                                <span>{{ $product->vendor }}</span>
                            </div>
                            @endif
                        </div>
                    </details>
                    @endif
                    
                    {{-- Shipping Information --}}
                    @if($product->requires_shipping && ($product->weight || $product->length || $product->width || $product->height))
                    <details class="group border-t border-gray-200 dark:border-gray-700">
                        <summary class="py-4 flex items-center justify-between cursor-pointer list-none">
                            <span class="font-medium text-primary dark:text-white uppercase tracking-wider text-sm">Shipping Information</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-secondary transition-transform group-open:rotate-180"></i>
                        </summary>
                        <div class="pb-4 text-sm text-secondary dark:text-gray-400 space-y-2">
                            @if($product->weight)
                            <div class="flex justify-between">
                                <span>Weight:</span>
                                <span>{{ $product->weight }} {{ $product->weight_unit }}</span>
                            </div>
                            @endif
                            @if($product->length || $product->width || $product->height)
                            <div class="flex justify-between">
                                <span>Dimensions:</span>
                                <span>{{ $product->length ?? '-' }} x {{ $product->width ?? '-' }} x {{ $product->height ?? '-' }} {{ $product->dimension_unit }}</span>
                            </div>
                            @endif
                        </div>
                    </details>
                    @endif
                    
                    {{-- Tags --}}
                    @if($product->tags)
                    <details class="group border-t border-gray-200 dark:border-gray-700">
                        <summary class="py-4 flex items-center justify-between cursor-pointer list-none">
                            <span class="font-medium text-primary dark:text-white uppercase tracking-wider text-sm">Tags</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-secondary transition-transform group-open:rotate-180"></i>
                        </summary>
                        <div class="pb-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($product->tags_array as $tag)
                                <a href="{{ route('products') }}?search={{ urlencode($tag) }}" 
                                   class="px-3 py-1 bg-gray-100 dark:bg-gray-800 text-secondary dark:text-gray-400 text-sm rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                    {{ $tag }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </details>
                    @endif
                    
                    {{-- Custom Metafields --}}
                    @if($product->metafields && count($product->metafields) > 0)
                    <details class="group border-t border-gray-200 dark:border-gray-700">
                        <summary class="py-4 flex items-center justify-between cursor-pointer list-none">
                            <span class="font-medium text-primary dark:text-white uppercase tracking-wider text-sm">Additional Information</span>
                            <i data-lucide="chevron-down" class="w-5 h-5 text-secondary transition-transform group-open:rotate-180"></i>
                        </summary>
                        <div class="pb-4 text-sm text-secondary dark:text-gray-400 space-y-2">
                            @foreach($product->metafields as $metafield)
                            <div class="flex justify-between">
                                <span>{{ ucfirst(str_replace('_', ' ', $metafield['key'])) }}:</span>
                                <span>{{ is_array($metafield['value']) ? json_encode($metafield['value']) : $metafield['value'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </details>
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    @if($product->in_stock)
                    <button data-add="{{ $product->id }}" 
                            class="flex-1 px-8 py-4 bg-primary dark:bg-white text-white dark:text-gray-900 text-base uppercase tracking-wider font-medium hover:opacity-90 transition-opacity text-center">
                        Add to Cart
                    </button>
                    @else
                    <button disabled
                            class="flex-1 px-8 py-4 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-base uppercase tracking-wider font-medium cursor-not-allowed text-center">
                        Sold Out
                    </button>
                    @endif
                    
                    {{-- Share Button --}}
                    <button id="share-btn"
                            onclick="(function(btn) {
                                navigator.clipboard.writeText(window.location.href);
                                const originalHTML = btn.innerHTML;
                                btn.innerHTML = 'Copied! <svg class=\'inline-block w-4 h-4 ml-2\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\'></path></svg>';
                                btn.disabled = true;
                                setTimeout(function() {
                                    btn.innerHTML = originalHTML;
                                    btn.disabled = false;
                                    if (window.lucide) window.lucide.createIcons();
                                }, 2000);
                            })(this)"
                            class="px-8 py-4 border-2 border-primary dark:border-white text-primary dark:text-white text-base uppercase tracking-wider font-medium hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-gray-900 transition-colors">
                        Share <i data-lucide="share-2" class="inline-block w-4 h-4 ml-2"></i>
                    </button>
                </div>
                
                {{-- Trust Badges --}}
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-3 gap-4 text-center text-xs text-secondary dark:text-gray-400">
                        <div class="flex flex-col items-center gap-2">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                            <span>Secure Checkout</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <i data-lucide="truck" class="w-6 h-6"></i>
                            <span>Fast Shipping</span>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <i data-lucide="refresh-cw" class="w-6 h-6"></i>
                            <span>Easy Returns</span>
                        </div>
                    </div>
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
        // Re-initialize Lucide icons for dynamically added elements
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Image Gallery Functionality
        const heroImage = document.getElementById('hero-image');
        const thumbnailBtns = document.querySelectorAll('.thumbnail-btn');
        const thumbnailReel = document.getElementById('thumbnail-reel');
        
        if (thumbnailBtns.length > 0) {
            let currentIndex = 0;
            const totalImages = thumbnailBtns.length;

            // Update hero image and active thumbnail
            function updateGallery(index, wrapAround = false) {
                currentIndex = index;
                const btn = thumbnailBtns[index];
                const newSrc = btn.dataset.src;

                // Fade transition for hero image
                heroImage.style.opacity = '0.5';
                setTimeout(() => {
                    heroImage.src = newSrc;
                    heroImage.style.opacity = '1';
                }, 150);

                // Update thumbnail active states (opacity for inactive, full for active)
                thumbnailBtns.forEach((b, i) => {
                    if (i === index) {
                        b.classList.remove('border-transparent', 'opacity-60', 'hover:opacity-80');
                        b.classList.add('border-primary', 'dark:border-white', 'ring-2', 'ring-primary/20', 'dark:ring-white/20');
                    } else {
                        b.classList.remove('border-primary', 'dark:border-white', 'ring-2', 'ring-primary/20', 'dark:ring-white/20');
                        b.classList.add('border-transparent', 'opacity-60', 'hover:opacity-80');
                    }
                });

                // Scroll behavior: if wrap-around, scroll to the edge first
                if (wrapAround && thumbnailReel) {
                    if (index === 0) {
                        // Wrapped to first: scroll to start
                        thumbnailReel.scrollTo({ left: 0, behavior: 'smooth' });
                    } else if (index === totalImages - 1) {
                        // Wrapped to last: scroll to end
                        thumbnailReel.scrollTo({ left: thumbnailReel.scrollWidth, behavior: 'smooth' });
                    }
                } else {
                    // Normal: scroll thumbnail into view
                    btn.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
                }
            }

            // Thumbnail click handlers with edge detection for wrap-around
            thumbnailBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const index = parseInt(btn.dataset.index, 10);
                    
                    // Check if clicking on edge thumbnails should trigger wrap-around
                    const isFirstThumbnail = index === 0;
                    const isLastThumbnail = index === totalImages - 1;
                    const isCurrentFirst = currentIndex === 0;
                    const isCurrentLast = currentIndex === totalImages - 1;
                    
                    // If clicking on first thumbnail while already on first, go to last
                    if (isFirstThumbnail && isCurrentFirst && totalImages > 1) {
                        updateGallery(totalImages - 1, true);
                        return;
                    }
                    
                    // If clicking on last thumbnail while already on last, go to first
                    if (isLastThumbnail && isCurrentLast && totalImages > 1) {
                        updateGallery(0, true);
                        return;
                    }
                    
                    updateGallery(index);
                });
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                // Only handle if not focused on an input
                if (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA') {
                    return;
                }
                if (e.key === 'ArrowLeft') {
                    const isWrap = currentIndex === 0;
                    const newIndex = isWrap ? totalImages - 1 : currentIndex - 1;
                    updateGallery(newIndex, isWrap);
                } else if (e.key === 'ArrowRight') {
                    const isWrap = currentIndex === totalImages - 1;
                    const newIndex = isWrap ? 0 : currentIndex + 1;
                    updateGallery(newIndex, isWrap);
                }
            });
        }
    });
</script>
@endpush
