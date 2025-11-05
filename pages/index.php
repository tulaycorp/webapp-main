<?php /* Home page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FRAMEWORK Supply Co. - Premium Streetwear</title>
  <?php include __DIR__ . '/../includes/head.php'; ?>
</head>
<body class="bg-background min-h-screen">
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition">
    <!-- Hero Section -->
    <section class="relative min-h-screen w-full overflow-hidden bg-background pt-32" id="hero-section">
      <!-- Subtle Grid Pattern -->
      <div class="absolute inset-0 bg-pattern"></div>

      <!-- Content -->
      <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-20" style="opacity: 1;" id="hero-content">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
          <!-- Left: Content -->
          <div class="space-y-8 z-10">
            <!-- Limited Badge with Animation -->
            <div data-animate="fade-in" data-delay="200" 
                 class="inline-flex items-center gap-3 px-5 py-2 bg-white border border-border shadow-lg">
              <i data-lucide="clock" class="w-4 h-4 text-primary"></i>
              <span class="text-sm uppercase tracking-wider text-primary">Limited Drop</span>
            </div>

            <!-- Main Heading with Staggered Animation -->
            <div>
              <h1 class="text-7xl sm:text-8xl lg:text-9xl uppercase leading-none tracking-tighter text-primary font-impact">
                <span data-animate="slide-left" data-delay="300" class="block">WINTER</span>
                <span data-animate="slide-left" data-delay="600" class="block" 
                      style="-webkit-text-stroke: 2px #111827; -webkit-text-fill-color: transparent;">'25</span>
              </h1>
              <p data-animate="fade-in" data-delay="800" 
                 class="text-2xl text-secondary mt-4 uppercase tracking-[0.2em]">Collection</p>
            </div>

            <!-- Countdown Timer -->
            <div data-animate="fade-in" data-delay="1000" id="countdown-timer"></div>

            <!-- CTA Buttons with Hover Effects -->
            <div data-animate="fade-in" data-delay="1200" class="flex flex-col sm:flex-row gap-4 pt-4">
              <a href="/webapp-main/pages/products.php" 
                 data-hover="scale" 
                 class="btn-primary inline-flex items-center justify-center gap-2 group">
                <span>Shop Now</span>
                <i data-lucide="arrow-right" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
              </a>
              <button data-hover="scale" class="btn-secondary">View Lookbook</button>
            </div>

            <!-- Stats with Animated Counters -->
            <div data-animate="fade-in" data-delay="1400" class="flex gap-8 pt-8 border-t border-border">
              <div data-animate="fade-in" data-delay="1400">
                <div class="text-2xl text-primary uppercase font-impact">500+</div>
                <div class="text-xs text-secondary uppercase tracking-wider">Pieces</div>
              </div>
              <div data-animate="fade-in" data-delay="1500">
                <div class="text-2xl text-primary uppercase font-impact">Limited</div>
                <div class="text-xs text-secondary uppercase tracking-wider">Edition</div>
              </div>
              <div data-animate="fade-in" data-delay="1600">
                <div class="text-2xl text-primary uppercase font-impact">Exclusive</div>
                <div class="text-xs text-secondary uppercase tracking-wider">Access</div>
              </div>
            </div>
          </div>

          <!-- Right: Model Image with Interactive Elements -->
          <div data-animate="slide-right" data-delay="400" class="relative h-[600px] hidden lg:block">
            <div data-hover="lift" class="hero-image-container absolute inset-0 border border-border overflow-hidden shadow-2xl bg-white group cursor-pointer">
              <img src="https://images.unsplash.com/photo-1643387848945-da63360662f4?w=800&q=80" 
                   alt="Streetwear model" 
                   class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
              
              <!-- Play Button Overlay -->
              <div class="absolute inset-0 flex items-center justify-center bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <div class="w-16 h-16 rounded-full bg-white/90 flex items-center justify-center shadow-xl transform hover:scale-110 transition-transform">
                  <i data-lucide="play" class="w-8 h-8 text-primary ml-1"></i>
                </div>
              </div>
            </div>

            <!-- Floating Info Card -->
            <div data-animate="scale-in" data-delay="1600" 
                 data-hover="lift" 
                 class="absolute -bottom-8 -left-8 bg-white border border-border px-8 py-6 shadow-xl">
              <p class="text-4xl text-primary uppercase mb-1 font-impact">Sold Out</p>
              <p class="text-secondary text-xs uppercase tracking-wider">Last Drop</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Scroll Indicator with Animation -->
      <div class="scroll-indicator absolute bottom-8 left-1/2 transform -translate-x-1/2 text-secondary uppercase text-xs tracking-wider" 
           style="opacity: 0; animation: fadeIn 1s ease 2s forwards;">
        <div class="flex flex-col items-center gap-2">
          <span>Scroll</span>
          <div class="scroll-line w-px h-12 bg-secondary/30" style="animation: bounce 1.5s infinite;"></div>
        </div>
      </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="heading-lg mb-4">Featured Products</h2>
          <p class="text-secondary text-lg uppercase tracking-wider">Handpicked items from our premium collection</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="featured-products">
          <div class="col-span-full text-center">
            <div class="loading-spinner mx-auto"></div>
          </div>
        </div>
        <div class="text-center mt-12">
          <a href="products.php" class="btn-secondary flex items-center justify-center gap-2 inline-flex">
            <span>View All Products</span>
            <i data-lucide="arrow-right" class="w-5 h-5"></i>
          </a>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-background">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Feature 1 -->
          <div class="modern-card p-8 text-center">
            <div class="w-20 h-20 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-6 transition-all hover:bg-primary hover:text-white">
              <i data-lucide="truck" class="w-10 h-10"></i>
            </div>
            <h4 class="text-xl uppercase tracking-tight text-primary font-semibold mb-3">Free Shipping</h4>
            <p class="text-secondary text-sm">Free shipping on all orders over $150. Fast and reliable delivery to your doorstep.</p>
          </div>

          <!-- Feature 2 -->
          <div class="modern-card p-8 text-center">
            <div class="w-20 h-20 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-6 transition-all hover:bg-primary hover:text-white">
              <i data-lucide="shield-check" class="w-10 h-10"></i>
            </div>
            <h4 class="text-xl uppercase tracking-tight text-primary font-semibold mb-3">Quality Guarantee</h4>
            <p class="text-secondary text-sm">30-day money-back guarantee. We stand behind the quality of our products.</p>
          </div>

          <!-- Feature 3 -->
          <div class="modern-card p-8 text-center">
            <div class="w-20 h-20 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-6 transition-all hover:bg-primary hover:text-white">
              <i data-lucide="headset" class="w-10 h-10"></i>
            </div>
            <h4 class="text-xl uppercase tracking-tight text-primary font-semibold mb-3">24/7 Support</h4>
            <p class="text-secondary text-sm">Round-the-clock customer support. We're here to help whenever you need us.</p>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include __DIR__ . '/../includes/scripts.php'; ?>
  <script>if (window.Eshop?.pages?.home) window.Eshop.pages.home();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
