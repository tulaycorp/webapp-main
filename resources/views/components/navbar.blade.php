{{-- NAVBAR COMPONENT --}}
<header class="fixed top-0 left-0 right-0 bg-white/98 dark:bg-gray-900/98 backdrop-blur-lg text-primary dark:text-white z-50 border-b border-border dark:border-gray-700 animate-slide-up">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      {{-- Logo --}}
      <div class="flex-shrink-0">
        <a href="{{ route('home') }}" class="flex flex-col leading-none hover:scale-105 transition-transform duration-200">
          <span class="text-4xl tracking-[-0.05em] uppercase text-primary dark:text-white font-impact">FRAMEWORK</span>
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
        {{-- User Button with Dropdown --}}
        <div class="relative" id="user-menu-container">
          <button id="user-btn" class="text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors hover:scale-110 transform duration-200">
            <i data-lucide="user" class="w-5 h-5"></i>
          </button>
          {{-- User Dropdown Menu (shown when logged in) --}}
          <div id="user-dropdown" class="absolute right-0 top-full mt-2 w-48 bg-white dark:bg-gray-800 border-2 border-primary dark:border-gray-600 shadow-xl hidden z-50">
            <div id="user-dropdown-header" class="px-4 py-3 border-b border-border dark:border-gray-700">
              <p class="text-xs uppercase tracking-wider text-secondary dark:text-gray-400">Signed in as</p>
              <p class="text-sm font-semibold text-primary dark:text-white truncate" id="user-dropdown-name">User</p>
            </div>
            <a href="/orders" class="flex items-center gap-3 px-4 py-3 text-sm text-primary dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <i data-lucide="package" class="w-4 h-4"></i>
              <span>My Orders</span>
            </a>
            <a href="/account" class="flex items-center gap-3 px-4 py-3 text-sm text-primary dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <i data-lucide="user-cog" class="w-4 h-4"></i>
              <span>My Account</span>
            </a>
            <button id="user-dropdown-signout" class="flex items-center gap-3 px-4 py-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors w-full text-left border-t border-border dark:border-gray-700">
              <i data-lucide="log-out" class="w-4 h-4"></i>
              <span>Sign Out</span>
            </button>
          </div>
        </div>
        {{-- Cart Button with Preview --}}
        <div class="relative" id="cart-menu-container">
          <a href="{{ route('cart') }}" id="cart-btn" data-page="cart" class="relative text-secondary dark:text-gray-300 hover:text-primary dark:hover:text-white transition-colors hover:scale-110 transform duration-200">
            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
            <span class="absolute -top-2 -right-2 bg-primary dark:bg-white text-white dark:text-gray-900 text-xs rounded-full w-5 h-5 flex items-center justify-center" id="cart-count">0</span>
          </a>
          {{-- Cart Preview Dropdown --}}
          <div id="cart-preview" class="absolute right-0 top-full mt-2 w-80 bg-white dark:bg-gray-800 border-2 border-primary dark:border-gray-600 shadow-xl hidden z-50 max-h-96 overflow-y-auto">
            <div class="px-4 py-3 border-b border-border dark:border-gray-700">
              <p class="text-sm font-semibold text-primary dark:text-white">Shopping Cart</p>
            </div>
            <div id="cart-preview-items" class="divide-y divide-border dark:divide-gray-700">
              <p class="px-4 py-8 text-center text-sm text-secondary dark:text-gray-400">Your cart is empty</p>
            </div>
            <div class="px-4 py-3 border-t border-border dark:border-gray-700">
              <a href="{{ route('cart') }}" class="block w-full text-center py-2 bg-primary dark:bg-white text-white dark:text-gray-900 text-sm uppercase tracking-wider font-medium hover:opacity-90 transition-opacity">
                View Cart
              </a>
            </div>
          </div>
        </div>
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
  {{-- Announcement Bar --}}
  @if($announcement_enabled ?? false)
  <div id="announcement-bar" class="bg-primary dark:bg-white text-white dark:text-gray-900 text-center py-2 px-4 relative transition-all duration-300">
    <p class="text-xs uppercase tracking-wider pr-6">
      {{ $announcement_message ?? '' }}
    </p>
    <button id="close-announcement" class="absolute right-2 top-1/2 -translate-y-1/2 p-1 hover:opacity-70 transition-opacity" aria-label="Close announcement">
      <i data-lucide="x" class="w-3 h-3"></i>
    </button>
  </div>
  <script>
      (function() {
          const bar = document.getElementById('announcement-bar');
          const btn = document.getElementById('close-announcement');
          // Check if previously dismissed in this session
          if (sessionStorage.getItem('announcement_dismissed') === 'true') {
              bar?.remove();
          }
          
          btn?.addEventListener('click', function() {
              bar.style.height = '0';
              bar.style.padding = '0';
              bar.style.overflow = 'hidden';
              sessionStorage.setItem('announcement_dismissed', 'true');
              setTimeout(() => bar.remove(), 300);
          });
      })();
  </script>
  @endif
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

  // User menu dropdown functionality with hover
  (function() {
    const userBtn = document.getElementById('user-btn');
    const userDropdown = document.getElementById('user-dropdown');
    const userDropdownName = document.getElementById('user-dropdown-name');
    const userDropdownSignout = document.getElementById('user-dropdown-signout');
    const userContainer = document.getElementById('user-menu-container');
    
    let userHoverTimeout = null;
    
    if (!userBtn || !userDropdown) return;
    
    function isLoggedIn() {
      try {
        const user = localStorage.getItem('eshop_user');
        return user && JSON.parse(user)?.session_token;
      } catch { return false; }
    }
    
    function getUserData() {
      try {
        return JSON.parse(localStorage.getItem('eshop_user') || 'null');
      } catch { return null; }
    }
    
    function showDropdown() {
      const user = getUserData();
      if (user && userDropdownName) {
        userDropdownName.textContent = user.first_name || user.email || 'User';
      }
      userDropdown.classList.remove('hidden');
      if (window.lucide) window.lucide.createIcons();
    }
    
    function hideDropdown() {
      userDropdown.classList.add('hidden');
    }
    
    function showLoginModal() {
      const modal = document.getElementById('login-modal');
      if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
      }
    }
    
    // Hover handlers
    if (userContainer) {
      userContainer.addEventListener('mouseenter', () => {
        if (userHoverTimeout) clearTimeout(userHoverTimeout);
        if (isLoggedIn()) {
          userHoverTimeout = setTimeout(() => showDropdown(), 200);
        }
      });
      
      userContainer.addEventListener('mouseleave', () => {
        if (userHoverTimeout) clearTimeout(userHoverTimeout);
        // Don't auto-hide if the login modal is showing
        const loginModal = document.getElementById('login-modal');
        const isModalVisible = loginModal && !loginModal.classList.contains('hidden');
        if (!isModalVisible) {
          userHoverTimeout = setTimeout(() => hideDropdown(), 300);
        }
      });
    }
    
    // User button click
    userBtn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      
      if (isLoggedIn()) {
        // Toggle dropdown
        if (userDropdown.classList.contains('hidden')) {
          showDropdown();
        } else {
          hideDropdown();
        }
      } else {
        // Show login modal
        showLoginModal();
      }
    });
    
    // Sign out button click
    userDropdownSignout?.addEventListener('click', (e) => {
        e.preventDefault();
        hideDropdown();
        if (window.EshopModals && window.EshopModals.showSignout) {
            window.EshopModals.showSignout();
        } else if (window.LoginHandler && window.LoginHandler.showSignoutModal) {
            // Fallback for pages that might load legacy login.js
            window.LoginHandler.showSignoutModal();
        } else {
            console.error('No modal handler found (EshopModals or LoginHandler)');
            // Last resort fallback
            if(confirm('Are you sure you want to sign out?')) {
                 localStorage.removeItem('eshop_user');
                 window.location.reload();
            }
        }
    });
    
    // Click outside to close dropdown
    document.addEventListener('click', (e) => {
      if (!userDropdown.classList.contains('hidden')) {
        const container = document.getElementById('user-menu-container');
        if (container && !container.contains(e.target)) {
          hideDropdown();
        }
      }
    });
    
    // ESC key to close dropdown
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !userDropdown.classList.contains('hidden')) {
        hideDropdown();
      }
    });
  })();
  
  // Cart preview functionality with hover
  (function() {
    const cartBtn = document.getElementById('cart-btn');
    const cartPreview = document.getElementById('cart-preview');
    const cartPreviewItems = document.getElementById('cart-preview-items');
    const cartContainer = document.getElementById('cart-menu-container');
    
    let cartHoverTimeout = null;
    const STORAGE_KEY = 'eshop-cart-v1';
    
    if (!cartBtn || !cartPreview || !cartPreviewItems) return;
    
    function loadCart() {
      try { return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); } catch { return []; }
    }
    
    function formatMoney(n) { return `$${n.toFixed(2)}`; }
    
    async function renderCartPreview() {
      const cart = loadCart();
      
      if (cart.length === 0) {
        cartPreviewItems.innerHTML = '<p class="px-4 py-8 text-center text-sm text-secondary dark:text-gray-400">Your cart is empty</p>';
        return;
      }
      
      // Use the global getProduct helper if available
      const getProduct = window.Eshop?.getProduct;
      if (!getProduct) {
        console.warn('window.Eshop.getProduct not available yet');
        cartPreviewItems.innerHTML = '<p class="px-4 py-8 text-center text-sm text-secondary dark:text-gray-400">Loading...</p>';
        return;
      }
      
      cartPreviewItems.innerHTML = cart.map(item => {
        const product = getProduct(item.id);
        if (!product) return '';
        
        return `
          <div class="px-4 py-3 flex items-center gap-3">
            <img src="${product.image_url || product.img || 'https://via.placeholder.com/48'}" 
                 alt="${product.name}" 
                 class="w-12 h-12 object-cover bg-gray-100 dark:bg-gray-700 flex-shrink-0">
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-primary dark:text-white truncate">${product.name}</p>
              <p class="text-xs text-secondary dark:text-gray-400">Qty: ${item.qty}</p>
            </div>
            <p class="text-sm font-semibold text-primary dark:text-white">${formatMoney(product.price * item.qty)}</p>
          </div>
        `;
      }).join('');
      
      if (window.lucide) window.lucide.createIcons();
    }
    
    function showCartPreview() {
      renderCartPreview();
      cartPreview.classList.remove('hidden');
    }
    
    function hideCartPreview() {
      cartPreview.classList.add('hidden');
    }
    
    // Hover handlers
    if (cartContainer) {
      cartContainer.addEventListener('mouseenter', () => {
        if (cartHoverTimeout) clearTimeout(cartHoverTimeout);
        cartHoverTimeout = setTimeout(() => showCartPreview(), 200);
      });
      
      cartContainer.addEventListener('mouseleave', () => {
        if (cartHoverTimeout) clearTimeout(cartHoverTimeout);
        cartHoverTimeout = setTimeout(() => hideCartPreview(), 300);
      });
    }
    
    // Listen for cart updates
    window.addEventListener('cart-updated', () => {
      if (!cartPreview.classList.contains('hidden')) {
        renderCartPreview();
      }
    });
    
    // Click outside to close
    document.addEventListener('click', (e) => {
      if (!cartPreview.classList.contains('hidden')) {
        if (cartContainer && !cartContainer.contains(e.target)) {
          hideCartPreview();
        }
      }
    });
    
    // ESC key to close
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !cartPreview.classList.contains('hidden')) {
        hideCartPreview();
      }
    });
  })();
</script>
