<?php /* NAVBAR COMPONENT (PHP include) */ ?>
<header class="fixed top-0 left-0 right-0 bg-white/98 backdrop-blur-lg text-primary z-50 border-b border-border animate-slide-up">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <a href="/webapp-main/pages/index.php" class="flex flex-col leading-none hover:scale-105 transition-transform duration-200">
          <span class="text-4xl tracking-tighter uppercase text-primary font-impact">FRAMEWORK</span>
          <span class="text-[10px] tracking-ultra text-secondary uppercase">Supply Co.</span>
        </a>
      </div>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex items-center space-x-8">
        <a href="/webapp-main/pages/index.php" data-page="home" class="relative text-sm uppercase tracking-wider text-secondary hover:text-primary transition-colors group">
          Home
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="/webapp-main/pages/products.php" data-page="products" class="relative text-sm uppercase tracking-wider text-secondary hover:text-primary transition-colors group">
          Shop
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="/webapp-main/pages/about.php" data-page="about" class="relative text-sm uppercase tracking-wider text-secondary hover:text-primary transition-colors group">
          About
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="/webapp-main/pages/contact.php" data-page="contact" class="relative text-sm uppercase tracking-wider text-secondary hover:text-primary transition-colors group">
          Contact
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary group-hover:w-full transition-all duration-300"></span>
        </a>
      </nav>

      <!-- Actions -->
      <div class="flex items-center space-x-6">
        <button class="text-secondary hover:text-primary transition-colors hover:scale-110 transform duration-200">
          <i data-lucide="user" class="w-5 h-5"></i>
        </button>
        <a href="/webapp-main/pages/cart.php" data-page="cart" class="relative text-secondary hover:text-primary transition-colors hover:scale-110 transform duration-200">
          <i data-lucide="shopping-cart" class="w-5 h-5"></i>
          <span class="absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" id="cart-count">0</span>
        </a>
        <button id="theme-toggle" class="text-secondary hover:text-primary transition-colors hover:scale-110 transform duration-200" aria-label="Toggle theme">
          <span id="theme-emoji" aria-hidden="true">🌙</span>
        </button>
        
        <!-- Mobile menu button -->
        <button id="mobile-menu-btn" class="md:hidden text-primary">
          <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="hidden md:hidden py-6 border-t border-border">
      <nav class="flex flex-col space-y-4">
        <a href="/webapp-main/pages/index.php" data-page="home" class="text-sm uppercase tracking-wider text-secondary hover:text-primary transition-colors">Home</a>
        <a href="/webapp-main/pages/products.php" data-page="products" class="text-sm uppercase tracking-wider text-secondary hover:text-primary transition-colors">Shop</a>
        <a href="/webapp-main/pages/about.php" data-page="about" class="text-sm uppercase tracking-wider text-secondary hover:text-primary transition-colors">About</a>
        <a href="/webapp-main/pages/contact.php" data-page="contact" class="text-sm uppercase tracking-wider text-secondary hover:text-primary transition-colors">Contact</a>
      </nav>
    </div>
  </div>

  <!-- Announcement Bar -->
  <div class="bg-primary text-white text-center py-2 px-4">
    <p class="text-xs uppercase tracking-wider">
      <span class="animate-pulse-slow">⚡</span> NEW DROP: Winter Collection Live Now | Free Shipping Over $150 <span class="animate-pulse-slow">⚡</span>
    </p>
  </div>
</header>

<script>
  // Mobile menu toggle
  document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
    const menu = document.getElementById('mobile-menu');
    const icon = this.querySelector('[data-lucide]');
    if (menu.classList.contains('hidden')) {
      menu.classList.remove('hidden');
      icon.setAttribute('data-lucide', 'x');
    } else {
      menu.classList.add('hidden');
      icon.setAttribute('data-lucide', 'menu');
    }
    lucide.createIcons();
  });
</script>
