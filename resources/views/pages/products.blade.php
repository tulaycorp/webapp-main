@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - Products')

@section('content')
<div class="pt-32">
  {{-- Products Hero --}}
  <section class="py-32 px-6 lg:px-8 bg-white dark:bg-gray-800 min-h-screen transition-colors duration-300">
    <div class="max-w-7xl mx-auto">
      {{-- Section Header --}}
      <div data-animate="fade-in" data-delay="0" class="mb-32">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16 gap-8">
          <div>
            <p data-animate="slide-left" data-delay="100" 
               class="text-secondary dark:text-gray-400 mb-6 uppercase tracking-[0.3em] text-lg font-medium">
              Winter '25 Collection
            </p>
            <h1 data-animate="slide-left" data-delay="200" 
                class="text-7xl lg:text-9xl text-primary dark:text-white uppercase tracking-tighter font-impact leading-[0.85] mb-8">
              Latest<br/>Drops
            </h1>
            <p data-animate="fade-in" data-delay="300"
               class="text-xl lg:text-2xl text-secondary dark:text-gray-400 max-w-2xl leading-relaxed">
              Discover our curated selection of premium streetwear. Limited quantities, exclusive designs, authentic culture.
            </p>
          </div>

        </div>
        
        {{-- Filter Tags with Interactive Animations --}}
        <div class="mb-16">
          <h3 data-animate="fade-in" data-delay="400"
              class="text-2xl text-primary dark:text-white uppercase tracking-wide font-impact mb-8">
            Filter by Category
          </h3>
          <div class="flex flex-wrap gap-4" id="filter-container">
            <button data-animate="fade-in" data-delay="450" data-hover="lift"
                    class="filter-tag active px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-primary dark:bg-white text-white dark:text-gray-900 font-medium"
                    data-filter="All">
              All Products
            </button>
            {{-- Categories will be dynamically loaded via JavaScript --}}
          </div>
        </div>
      </div>

      {{-- Product Grid with Staggered Animation --}}
      <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 mb-32"></div>
      
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
