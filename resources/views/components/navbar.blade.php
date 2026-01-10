{{-- NAVBAR COMPONENT --}}
<header class="fixed top-0 left-0 right-0 bg-white/98 dark:bg-gray-900/98 backdrop-blur-lg text-primary dark:text-white z-50 border-b border-border dark:border-gray-700 animate-slide-up">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      {{-- Logo --}}
      <div class="flex-shrink-0">
        <a href="{{ route('home') }}" class="flex flex-col leading-none hover:scale-105 transition-transform duration-200">
          <span class="text-4xl tracking-tighter uppercase text-primary dark:text-white font-impact">FRAMEWORK</span>
          <span class="text-[10px] tracking-ultra text-secondary dark:text-gray-400 uppercase">Supply Co.</span>
        </a>
      </div>

      {{-- Desktop Navigation --}}
      <nav class="navbar hidden md:flex items-center space-x-8">
        <a href="{{ route('home') }}" data-page="home" class="relative text-sm uppercase tracking-wider text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors group">
          Home
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary dark:bg-white group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="{{ route('products') }}" data-page="products" class="relative text-sm uppercase tracking-wider text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors group">
          Shop
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary dark:bg-white group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="{{ route('about') }}" data-page="about" class="relative text-sm uppercase tracking-wider text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors group">
          About
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary dark:bg-white group-hover:w-full transition-all duration-300"></span>
        </a>
        <a href="{{ route('contact') }}" data-page="contact" class="relative text-sm uppercase tracking-wider text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors group">
          Contact
          <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary dark:bg-white group-hover:w-full transition-all duration-300"></span>
        </a>
      </nav>

      {{-- Actions --}}
      <div class="flex items-center space-x-6">
        <button id="user-btn" class="text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors hover:scale-110 transform duration-200">
          <i data-lucide="user" class="w-5 h-5"></i>
        </button>
        <a href="{{ route('cart') }}" data-page="cart" class="relative text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors hover:scale-110 transform duration-200">
          <i data-lucide="shopping-cart" class="w-5 h-5"></i>
          <span class="absolute -top-2 -right-2 bg-primary dark:bg-white text-white dark:text-gray-900 text-xs rounded-full w-5 h-5 flex items-center justify-center" id="cart-count">0</span>
        </a>
        <button id="theme-toggle" class="hidden text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors hover:scale-110 transform duration-200" aria-label="Toggle theme">
          <i data-lucide="moon" class="w-5 h-5 block dark:hidden" id="theme-icon-light"></i>
          <i data-lucide="sun" class="w-5 h-5 hidden dark:block" id="theme-icon-dark"></i>
        </button>
        
        {{-- Mobile menu button --}}
        <button id="mobile-menu-btn" class="md:hidden text-primary dark:text-white">
          <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
      </div>
    </div>

    {{-- Mobile Navigation --}}
    <div id="mobile-menu" class="hidden md:hidden py-6 border-t border-border dark:border-gray-700">
      <nav class="flex flex-col space-y-4">
        <a href="{{ route('home') }}" data-page="home" class="text-sm uppercase tracking-wider text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors">Home</a>
        <a href="{{ route('products') }}" data-page="products" class="text-sm uppercase tracking-wider text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors">Shop</a>
        <a href="{{ route('about') }}" data-page="about" class="text-sm uppercase tracking-wider text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors">About</a>
        <a href="{{ route('contact') }}" data-page="contact" class="text-sm uppercase tracking-wider text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors">Contact</a>
      </nav>
    </div>
  </div>

  {{-- Announcement Bar --}}
  <div class="bg-primary dark:bg-white text-white dark:text-gray-900 text-center py-2 px-4">
    <p class="text-xs uppercase tracking-wider">
      <span class="animate-pulse-slow">⚡</span> NEW DROP: Winter Collection Live Now | Free Shipping Over $150 <span class="animate-pulse-slow">⚡</span>
    </p>
  </div>
</header>

<script>
  // Theme toggle functionality
  (function() {
    const THEME_KEY = 'eshop-theme';
    
    // Get saved theme or default to light
    function getTheme() {
      try {
        return localStorage.getItem(THEME_KEY) || 'light';
      } catch {
        return 'light';
      }
    }
    
    // Apply theme to document
    function applyTheme(theme) {
      if (theme === 'dark') {
        document.documentElement.classList.add('dark');
      } else {
        document.documentElement.classList.remove('dark');
      }
      try {
        localStorage.setItem(THEME_KEY, theme);
      } catch {}
    }
    
    // Apply theme immediately on load
    applyTheme(getTheme());
    
    // Toggle button click handler
    document.getElementById('theme-toggle')?.addEventListener('click', function() {
      const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      applyTheme(newTheme);
    });
  })();

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
