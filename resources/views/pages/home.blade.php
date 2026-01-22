@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - Premium Streetwear')

@section('content')
<div class="pt-32">
  {{-- Hero Section --}}
  <section class="relative min-h-screen w-full overflow-hidden bg-background dark:bg-gray-900 pt-32 transition-colors duration-300" id="hero-section">
    {{-- Subtle Grid Pattern --}}
    <div class="absolute inset-0 bg-pattern dark:opacity-10"></div>

    {{-- Content --}}
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-20" id="hero-content">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        {{-- Left: Content --}}
        <div class="space-y-8 z-10">
          {{-- Limited Badge with Animation --}}
          <div data-animate="fade-in" data-delay="200" 
               class="inline-flex items-center gap-3 px-5 py-2 bg-white dark:bg-gray-800 border border-border dark:border-gray-700 shadow-lg">
            <i data-lucide="clock" class="w-4 h-4 text-primary dark:text-white"></i>
            <span class="text-sm uppercase tracking-wider text-primary dark:text-white">Limited Drop</span>
          </div>

          {{-- Main Heading with Staggered Animation --}}
          <div>
            <h1 class="text-7xl sm:text-8xl lg:text-9xl uppercase leading-none tracking-[-0.05em] text-primary dark:text-white font-impact">
              <span data-animate="slide-left" data-delay="300" class="block">WINTER</span>
              <span data-animate="slide-left" data-delay="600" class="block dark:text-stroke-white" 
                    style="-webkit-text-stroke: 2px currentColor; -webkit-text-fill-color: transparent;">'25</span>
            </h1>
            <p data-animate="fade-in" data-delay="800" 
               class="text-2xl text-secondary dark:text-gray-400 mt-4 uppercase tracking-[0.2em]">Collection</p>
          </div>

          {{-- Countdown Timer --}}
          <div data-animate="fade-in" data-delay="1000" id="countdown-timer"></div>

          {{-- CTA Buttons with Hover Effects --}}
          <div data-animate="fade-in" data-delay="1200" class="flex flex-col sm:flex-row gap-4 pt-4">
            <a href="{{ route('products') }}" 
               data-hover="scale" 
               class="btn-primary dark:bg-white dark:text-gray-900 inline-flex items-center justify-center gap-2 group">
              <span>Shop Now</span>
              <i data-lucide="arrow-right" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
            </a>
          </div>

          {{-- Stats with Animated Counters --}}
          <div data-animate="fade-in" data-delay="1400" class="flex gap-8 pt-8 border-t border-border dark:border-gray-700">
            <div data-animate="fade-in" data-delay="1400">
              <div class="text-2xl text-primary dark:text-white uppercase font-impact">500+</div>
              <div class="text-xs text-secondary dark:text-gray-400 uppercase tracking-wider">Pieces</div>
            </div>
            <div data-animate="fade-in" data-delay="1500">
              <div class="text-2xl text-primary dark:text-white uppercase font-impact">Limited</div>
              <div class="text-xs text-secondary dark:text-gray-400 uppercase tracking-wider">Edition</div>
            </div>
            <div data-animate="fade-in" data-delay="1600">
              <div class="text-2xl text-primary dark:text-white uppercase font-impact">Exclusive</div>
              <div class="text-xs text-secondary dark:text-gray-400 uppercase tracking-wider">Access</div>
            </div>
          </div>
        </div>

        {{-- Right: Model Image with Interactive Elements --}}
        <div data-animate="slide-right" data-delay="400" class="relative h-[600px] hidden lg:block rotate-3 transition-transform duration-500 hover:rotate-1">
          <div data-hover="lift" class="hero-image-container absolute inset-0 border border-border dark:border-gray-700 overflow-hidden shadow-2xl bg-white dark:bg-gray-800 group cursor-pointer">
            <img src="https://images.unsplash.com/photo-1643387848945-da63360662f4?w=800&q=80" 
                 alt="Streetwear model" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            
            {{-- Play Button Overlay --}}
            {{-- Play Button Overlay Removed --}}
          </div>

          {{-- Floating Info Card --}}
          <div data-animate="scale-in" data-delay="1600" 
               data-hover="lift" 
               class="absolute -bottom-8 -left-8 bg-white dark:bg-gray-800 border border-border dark:border-gray-700 px-8 py-6 shadow-xl -rotate-6 hover:rotate-0 transition-transform duration-300">
            <p class="text-4xl text-primary dark:text-white uppercase mb-1 font-impact">Sold Out</p>
            <p class="text-secondary dark:text-gray-400 text-xs uppercase tracking-wider">Last Drop</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Featured Products Section --}}
  <section class="py-20 bg-white dark:bg-gray-800 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="text-center mb-12">
        <h2 class="heading-lg dark:text-white mb-4">Featured Products</h2>
        <p class="text-secondary dark:text-gray-400 text-lg uppercase tracking-wider">Handpicked items from our premium collection</p>
      </div>
      
      {{-- Carousel Container --}}
      <div class="relative" id="featured-carousel-wrapper">
        {{-- Previous Button --}}
        <button type="button" id="carousel-prev" 
                class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 w-10 h-10 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 shadow-lg flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
          <svg class="w-5 h-5 text-gray-700 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
          <span class="sr-only">Previous slide</span>
        </button>
        
        {{-- Carousel Track --}}
        <div class="overflow-hidden py-8" id="carousel-viewport">
          <div class="flex transition-transform duration-500 ease-out gap-8" id="featured-products">
            <div class="flex items-center justify-center w-full">
              <div class="loading-spinner mx-auto"></div>
            </div>
          </div>
        </div>
        
        {{-- Next Button --}}
        <button type="button" id="carousel-next"
                class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 w-10 h-10 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 shadow-lg flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
          <svg class="w-5 h-5 text-gray-700 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
          <span class="sr-only">Next slide</span>
        </button>
        
        {{-- Carousel Indicators --}}
        <div class="flex justify-center gap-2 mt-6" id="carousel-indicators"></div>
      </div>
      
      <div class="text-center mt-12">
        <a href="{{ route('products') }}" class="btn-secondary dark:border-white dark:text-white dark:hover:bg-white dark:hover:text-gray-900 flex items-center justify-center gap-2 inline-flex">
          <span>View All Products</span>
          <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>
      </div>
    </div>
  </section>

  {{-- Features Section --}}
  <section class="py-20 bg-background dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Feature 1 --}}
        <div class="modern-card dark:bg-gray-800 dark:border-gray-700 p-8 text-center">
          <div class="w-20 h-20 border-2 border-primary dark:border-white text-primary dark:text-white flex items-center justify-center mx-auto mb-6 transition-all hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-gray-900">
            <i data-lucide="truck" class="w-10 h-10"></i>
          </div>
          <h4 class="text-xl uppercase tracking-tight text-primary dark:text-white font-semibold mb-3">Free Shipping</h4>
          <p class="text-secondary dark:text-gray-400 text-sm">Free shipping on all orders over $150. Fast and reliable delivery to your doorstep.</p>
        </div>

        {{-- Feature 2 --}}
        <div class="modern-card dark:bg-gray-800 dark:border-gray-700 p-8 text-center">
          <div class="w-20 h-20 border-2 border-primary dark:border-white text-primary dark:text-white flex items-center justify-center mx-auto mb-6 transition-all hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-gray-900">
            <i data-lucide="shield-check" class="w-10 h-10"></i>
          </div>
          <h4 class="text-xl uppercase tracking-tight text-primary dark:text-white font-semibold mb-3">Quality Guarantee</h4>
          <p class="text-secondary dark:text-gray-400 text-sm">30-day money-back guarantee. We stand behind the quality of our products.</p>
        </div>

        {{-- Feature 3 --}}
        <div class="modern-card dark:bg-gray-800 dark:border-gray-700 p-8 text-center">
          <div class="w-20 h-20 border-2 border-primary dark:border-white text-primary dark:text-white flex items-center justify-center mx-auto mb-6 transition-all hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-gray-900">
            <i data-lucide="headset" class="w-10 h-10"></i>
          </div>
          <h4 class="text-xl uppercase tracking-tight text-primary dark:text-white font-semibold mb-3">24/7 Support</h4>
          <p class="text-secondary dark:text-gray-400 text-sm">Round-the-clock customer support. We're here to help whenever you need us.</p>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection


