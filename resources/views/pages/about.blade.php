@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - About')

@section('content')
<div class="pt-32">
  {{-- About Hero Section --}}
  <section class="py-32 px-6 lg:px-8 bg-background dark:bg-gray-800 relative overflow-hidden transition-colors duration-300">
    {{-- Subtle Grid Pattern --}}
    <div class="absolute inset-0 bg-pattern dark:opacity-10"></div>
    
    {{-- Decorative Element --}}
    <div class="absolute top-1/4 right-0 w-64 h-64 bg-background dark:bg-gray-700 rounded-full filter blur-3xl opacity-50"></div>

    <div class="max-w-7xl mx-auto relative">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        {{-- Image Side --}}
        <div data-animate="slide-left" data-delay="0" class="relative order-2 lg:order-1">
          <div data-hover="scale" class="relative border border-border dark:border-gray-700 overflow-hidden shadow-2xl bg-white dark:bg-gray-700 group cursor-pointer">
            <img src="https://images.unsplash.com/photo-1690220929690-5889d50ed11f?w=800&q=80" 
                 alt="Urban basketball court" 
                 class="w-full aspect-[4/5] object-cover transition-transform duration-700 group-hover:scale-105">
            
            {{-- Play Button Overlay --}}
            <div class="absolute inset-0 flex items-center justify-center bg-primary/30 dark:bg-black/30 backdrop-blur-sm cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity">
              <div class="w-20 h-20 rounded-full bg-white dark:bg-gray-800 flex items-center justify-center shadow-2xl transform hover:scale-110 transition-transform">
                <i data-lucide="play" class="w-10 h-10 text-primary dark:text-white ml-1"></i>
              </div>
            </div>
          </div>

          {{-- Floating Badge --}}
          <div data-animate="scale-in" data-delay="600" data-hover="lift"
               class="absolute -top-6 -right-6 border-2 border-primary dark:border-white text-primary dark:text-white px-8 py-6 shadow-2xl bg-white dark:bg-gray-800 transition-all hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-gray-900 group">
            <p class="text-3xl uppercase mb-1 font-impact">Premium</p>
            <p class="text-secondary dark:text-gray-400 text-xs uppercase tracking-wider group-hover:text-white/70 dark:group-hover:text-gray-600">Quality</p>
          </div>
        </div>

        {{-- Content Side --}}
        <div data-animate="slide-right" data-delay="0" class="space-y-8 order-1 lg:order-2">
          {{-- Badge --}}
          <div data-animate="fade-in" data-delay="200"
               class="inline-block bg-background dark:bg-gray-700 border border-border dark:border-gray-600 px-4 py-2 shadow-md">
            <span class="text-sm text-primary dark:text-white uppercase tracking-wider">Our Story</span>
          </div>

          {{-- Heading --}}
          <h1 data-animate="fade-in" data-delay="300"
              class="text-5xl lg:text-7xl text-primary dark:text-white uppercase tracking-[-0.05em] leading-[0.9] font-impact">
            Born From<br/>
            <span class="block dark:text-stroke-white" 
                  style="-webkit-text-stroke: 1px currentColor; -webkit-text-fill-color: transparent;">
              The Streets
            </span>
          </h1>

          <p data-animate="fade-in" data-delay="400"
             class="text-lg text-secondary dark:text-gray-400 leading-relaxed">
            FRAMEWORK Supply Co. represents the intersection of style, quality, and urban culture. We curate premium streetwear and lifestyle products for those who dare to stand out and make their own rules.
          </p>

          {{-- Feature List --}}
          <div class="space-y-6">
            <div data-animate="slide-left" data-delay="500"
                 class="flex items-start gap-4 border-l-2 border-border dark:border-gray-700 hover:border-primary dark:hover:border-white pl-6 transition-all cursor-pointer group">
              <div class="w-12 h-12 bg-background dark:bg-gray-700 border border-border dark:border-gray-600 flex items-center justify-center flex-shrink-0 group-hover:bg-primary dark:group-hover:bg-white group-hover:border-primary dark:group-hover:border-white transition-all shadow-md">
                <i data-lucide="zap" class="w-6 h-6 text-primary dark:text-white group-hover:text-white dark:group-hover:text-gray-900 transition-colors"></i>
              </div>
              <div>
                <h4 class="text-primary dark:text-white uppercase tracking-wider mb-1">Limited Quantity</h4>
                <p class="text-secondary dark:text-gray-400 text-sm">Only 500 pieces per design, ensuring exclusivity</p>
              </div>
            </div>

            <div data-animate="slide-left" data-delay="600"
                 class="flex items-start gap-4 border-l-2 border-border dark:border-gray-700 hover:border-primary dark:hover:border-white pl-6 transition-all cursor-pointer group">
              <div class="w-12 h-12 bg-background dark:bg-gray-700 border border-border dark:border-gray-600 flex items-center justify-center flex-shrink-0 group-hover:bg-primary dark:group-hover:bg-white group-hover:border-primary dark:group-hover:border-white transition-all shadow-md">
                <i data-lucide="trending-up" class="w-6 h-6 text-primary dark:text-white group-hover:text-white dark:group-hover:text-gray-900 transition-colors"></i>
              </div>
              <div>
                <h4 class="text-primary dark:text-white uppercase tracking-wider mb-1">Trending Now</h4>
                <p class="text-secondary dark:text-gray-400 text-sm">Top sellers this season, curated for style</p>
              </div>
            </div>

            <div data-animate="slide-left" data-delay="700"
                 class="flex items-start gap-4 border-l-2 border-border dark:border-gray-700 hover:border-primary dark:hover:border-white pl-6 transition-all cursor-pointer group">
              <div class="w-12 h-12 bg-background dark:bg-gray-700 border border-border dark:border-gray-600 flex items-center justify-center flex-shrink-0 group-hover:bg-primary dark:group-hover:bg-white group-hover:border-primary dark:group-hover:border-white transition-all shadow-md">
                <i data-lucide="award" class="w-6 h-6 text-primary dark:text-white group-hover:text-white dark:group-hover:text-gray-900 transition-colors"></i>
              </div>
              <div>
                <h4 class="text-primary dark:text-white uppercase tracking-wider mb-1">Premium Quality</h4>
                <p class="text-secondary dark:text-gray-400 text-sm">Crafted with care and precision, built to last</p>
              </div>
            </div>
          </div>

          {{-- CTA Buttons --}}
          <div data-animate="fade-in" data-delay="800" class="flex gap-4 pt-4">
            <a href="{{ route('products') }}" data-hover="scale"
               class="btn-primary dark:bg-white dark:text-gray-900">
              Shop Collection
            </a>
            <a href="{{ route('contact') }}" data-hover="scale"
               class="btn-secondary dark:border-white dark:text-white dark:hover:bg-white dark:hover:text-gray-900">
              Contact Us
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection


