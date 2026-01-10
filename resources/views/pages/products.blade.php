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
            <button data-animate="fade-in" data-delay="500" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white dark:bg-gray-700 text-primary dark:text-white border-2 border-border dark:border-gray-600 hover:border-primary dark:hover:border-white font-medium"
                    data-filter="Hoodies">
              Hoodies
            </button>
            <button data-animate="fade-in" data-delay="550" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white dark:bg-gray-700 text-primary dark:text-white border-2 border-border dark:border-gray-600 hover:border-primary dark:hover:border-white font-medium"
                    data-filter="T-Shirts">
              T-Shirts
            </button>
            <button data-animate="fade-in" data-delay="600" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white dark:bg-gray-700 text-primary dark:text-white border-2 border-border dark:border-gray-600 hover:border-primary dark:hover:border-white font-medium"
                    data-filter="Bottoms">
              Bottoms
            </button>
            <button data-animate="fade-in" data-delay="650" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white dark:bg-gray-700 text-primary dark:text-white border-2 border-border dark:border-gray-600 hover:border-primary dark:hover:border-white font-medium"
                    data-filter="Outerwear">
              Outerwear
            </button>
            <button data-animate="fade-in" data-delay="700" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white dark:bg-gray-700 text-primary dark:text-white border-2 border-border dark:border-gray-600 hover:border-primary dark:hover:border-white font-medium"
                    data-filter="Accessories">
              Accessories
            </button>
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
  // Filter Button Logic
  document.addEventListener('DOMContentLoaded', () => {
     // Wait a bit for app.js to initialize Eshop
     setTimeout(() => {
        const buttons = document.querySelectorAll('.filter-tag');
        buttons.forEach(btn => {
          btn.addEventListener('click', function() {
            // Update UI
            buttons.forEach(b => {
                b.classList.remove('active', 'bg-primary', 'text-white');
                b.classList.add('bg-white', 'text-primary'); 
                 if(b.classList.contains('dark:bg-white')) {
                     b.classList.remove('dark:bg-white', 'dark:text-gray-900');
                     b.classList.add('dark:bg-gray-700', 'dark:text-white');
                 }
            });
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            if (window.Eshop && window.Eshop.filterProducts) {
                window.Eshop.filterProducts(filter === 'All' ? '' : filter);
            }
          });
        });
     }, 300); // Slight delay to match app.js init
  });
</script>
@endpush
