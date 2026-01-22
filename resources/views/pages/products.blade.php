@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - Products')

@section('content')
<div class="pt-32">
  {{-- Products Hero --}}
  <section class="py-32 px-6 lg:px-8 bg-background dark:bg-gray-800 min-h-screen transition-colors duration-300 relative overflow-hidden">
    {{-- Subtle Grid Pattern --}}
    <div class="absolute inset-0 bg-pattern dark:opacity-10"></div>

    <div class="max-w-7xl mx-auto relative">
      {{-- Section Header --}}
      <div data-animate="fade-in" data-delay="0" class="mb-32">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16 gap-8">
          <div class="flex-1 pr-12">
            <p data-animate="slide-left" data-delay="100" 
               class="text-secondary dark:text-gray-400 mb-6 uppercase tracking-[0.3em] text-lg font-medium">
              Winter '25 Collection
            </p>
            <h1 data-animate="slide-left" data-delay="200" 
                class="text-7xl lg:text-9xl text-primary dark:text-white uppercase tracking-[-0.05em] font-impact leading-[0.85] mb-8">
              Latest<br/>Drops
            </h1>
            <p data-animate="fade-in" data-delay="300"
               class="text-xl lg:text-2xl text-secondary dark:text-gray-400 max-w-2xl leading-relaxed">
              Discover our curated selection of premium streetwear. Limited quantities, exclusive designs, authentic culture.
            </p>
          </div>

          {{-- Featured/Sold Out Component --}}
          <div data-animate="slide-right" data-delay="400" class="relative h-[600px] hidden lg:block w-full max-w-lg -rotate-2 transition-transform duration-500 hover:rotate-0">
            <div data-hover="lift" class="hero-image-container absolute inset-0 border border-border dark:border-gray-700 overflow-hidden shadow-2xl bg-white dark:bg-gray-800 group cursor-pointer">
              <img src="https://images.unsplash.com/photo-1643387848945-da63360662f4?w=800&q=80" 
                  alt="Streetwear model" 
                  class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            </div>

            {{-- Floating Info Card --}}
            <div data-animate="scale-in" data-delay="1600" 
                data-hover="lift" 
                class="absolute -bottom-8 -left-8 bg-white dark:bg-gray-800 border border-border dark:border-gray-700 px-8 py-6 shadow-xl rotate-3 hover:rotate-0 transition-transform duration-300">
              <p class="text-4xl text-primary dark:text-white uppercase mb-1 font-impact">Sold Out</p>
              <p class="text-secondary dark:text-gray-400 text-xs uppercase tracking-wider">Last Drop</p>
            </div>
          </div>

        </div>
    </div>
  </section>

  {{-- Filter and Product Grid Section with White Background --}}
  <section class="pt-[150px] pb-20 px-6 lg:px-8 bg-white dark:bg-gray-800 transition-colors duration-300">
    <div class="max-w-7xl mx-auto">

      {{-- Filter Tags with Interactive Animations --}}
      <div class="mb-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
            <h3 data-animate="fade-in" data-delay="400"
                class="text-2xl text-primary dark:text-white uppercase tracking-wide font-impact mb-0">
            Filter by Category
            </h3>
            
            {{-- Search Bar --}}
            <div class="relative group w-full lg:w-80" data-animate="fade-in" data-delay="300">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-secondary dark:text-gray-400 group-hover:text-primary dark:group-hover:text-white transition-colors"></i>
                <input type="text" 
                        id="search" 
                        placeholder="Search products..." 
                        class="w-full pl-12 pr-0 py-3 bg-white dark:bg-gray-700 border border-border dark:border-gray-600 focus:border-primary dark:focus:border-white outline-none transition-all shadow-sm group-hover:shadow-md text-primary dark:text-white placeholder-secondary/70">
            </div>
        </div>

        <div class="flex flex-wrap gap-4" id="filter-container">
            <button data-animate="fade-in" data-delay="450" data-hover="lift"
                    class="filter-tag active px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-primary dark:bg-white text-white dark:text-gray-900 font-medium"
                    data-filter="All">
                All Products
            </button>
            {{-- Skeleton Filter Pills --}}
            @for ($i = 0; $i < 4; $i++)
            <div class="h-14 w-32 bg-gray-200 dark:bg-gray-700 animate-pulse" style="width: {{ rand(100, 160) }}px"></div>
            @endfor
            {{-- Categories will be dynamically loaded via JavaScript --}}
        </div>
      </div>

      {{-- Product Grid with Staggered Animation --}}
      <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 mb-32">
        {{-- Skeleton Loaders (6 items) --}}
        @for ($i = 0; $i < 6; $i++)
        <div class="group animate-pulse">
            <div class="modern-card dark:bg-gray-800 dark:border-gray-700 overflow-hidden border border-gray-200">
                {{-- Image Placeholder --}}
                <div class="aspect-square bg-gray-200 dark:bg-gray-700 w-full"></div>
                
                <div class="p-6 space-y-4">
                    {{-- Category Placeholder --}}
                    <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-1/3"></div>
                    
                    {{-- Title Placeholder --}}
                    <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                    
                    {{-- Price & Button Placeholder --}}
                    <div class="flex items-center justify-between pt-2">
                        <div class="h-8 bg-gray-200 dark:bg-gray-700 rounded w-1/4"></div>
                        <div class="h-10 bg-gray-200 dark:bg-gray-700 rounded w-1/4"></div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
      </div>
      
      {{-- No Results --}}
      <div class="text-center py-32 hidden" id="no-results">
        <div class="w-32 h-32 bg-background dark:bg-gray-700 border border-border dark:border-gray-600 flex items-center justify-center mx-auto mb-8">
          <i data-lucide="search" class="w-16 h-16 text-secondary dark:text-gray-400"></i>
        </div>
        <p class="text-secondary dark:text-gray-400 text-2xl uppercase tracking-wider mb-4">No products found</p>
        <p class="text-secondary dark:text-gray-400 text-lg">Try adjusting your filters</p>
      </div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script>
  // Filter button styling is now handled by app.js via renderCategoryFilters()
  // This script adds additional active state styling for visual feedback
  document.addEventListener('DOMContentLoaded', () => {
    // Wait for categories to be loaded and rendered by app.js
    setTimeout(() => {
      const container = document.getElementById('filter-container');
      if (container) {
        container.addEventListener('click', function(e) {
          const btn = e.target.closest('.filter-tag');
          if (!btn) return;
          
          // Update active button styling
          container.querySelectorAll('.filter-tag').forEach(b => {
            b.classList.remove('active', 'bg-primary', 'text-white', 'dark:bg-white', 'dark:text-gray-900');
            b.classList.add('bg-white', 'text-primary', 'dark:bg-gray-700', 'dark:text-white');
          });
          btn.classList.add('active', 'bg-primary', 'text-white', 'dark:bg-white', 'dark:text-gray-900');
          btn.classList.remove('bg-white', 'text-primary', 'dark:bg-gray-700', 'dark:text-white');
        });
      }
    }, 500);
  });
</script>
@endpush
