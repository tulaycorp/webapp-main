/* E-Shop Demo JS (no external dependencies) */
(function () {
  // Component loader function
  async function loadComponent(componentName, targetSelector) {
    // If the component already exists in DOM (e.g., added via PHP include), skip fetch
    // If the component already exists in DOM (e.g., added via PHP include), skip fetch
    if (componentName === 'navbar' && document.querySelector('nav.navbar')) {
      setActiveNavigation();
      return;
    }
    if (componentName === 'modal-template' && document.getElementById('login-modal')) return;
    if (componentName === 'footer' && document.querySelector('footer')) return;

    const response = await fetch(`../components/${componentName}.html`);
    if (!response.ok) throw new Error(`Failed to load ${componentName}`);
    const html = await response.text();
    const targetElement = document.querySelector(targetSelector);
    if (targetElement) {
      if (targetSelector === 'body') {
        // Append to body for modals
        targetElement.insertAdjacentHTML('beforeend', html);
      } else {
        // Replace content for other components
        targetElement.innerHTML = html;
      }
      // Set active navigation state for navbar
      if (componentName === 'navbar') {
        setActiveNavigation();
      }
    }
  }
  // Set active navigation state
  function setActiveNavigation() {
    const last = window.location.pathname.split('/').pop();
    const currentPage = last.replace('.html', '').replace('.php', '');
    const navLinks = document.querySelectorAll('.nav-link[data-page]');

    navLinks.forEach(link => {
      const linkPage = link.getAttribute('data-page');
      if ((currentPage === 'bootstrap' && linkPage === 'home') ||
        (currentPage === linkPage) ||
        (currentPage === 'signup' && linkPage === 'home')) { // signup page shows home as active
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }

  // Set active navigation based on current page
  function setActiveNavigation() {
    const last = window.location.pathname.split('/').pop();
    const currentPage = last.replace('.html', '').replace('.php', '');
    const navLinks = document.querySelectorAll('.nav-link[data-page]');

    navLinks.forEach(link => {
      const linkPage = link.getAttribute('data-page');
      if ((currentPage === 'bootstrap' && linkPage === 'home') ||
        (currentPage === linkPage) ||
        (currentPage === 'signup' && linkPage === 'home')) { // signup page shows home as active
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }

  const STORAGE_KEY = 'eshop-cart-v1';
  const THEME_STORAGE_KEY = 'eshop-theme';
  // Product catalog - will be loaded from database
  let CATALOG = [];

  // Load products from database
  function loadCatalog() {
    return fetch('/api/products.php?action=list')
      .then(res => {
        if (!res.ok) throw new Error('API Request Failed');
        return res.json();
      })
      .then(response => {
        if (response && response.success && response.products) {
          CATALOG = response.products;
          return CATALOG;
        } else {
          console.error('Failed to load products: Invalid response', response);
          return [];
        }
      })
      .catch(error => {
        console.error('Error loading catalog:', error);
        return [];
      });
  }

  function loadCart() {
    try { return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); } catch { return []; }
  }
  function saveCart(cart, skipSync = false) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
    updateCartCount(cart);
    window.dispatchEvent(new CustomEvent('cart-updated', { detail: cart }));
    if (!skipSync) syncCartServer(); // Sync with server
  }
  function updateCartCount(cart) {
    const el = document.getElementById('cart-count');
    if (el) el.textContent = cart.reduce((a, i) => a + i.qty, 0);
  }

  function getProduct(id) {
    return CATALOG.find(p => p.id == id);
  }
  function formatMoney(n) { return `$${n.toFixed(2)}`; }

  // Shared state
  let CART = loadCart();

  // Sync Cart with Server (Background)
  function syncCartServer() {
    if (CART.length === 0) return;

    // We need CSRF token for Laravel Post requests
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!token) return;

    console.log('Syncing cart to server...', CART);
    fetch('/cart/sync', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ cart: CART })
    }).then(res => res.json())
      .then(data => console.log('Sync response:', data))
      .catch(e => console.error('Sync error:', e));
  }

  // Load Cart from Server (Merge/Overwrite local)
  function fetchCartFromServer() {
    console.log('Fetching cart from server...');
    fetch('/cart/data')
      .then(res => res.json())
      .then(data => {
        console.log('Server cart response:', data);
        if (data && data.items) {
          // Simple strategy: Server is source of truth if we trust it.
          // Map server items to local format
          const serverItems = data.items.map(i => ({ id: i.product_id, qty: i.quantity }));

          if (serverItems.length > 0) {
            console.log('Server has items, updating local cart:', serverItems);
            CART = serverItems;
            saveCart(CART, true);
          } else if (CART.length > 0) {
            console.warn('Server cart is empty but local has items. Keeping local and syncing UP.');
            syncCartServer();
          }
        }
      }).catch(e => console.error('Error fetching cart:', e));
  }

  // Initial sync on load (Fetch latest state)
  fetchCartFromServer();

  function addToCart(id) {
    // Ensure id is compared loosely or converted
    const existing = CART.find(i => i.id == id);
    if (existing) {
      existing.qty++;
    } else {
      CART.push({ id: id, qty: 1 });
    }
    saveCart(CART);
  }
  function removeFromCart(id) {
    CART = CART.filter(i => i.id != id); saveCart(CART);
  }
  function setQty(id, qty) {
    const item = CART.find(i => i.id == id); if (!item) return; item.qty = Math.max(1, qty); saveCart(CART);
  }
  function clearCart() { CART = []; saveCart(CART); }

  function slugify(text) {
    return text.toString().toLowerCase()
      .replace(/\s+/g, '-')           // Replace spaces with -
      .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
      .replace(/\-\-+/g, '-')         // Replace multiple - with single -
      .replace(/^-+/, '')             // Trim - from start
      .replace(/-+$/, '');            // Trim - from end
  }

  function productCard(product) {
    return `<div class="group">
      <div class="modern-card dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
        <a href="/products/${product.id}" class="block relative aspect-square overflow-hidden bg-gray-100 dark:bg-gray-700">
          <img src="${product.img || product.image_url || 'https://via.placeholder.com/400'}" 
               alt="${product.name}" 
               class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          ${product.featured ? '<span class="absolute top-4 left-4 px-3 py-1 bg-primary dark:bg-white text-white dark:text-gray-900 text-xs uppercase tracking-wider font-medium">Featured</span>' : ''}
        </a>
        <div class="p-6">
          <p class="text-xs text-secondary dark:text-gray-400 uppercase tracking-wider mb-2">${product.category || 'Uncategorized'}</p>
          <a href="/products/${product.id}" class="block">
            <h3 class="text-lg font-semibold text-primary dark:text-white mb-2 truncate group-hover:text-secondary transition-colors">${product.name}</h3>
          </a>
          <div class="flex items-center justify-between">
            <span class="text-xl font-bold text-primary dark:text-white">${formatMoney(product.price)}</span>
            <button data-add="${product.id}" 
                    class="px-4 py-2 bg-primary dark:bg-white text-white dark:text-gray-900 text-sm uppercase tracking-wider font-medium hover:opacity-90 transition-opacity">
              Add
            </button>
          </div>
        </div>
      </div>
    </div>`;
  }

  function bindAddButtons(container) {
    container.querySelectorAll('[data-add]').forEach(btn => {
      btn.addEventListener('click', e => {
        addToCart(btn.getAttribute('data-add'));
        btn.blur();
        // Visual feedback similar to modern app
        const originalText = btn.textContent.trim();
        btn.textContent = 'Added!';
        btn.classList.add('btn-success');
        setTimeout(() => {
          btn.textContent = originalText;
          btn.classList.remove('btn-success');
        }, 900);
      });
    });
  }

  function renderFeatured() {
    const wrap = document.getElementById('featured-products'); if (!wrap) return;
    const featured = CATALOG.filter(p => p.featured).slice(0, 3);
    wrap.innerHTML = featured.map(productCard).join('');
    bindAddButtons(wrap);
  }

  function renderCatalog() {
    const grid = document.getElementById('product-grid'); if (!grid) return;
    const search = document.getElementById('search');
    const catSel = document.getElementById('filter-category');
    const sortSel = document.getElementById('sort');
    const noRes = document.getElementById('no-results');

    // Current filter state
    let currentCategory = '';

    // Populate categories dropdown if it exists
    if (catSel) {
      const cats = [...new Set(CATALOG.map(p => p.category))];
      cats.sort().forEach(c => { if (![...catSel.options].some(o => o.value === c)) catSel.append(new Option(c, c)); });
    }

    function apply() {
      let list = [...CATALOG];
      const q = search ? (search.value || '').trim().toLowerCase() : '';
      const cat = catSel ? catSel.value : currentCategory;
      if (q) list = list.filter(p => p.name.toLowerCase().includes(q));
      if (cat && cat !== 'All') list = list.filter(p => p.category === cat);
      if (sortSel) {
        switch (sortSel.value) {
          case 'price-asc': list.sort((a, b) => a.price - b.price); break;
          case 'price-desc': list.sort((a, b) => b.price - a.price); break;
          case 'alpha': list.sort((a, b) => a.name.localeCompare(b.name)); break;
          default: list.sort((a, b) => (b.featured ? 1 : 0) - (a.featured ? 1 : 0));
        }
      } else {
        list.sort((a, b) => (b.featured ? 1 : 0) - (a.featured ? 1 : 0));
      }
      grid.innerHTML = list.map(productCard).join('');
      bindAddButtons(grid);
      if (noRes) noRes.classList.toggle('d-none', list.length > 0);
      if (noRes) noRes.classList.toggle('hidden', list.length > 0);
    }

    // Bind events if elements exist
    if (search) ['input', 'change'].forEach(ev => search.addEventListener(ev, apply));
    if (catSel) ['input', 'change'].forEach(ev => catSel.addEventListener(ev, apply));
    if (sortSel) ['input', 'change'].forEach(ev => sortSel.addEventListener(ev, apply));

    const resetBtn = document.getElementById('reset');
    if (resetBtn) {
      resetBtn.addEventListener('click', () => {
        if (search) search.value = '';
        if (catSel) catSel.value = '';
        if (sortSel) sortSel.value = 'featured';
        currentCategory = '';
        apply();
      });
    }

    // Support for tag-based filtering (products page)
    window.Eshop.filterProducts = function (category) {
      currentCategory = category;
      apply();
    };

    apply();
  }

  function renderCart() {
    const wrap = document.getElementById('cart-items'); if (!wrap) return;
    const empty = document.getElementById('cart-empty');
    const subtotalEl = document.getElementById('summary-subtotal');
    const taxEl = document.getElementById('summary-tax');
    const totalEl = document.getElementById('summary-total');
    const checkoutBtn = document.getElementById('checkout');
    const clearBtn = document.getElementById('clear-cart');
    const checkoutMsg = document.getElementById('checkout-msg');

    function draw() {
      console.log('Drawing Cart. Items:', CART.length, 'Catalog size:', CATALOG.length);

      if (CART.length === 0) {
        wrap.innerHTML = '';
        empty.classList.remove('d-none');
        checkoutBtn.disabled = clearBtn.disabled = true;
      } else {
        empty.classList.add('d-none');
        wrap.innerHTML = CART.map(item => {
          const p = getProduct(item.id);
          if (!p) {
            console.warn(`Product not found for ID: "${item.id}" (Type: ${typeof item.id}). Catalog IDs:`, CATALOG.map(c => c.id).slice(0, 3));
            return `<div class="text-danger p-2">Product not found: ${item.id}</div>`;
          }
          console.log(`Rendering item: ${item.id} -> ${p.name}`);
          return `<div class="card shadow-sm"><div class="card-body d-flex align-items-center gap-3 flex-wrap">
            <img src="${p.img || p.image_url || 'https://via.placeholder.com/60'}" alt="${p.name}" class="rounded" style="width:90px;height:60px;object-fit:cover;">
            <div class="flex-grow-1">
              <h5 class="mb-1">${p.name}</h5>
              <div class="small text-muted">${formatMoney(Number(p.price))} each</div>
            </div>
            <div class="d-flex align-items-center gap-2">
              <input type="number" min="1" value="${item.qty}" data-qty="${item.id}" class="form-control form-control-sm" style="width:80px;" />
              <button class="btn btn-outline-danger btn-sm" data-remove="${item.id}">×</button>
            </div>
            <div class="ms-auto fw-semibold">${formatMoney(Number(p.price) * item.qty)}</div>
          </div></div>`;
        }).join('');
        checkoutBtn.disabled = clearBtn.disabled = false;
      }
      const subtotal = CART.reduce((a, i) => a + (Number(getProduct(i.id)?.price || 0)) * i.qty, 0);
      const tax = subtotal * 0.08;
      const total = subtotal + tax;
      subtotalEl.textContent = formatMoney(subtotal);
      taxEl.textContent = formatMoney(tax);
      totalEl.textContent = formatMoney(total);
      updateCartCount(CART);
    }

    // Listen for external cart updates (e.g. from server sync)
    window.addEventListener('cart-updated', draw);

    wrap.addEventListener('input', e => {
      const id = e.target.getAttribute('data-qty');
      if (id) setQty(id, parseInt(e.target.value, 10) || 1);
      draw();
    });
    wrap.addEventListener('click', e => {
      const btn = e.target.closest('[data-remove]');
      if (btn) { removeFromCart(btn.getAttribute('data-remove')); draw(); }
    });
    clearBtn.addEventListener('click', () => { clearCart(); draw(); });
    checkoutBtn.addEventListener('click', () => {
      // Require account for checkout: if not logged in, open Create Account modal
      let user = null;
      try { user = localStorage.getItem('eshop_user'); } catch { }
      if (!user) {
        // Remember intent so we can resume after signup/login
        try { localStorage.setItem('eshop_intent', 'checkout'); } catch { }
        if (window.LoginHandler && typeof window.LoginHandler.showLoginModal === 'function') {
          window.LoginHandler.showLoginModal();
        } else {
          // Fallback: best-effort to show the login modal
          const modal = document.getElementById('login-modal');
          if (modal) {
            modal.classList.remove('d-none');
            modal.classList.add('show');
            modal.style.display = 'block';
            if (!document.querySelector('.modal-backdrop')) {
              const bd = document.createElement('div');
              bd.className = 'modal-backdrop fade show';
              document.body.appendChild(bd);
            }
            document.body.classList.add('modal-open');
          } else {
            alert('Please log in to continue to checkout.');
          }
        }
        return; // stop normal checkout until user signs up/logs in
      }

      // Proceed with demo checkout flow when logged in
      checkoutMsg.classList.remove('d-none');
      clearCart();
      draw();
      setTimeout(() => checkoutMsg.classList.add('d-none'), 2500);
    });
    draw();
  }

  function aboutStats() {
    const pEl = document.getElementById('stat-products');
    const cEl = document.getElementById('stat-categories');
    const ciEl = document.getElementById('stat-cart-items');
    if (pEl) pEl.textContent = CATALOG.length;
    if (cEl) cEl.textContent = new Set(CATALOG.map(p => p.category)).size;
    if (ciEl) ciEl.textContent = CART.reduce((a, i) => a + i.qty, 0);
  }

  function contactForm() {
    const form = document.getElementById('contact-form'); if (!form) return;
    // If jQuery Validation is present, let it manage submission/validation to avoid duplicate handlers
    if (window.jQuery && window.jQuery.fn && window.jQuery.fn.validate) {
      return;
    }
    form.addEventListener('submit', e => {
      e.preventDefault();
      // Form submission logic would go here
      form.reset();
    });
  }

  // Page initializers
  window.Eshop = {
    pages: {
      home() {
        loadCatalog().then(function () {
          renderFeatured();
          updateCartCount(CART);
        });
      },
      products() {
        loadCatalog().then(function () {
          renderCatalog();
          updateCartCount(CART);
        });
      },
      cart() {
        loadCatalog().then(function () {
          renderCart();
        });
      },
      about() {
        loadCatalog().then(function () {
          aboutStats();
          updateCartCount(CART);
        });
      },
      contact() { contactForm(); updateCartCount(CART); }
    }
  };

  // Initialization Logic
  async function init() {
    // Load navbar component first
    await loadComponent('navbar', '#navbar-container');

    // Load modal components on all pages
    await loadComponent('modal-template', 'body');

    // Load footer component on all pages
    await loadComponent('footer', '#footer-container');

    // Small delay to ensure navbar and modals are loaded before initializing functionality
    setTimeout(() => {
      // Check if modals are available
      const loginModal = document.getElementById('login-modal');
      const signupModal = document.getElementById('signup-modal');

      if (loginModal && signupModal) {
        console.log('Modals found, initializing login functionality');
        // Initialize login functionality after modals are loaded
        if (window.LoginHandler && typeof window.LoginHandler.init === 'function') {
          window.LoginHandler.init();
        }
      } else {
        console.warn('Modals not found, login functionality may not work properly');
      }

      // Theme toggle wiring
      const btn = document.getElementById('theme-toggle');
      function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        document.documentElement.setAttribute('data-bs-theme', theme === 'dark' ? 'dark' : 'light');
        try { localStorage.setItem(THEME_STORAGE_KEY, theme); } catch { }
        if (btn) {
          const emoji = btn.querySelector('#theme-emoji');
          if (emoji) {
            emoji.textContent = theme === 'dark' ? '☀️' : '🌙';
          }
          btn.setAttribute('aria-pressed', theme === 'dark');
        }
      }
      if (btn) {
        // Initialize icon and aria state
        const current = document.documentElement.getAttribute('data-theme') || 'light';
        const emoji = btn.querySelector('#theme-emoji');
        if (emoji) {
          emoji.textContent = current === 'dark' ? '☀️' : '🌙';
        }
        btn.setAttribute('aria-pressed', current === 'dark');
        if (window.jQuery) {
          window.jQuery(btn).on('click', function (e) {
            if (e && typeof e.preventDefault === 'function') e.preventDefault();
            const t = (document.documentElement.getAttribute('data-theme') === 'dark') ? 'light' : 'dark';
            applyTheme(t);
          });
        } else {
          btn.addEventListener('click', (e) => {
            if (e && typeof e.preventDefault === 'function') e.preventDefault();
            const t = (document.documentElement.getAttribute('data-theme') === 'dark') ? 'light' : 'dark';
            applyTheme(t);
          });
        }
      }

      // If featured products container exists treat as home
      if (document.getElementById('featured-products')) window.Eshop.pages.home();
      // If product grid exists treat as products page
      if (document.getElementById('product-grid')) window.Eshop.pages.products();
      // If cart items container exists treat as cart page
      if (document.getElementById('cart-items')) window.Eshop.pages.cart();
      // If contact form exists treat as contact page
      if (document.getElementById('contact-form')) window.Eshop.pages.contact();
      // If about stats exists treat as about page
      if (document.getElementById('stat-products')) window.Eshop.pages.about();

      // Bind any static add buttons (e.g. PDP)
      bindAddButtons(document);
    }, 200); // Increased delay to ensure modals are fully loaded
  }

  // Auto-detect page by body data attribute in future (simpler: look for known anchor)
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Initial badge update
  updateCartCount(CART);
})();
