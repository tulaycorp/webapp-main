<?php /* About page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FRAMEWORK Supply Co. - About</title>
  <?php include __DIR__ . '/../includes/head.php'; ?>
</head>
<body class="bg-background min-h-screen">
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition pt-32">
  <!-- About Hero Section -->
  <section class="py-32 px-6 lg:px-8 bg-white relative overflow-hidden">
    <!-- Decorative Element -->
    <div class="absolute top-1/4 right-0 w-64 h-64 bg-background rounded-full filter blur-3xl opacity-50"></div>

    <div class="max-w-7xl mx-auto relative">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        <!-- Image Side -->
        <div data-animate="slide-left" data-delay="0" class="relative order-2 lg:order-1">
          <div data-hover="scale" class="relative border border-border overflow-hidden shadow-2xl bg-white group cursor-pointer">
            <img src="https://images.unsplash.com/photo-1690220929690-5889d50ed11f?w=800&q=80" 
                 alt="Urban basketball court" 
                 class="w-full aspect-[4/5] object-cover transition-transform duration-700 group-hover:scale-105">
            
            <!-- Play Button Overlay -->
            <div class="absolute inset-0 flex items-center justify-center bg-primary/30 backdrop-blur-sm cursor-pointer opacity-0 group-hover:opacity-100 transition-opacity">
              <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-2xl transform hover:scale-110 transition-transform">
                <i data-lucide="play" class="w-10 h-10 text-primary ml-1"></i>
              </div>
            </div>
          </div>

          <!-- Floating Badge -->
          <div data-animate="scale-in" data-delay="600" data-hover="lift"
               class="absolute -top-6 -right-6 border-2 border-primary text-primary px-8 py-6 shadow-2xl bg-white transition-all hover:bg-primary hover:text-white group">
            <p class="text-3xl uppercase mb-1 font-impact">Premium</p>
            <p class="text-secondary text-xs uppercase tracking-wider group-hover:text-white/70">Quality</p>
          </div>
        </div>

        <!-- Content Side -->
        <div data-animate="slide-right" data-delay="0" class="space-y-8 order-1 lg:order-2">
          <!-- Badge -->
          <div data-animate="fade-in" data-delay="200"
               class="inline-block bg-background border border-border px-4 py-2 shadow-md">
            <span class="text-sm text-primary uppercase tracking-wider">Our Story</span>
          </div>

          <!-- Heading -->
          <h1 data-animate="fade-in" data-delay="300"
              class="text-5xl lg:text-7xl text-primary uppercase tracking-tighter leading-[0.9] font-impact">
            Born From<br/>
            <span class="block" 
                  style="-webkit-text-stroke: 1px #111827; -webkit-text-fill-color: transparent;">
              The Streets
            </span>
          </h1>

          <p data-animate="fade-in" data-delay="400"
             class="text-lg text-secondary leading-relaxed">
            FRAMEWORK Supply Co. represents the intersection of style, quality, and urban culture. We curate premium streetwear and lifestyle products for those who dare to stand out and make their own rules.
          </p>

          <!-- Feature List -->
          <div class="space-y-6">
            <div data-animate="slide-left" data-delay="500"
                 class="flex items-start gap-4 border-l-2 border-border hover:border-primary pl-6 transition-all cursor-pointer group">
              <div class="w-12 h-12 bg-background border border-border flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:border-primary transition-all shadow-md">
                <i data-lucide="zap" class="w-6 h-6 text-primary group-hover:text-white transition-colors"></i>
              </div>
              <div>
                <h4 class="text-primary uppercase tracking-wider mb-1">Limited Quantity</h4>
                <p class="text-secondary text-sm">Only 500 pieces per design, ensuring exclusivity</p>
              </div>
            </div>

            <div data-animate="slide-left" data-delay="600"
                 class="flex items-start gap-4 border-l-2 border-border hover:border-primary pl-6 transition-all cursor-pointer group">
              <div class="w-12 h-12 bg-background border border-border flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:border-primary transition-all shadow-md">
                <i data-lucide="trending-up" class="w-6 h-6 text-primary group-hover:text-white transition-colors"></i>
              </div>
              <div>
                <h4 class="text-primary uppercase tracking-wider mb-1">Trending Now</h4>
                <p class="text-secondary text-sm">Top sellers this season, curated for style</p>
              </div>
            </div>

            <div data-animate="slide-left" data-delay="700"
                 class="flex items-start gap-4 border-l-2 border-border hover:border-primary pl-6 transition-all cursor-pointer group">
              <div class="w-12 h-12 bg-background border border-border flex items-center justify-center flex-shrink-0 group-hover:bg-primary group-hover:border-primary transition-all shadow-md">
                <i data-lucide="award" class="w-6 h-6 text-primary group-hover:text-white transition-colors"></i>
              </div>
              <div>
                <h4 class="text-primary uppercase tracking-wider mb-1">Premium Quality</h4>
                <p class="text-secondary text-sm">Crafted with care and precision, built to last</p>
              </div>
            </div>
          </div>

          <!-- CTA Buttons -->
          <div data-animate="fade-in" data-delay="800" class="flex gap-4 pt-4">
            <a href="products.php" data-hover="scale"
               class="btn-primary">
              Shop Collection
            </a>
            <a href="contact.php" data-hover="scale"
               class="btn-secondary">
              Contact Us
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div id="footer-container"></div>
  </div>

  <?php include __DIR__ . '/../includes/scripts.php'; ?>
  <script>window.Eshop && window.Eshop.pages.about();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
