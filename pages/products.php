<?php /* Products page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FRAMEWORK Supply Co. - Products</title>
  <?php include __DIR__ . '/../includes/head.php'; ?>
</head>
<body class="bg-background min-h-screen">
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition pt-32">
  <!-- Products Hero -->
  <section class="py-32 px-6 lg:px-8 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto">
      <!-- Section Header -->
      <div data-animate="fade-in" data-delay="0" class="mb-32">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16 gap-8">
          <div>
            <p data-animate="slide-left" data-delay="100" 
               class="text-secondary mb-6 uppercase tracking-[0.3em] text-lg font-medium">
              Winter '25 Collection
            </p>
            <h1 data-animate="slide-left" data-delay="200" 
                class="text-7xl lg:text-9xl text-primary uppercase tracking-tighter font-impact leading-[0.85] mb-8">
              Latest<br/>Drops
            </h1>
            <p data-animate="fade-in" data-delay="300"
               class="text-xl lg:text-2xl text-secondary max-w-2xl leading-relaxed">
              Discover our curated selection of premium streetwear. Limited quantities, exclusive designs, authentic culture.
            </p>
          </div>
          <button data-animate="slide-right" data-delay="300" 
                  data-hover="scale"
                  id="view-all-btn"
                  class="text-primary uppercase tracking-wider text-base border-2 border-primary px-10 py-5 hover:bg-primary hover:text-white transition-all shadow-lg hover:shadow-xl font-medium">
            View All Products →
          </button>
        </div>
        
        <!-- Filter Tags with Interactive Animations -->
        <div class="mb-16">
          <h3 data-animate="fade-in" data-delay="400"
              class="text-2xl text-primary uppercase tracking-wide font-impact mb-8">
            Filter by Category
          </h3>
          <div class="flex flex-wrap gap-4" id="filter-container">
            <button data-animate="fade-in" data-delay="450" data-hover="lift"
                    class="filter-tag active px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-primary text-white font-medium"
                    data-filter="All">
              All Products
            </button>
            <button data-animate="fade-in" data-delay="500" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white text-primary border-2 border-border hover:border-primary font-medium"
                    data-filter="Hoodies">
              Hoodies
            </button>
            <button data-animate="fade-in" data-delay="550" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white text-primary border-2 border-border hover:border-primary font-medium"
                    data-filter="T-Shirts">
              T-Shirts
            </button>
            <button data-animate="fade-in" data-delay="600" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white text-primary border-2 border-border hover:border-primary font-medium"
                    data-filter="Bottoms">
              Bottoms
            </button>
            <button data-animate="fade-in" data-delay="650" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white text-primary border-2 border-border hover:border-primary font-medium"
                    data-filter="Outerwear">
              Outerwear
            </button>
            <button data-animate="fade-in" data-delay="700" data-hover="lift"
                    class="filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white text-primary border-2 border-border hover:border-primary font-medium"
                    data-filter="Accessories">
              Accessories
            </button>
          </div>
        </div>
      </div>

      <!-- Product Grid with Staggered Animation -->
      <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 mb-32"></div>
      
      <!-- No Results -->
      <div class="text-center py-32 hidden" id="no-results">
        <div class="w-32 h-32 bg-background border border-border flex items-center justify-center mx-auto mb-8">
          <i data-lucide="search" class="w-16 h-16 text-secondary"></i>
        </div>
        <p class="text-secondary text-2xl uppercase tracking-wider mb-4">No products found</p>
        <p class="text-secondary text-lg">Try adjusting your filters</p>
      </div>
    </div>
  </section>
  
  <!-- Features Section -->
  <section class="py-32 px-6 lg:px-8 bg-background">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        <div class="modern-card p-12 text-center" data-animate="fade-in" data-delay="0">
          <div class="w-24 h-24 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-8 transition-all hover:bg-primary hover:text-white">
            <i data-lucide="truck" class="w-12 h-12"></i>
          </div>
          <h3 class="text-2xl uppercase tracking-tight text-primary font-impact mb-4">Free Shipping</h3>
          <p class="text-secondary text-lg leading-relaxed">Free shipping on all orders over $150. Fast and reliable delivery worldwide.</p>
        </div>
        <div class="modern-card p-12 text-center" data-animate="fade-in" data-delay="100">
          <div class="w-24 h-24 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-8 transition-all hover:bg-primary hover:text-white">
            <i data-lucide="shield-check" class="w-12 h-12"></i>
          </div>
          <h3 class="text-2xl uppercase tracking-tight text-primary font-impact mb-4">Quality Guarantee</h3>
          <p class="text-secondary text-lg leading-relaxed">30-day money-back guarantee. We stand behind every product we sell.</p>
        </div>
        <div class="modern-card p-12 text-center" data-animate="fade-in" data-delay="200">
          <div class="w-24 h-24 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-8 transition-all hover:bg-primary hover:text-white">
            <i data-lucide="headset" class="w-12 h-12"></i>
          </div>
          <h3 class="text-2xl uppercase tracking-tight text-primary font-impact mb-4">24/7 Support</h3>
          <p class="text-secondary text-lg leading-relaxed">Round-the-clock customer support. We're here whenever you need us.</p>
        </div>
      </div>
    </div>
  </section>

  <div id="footer-container"></div>
  </div>

  <?php include __DIR__ . '/../includes/scripts.php'; ?>
  <script>window.Eshop && window.Eshop.pages.products();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
