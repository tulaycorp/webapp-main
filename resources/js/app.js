/* E-Shop Demo JS (no external dependencies) */

// Import animations module
import './animations.js';
// Import footer animations
import './footer-animations.js';

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
  // Categories - will be loaded from database
  let CATEGORIES = [];

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

  // Load categories from database (Category model managed via admin panel)
  function loadCategories() {
    return fetch('/api/products/categories')
      .then(res => {
        if (!res.ok) throw new Error('Categories API Request Failed');
        return res.json();
      })
      .then(response => {
        if (response && response.success && response.categories) {
          CATEGORIES = response.categories;
          return CATEGORIES;
        } else {
          console.error('Failed to load categories: Invalid response', response);
          return [];
        }
      })
      .catch(error => {
        console.error('Error loading categories:', error);
        return [];
      });
  }

  // Render category filter buttons dynamically
  function renderCategoryFilters() {
    const container = document.getElementById('filter-container');
    if (!container || CATEGORIES.length === 0) return;

    // Keep the "All Products" button, remove any dynamically added ones
    const allButton = container.querySelector('[data-filter="All"]');
    container.innerHTML = '';
    if (allButton) {
      container.appendChild(allButton);
    }

    // Add category buttons
    let delay = 500;
    CATEGORIES.forEach(cat => {
      const btn = document.createElement('button');
      btn.setAttribute('data-animate', 'fade-in');
      btn.setAttribute('data-delay', delay.toString());
      btn.setAttribute('data-hover', 'lift');
      btn.setAttribute('data-filter', cat.name);
      btn.setAttribute('data-category-id', cat.id);
      btn.className = 'filter-tag px-8 py-4 uppercase text-base tracking-wider transition-all shadow-lg hover:shadow-xl bg-white dark:bg-gray-700 text-primary dark:text-white border-2 border-border dark:border-gray-600 hover:border-primary dark:hover:border-white font-medium';
      btn.textContent = cat.name;
      container.appendChild(btn);
      delay += 50;
    });

    // Bind click handlers to all filter buttons
    bindFilterButtons();

    // Trigger animations for newly added buttons
    if (window.AnimEngine) {
      const newButtons = container.querySelectorAll('[data-animate="fade-in"]');
      newButtons.forEach((btn, index) => {
        const delay = parseInt(btn.dataset.delay) || index * 100;
        window.AnimEngine.fadeIn(btn, delay);
      });

      const hoverButtons = container.querySelectorAll('[data-hover="lift"]');
      hoverButtons.forEach(btn => {
        window.AnimEngine.hoverLift(btn);
      });
    }
  }

  // Bind click handlers to filter buttons
  function bindFilterButtons() {
    const buttons = document.querySelectorAll('.filter-tag');
    buttons.forEach(btn => {
      btn.addEventListener('click', function () {
        // Update UI - remove active from all
        buttons.forEach(b => {
          b.classList.remove('active', 'bg-primary', 'text-white');
          b.classList.add('bg-white', 'text-primary');
          if (b.classList.contains('dark:bg-white')) {
            b.classList.remove('dark:bg-white', 'dark:text-gray-900');
            b.classList.add('dark:bg-gray-700', 'dark:text-white');
          }
        });

        // Add active to clicked
        this.classList.add('active');
        this.classList.remove('bg-white', 'text-primary', 'dark:bg-gray-700', 'dark:text-white');
        this.classList.add('bg-primary', 'text-white', 'dark:bg-white', 'dark:text-gray-900');

        const filter = this.getAttribute('data-filter');
        if (window.Eshop && window.Eshop.filterProducts) {
          window.Eshop.filterProducts(filter === 'All' ? '' : filter);
        }
      });
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

  let CART = loadCart();

  // Helper to get session token from localStorage
  function getSessionToken() {
    try {
      const user = JSON.parse(localStorage.getItem('eshop_user') || 'null');
      return user?.session_token || null;
    } catch { return null; }
  }

  // Sync Cart with Server (Background)
  function syncCartServer() {
    // Note: We sync even when cart is empty to handle removals

    // We need CSRF token for Laravel Post requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (!csrfToken) return;

    const sessionToken = getSessionToken();
    const headers = {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    };
    if (sessionToken) {
      headers['Authorization'] = `Bearer ${sessionToken}`;
    }

    console.log('Syncing cart to server...', CART);
    fetch('/cart/sync', {
      method: 'POST',
      credentials: 'same-origin',
      headers: headers,
      body: JSON.stringify({ cart: CART })
    }).then(res => res.json())
      .then(data => console.log('Sync response:', data))
      .catch(e => console.error('Sync error:', e));
  }

  // Load Cart from Server (Merge/Overwrite local)
  function fetchCartFromServer() {
    console.log('Fetching cart from server...');
    const sessionToken = getSessionToken();
    const headers = { 'Accept': 'application/json' };
    if (sessionToken) {
      headers['Authorization'] = `Bearer ${sessionToken}`;
    }

    fetch('/cart/data', {
      credentials: 'same-origin',
      headers: headers
    })
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

  function productCard(product, animationDelay = 0) {
    const categoryDisplay = product.category_name || product.category || 'Uncategorized';
    return `<div class="group" data-animate="fade-in" data-delay="${animationDelay}" data-hover="lift">
      <div class="modern-card dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
        <a href="/products/${product.id}" class="block relative aspect-square overflow-hidden bg-gray-100 dark:bg-gray-700">
          <img src="${product.img || product.image_url || 'https://via.placeholder.com/400'}" 
               alt="${product.name}" 
               class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
          ${product.featured ? '<span class="absolute top-4 left-4 px-3 py-1 bg-primary dark:bg-white text-white dark:text-gray-900 text-xs uppercase tracking-wider font-medium">Featured</span>' : ''}
        </a>
        <div class="p-6">
          <p class="text-xs text-secondary dark:text-gray-400 uppercase tracking-wider mb-2">${categoryDisplay}</p>
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

  // Carousel state
  let carouselState = {
    currentIndex: 0,
    itemsToShow: 3,
    autoScrollInterval: null
  };

  function renderFeatured() {
    const wrap = document.getElementById('featured-products');
    if (!wrap) return;

    const featured = CATALOG.filter(p => p.featured);

    // If no featured products, show message
    if (featured.length === 0) {
      wrap.innerHTML = '<div class="flex items-center justify-center w-full py-8"><p class="text-secondary dark:text-gray-400">No featured products available</p></div>';
      return;
    }

    // Render all featured products in carousel format
    wrap.innerHTML = featured.map(product => {
      return `<div class="flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-4">${productCard(product)}</div>`;
    }).join('');

    bindAddButtons(wrap);
    initCarousel(featured.length);
  }

  function initCarousel(totalItems) {
    const track = document.getElementById('featured-products');
    const prevBtn = document.getElementById('carousel-prev');
    const nextBtn = document.getElementById('carousel-next');
    const indicatorsContainer = document.getElementById('carousel-indicators');

    if (!track || !prevBtn || !nextBtn || !indicatorsContainer) return;

    // Determine items to show based on screen size
    function getItemsToShow() {
      if (window.innerWidth >= 1024) return 3; // lg
      if (window.innerWidth >= 768) return 2; // md
      return 1; // mobile
    }

    carouselState.itemsToShow = getItemsToShow();
    const totalSlides = Math.ceil(totalItems / carouselState.itemsToShow);

    // Create indicators
    indicatorsContainer.innerHTML = Array.from({ length: totalSlides }, (_, i) =>
      `<button type="button" class="w-2 h-2 rounded-full transition-all ${i === 0 ? 'bg-primary dark:bg-white w-8' : 'bg-gray-300 dark:bg-gray-600'}" data-slide="${i}"></button>`
    ).join('');

    // Update carousel position
    function updateCarousel(smooth = true) {
      const slideWidth = 100 / carouselState.itemsToShow;
      const offset = -carouselState.currentIndex * slideWidth * carouselState.itemsToShow;

      if (smooth) {
        track.style.transition = 'transform 500ms ease-out';
      } else {
        track.style.transition = 'none';
      }

      track.style.transform = `translateX(${offset}%)`;

      // Update button states
      prevBtn.disabled = false;
      nextBtn.disabled = false;

      // Update indicators
      const indicators = indicatorsContainer.querySelectorAll('button');
      indicators.forEach((indicator, i) => {
        if (i === carouselState.currentIndex) {
          indicator.classList.add('bg-primary', 'dark:bg-white', 'w-8');
          indicator.classList.remove('bg-gray-300', 'dark:bg-gray-600');
        } else {
          indicator.classList.remove('bg-primary', 'dark:bg-white', 'w-8');
          indicator.classList.add('bg-gray-300', 'dark:bg-gray-600');
        }
      });
    }

    // Navigation handlers
    function goToSlide(index) {
      const totalSlides = Math.ceil(totalItems / carouselState.itemsToShow);
      carouselState.currentIndex = (index + totalSlides) % totalSlides;
      updateCarousel();
      resetAutoScroll();
    }

    function nextSlide() {
      goToSlide(carouselState.currentIndex + 1);
    }

    function prevSlide() {
      goToSlide(carouselState.currentIndex - 1);
    }

    // Bind navigation buttons
    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    // Bind indicator clicks
    indicatorsContainer.addEventListener('click', (e) => {
      const slideBtn = e.target.closest('[data-slide]');
      if (slideBtn) {
        const slideIndex = parseInt(slideBtn.dataset.slide);
        goToSlide(slideIndex);
      }
    });

    // Auto-scroll functionality
    function startAutoScroll() {
      carouselState.autoScrollInterval = setInterval(() => {
        nextSlide();
      }, 4000); // 4 seconds
    }

    function stopAutoScroll() {
      if (carouselState.autoScrollInterval) {
        clearInterval(carouselState.autoScrollInterval);
        carouselState.autoScrollInterval = null;
      }
    }

    function resetAutoScroll() {
      stopAutoScroll();
      startAutoScroll();
    }

    // Pause auto-scroll when hovering any product card
    function bindHoverListeners() {
      const productCards = track.querySelectorAll('.group');
      productCards.forEach(card => {
        card.addEventListener('mouseenter', stopAutoScroll);
        card.addEventListener('mouseleave', startAutoScroll);
      });
    }

    // Initial bind
    bindHoverListeners();

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        const newItemsToShow = getItemsToShow();
        if (newItemsToShow !== carouselState.itemsToShow) {
          carouselState.itemsToShow = newItemsToShow;
          carouselState.currentIndex = 0;

          // Recreate indicators
          const totalSlides = Math.ceil(totalItems / carouselState.itemsToShow);
          indicatorsContainer.innerHTML = Array.from({ length: totalSlides }, (_, i) =>
            `<button type="button" class="w-2 h-2 rounded-full transition-all ${i === 0 ? 'bg-primary dark:bg-white w-8' : 'bg-gray-300 dark:bg-gray-600'}" data-slide="${i}"></button>`
          ).join('');

          updateCarousel(false);
        }
      }, 250);
    });

    // Start auto-scroll
    startAutoScroll();

    // Initial update
    updateCarousel(false);
  }

  function renderCatalog() {
    const grid = document.getElementById('product-grid'); if (!grid) return;
    const search = document.getElementById('search');
    const catSel = document.getElementById('filter-category');
    const sortSel = document.getElementById('sort');
    const noRes = document.getElementById('no-results');

    // Current filter state
    let currentCategory = '';

    // Populate categories dropdown if it exists (using CATEGORIES from API)
    if (catSel) {
      if (CATEGORIES.length > 0) {
        CATEGORIES.forEach(cat => {
          if (![...catSel.options].some(o => o.value === cat.name)) {
            catSel.append(new Option(cat.name, cat.name));
          }
        });
      } else {
        // Fallback to extracting from products if no categories loaded
        const cats = [...new Set(CATALOG.map(p => p.category || p.category_name).filter(Boolean))];
        cats.sort().forEach(c => {
          if (![...catSel.options].some(o => o.value === c)) catSel.append(new Option(c, c));
        });
      }
    }

    function apply() {
      let list = [...CATALOG];
      const q = search ? (search.value || '').trim().toLowerCase() : '';
      const cat = catSel ? catSel.value : currentCategory;
      if (q) list = list.filter(p => p.name.toLowerCase().includes(q));
      if (cat && cat !== 'All') {
        // Filter by category name or category_name (supports both legacy and new)
        list = list.filter(p => p.category === cat || p.category_name === cat);
      }
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
      grid.innerHTML = list.map((product, index) => productCard(product, index * 50)).join('');
      bindAddButtons(grid);

      // Trigger animations for product cards
      if (window.AnimEngine) {
        const productCards = grid.querySelectorAll('[data-animate="fade-in"]');
        productCards.forEach((card, index) => {
          const delay = parseInt(card.dataset.delay) || index * 50;
          window.AnimEngine.fadeIn(card, delay);
        });

        const hoverCards = grid.querySelectorAll('[data-hover="lift"]');
        hoverCards.forEach(card => {
          window.AnimEngine.hoverLift(card);
        });
      }

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
        empty.classList.remove('hidden');
        empty.classList.add('block');
        checkoutBtn.disabled = clearBtn.disabled = true;
      } else {
        empty.classList.add('hidden');
        empty.classList.remove('block');
        wrap.innerHTML = CART.map(item => {
          const p = getProduct(item.id);
          if (!p) {
            console.warn(`Product not found for ID: "${item.id}" (Type: ${typeof item.id}). Catalog IDs:`, CATALOG.map(c => c.id).slice(0, 3));
            return `<div class="bg-red-100 dark:bg-red-900/30 border border-red-300 dark:border-red-700 p-4 text-red-600 dark:text-red-400">Product not found: ${item.id}</div>`;
          }
          console.log(`Rendering item: ${item.id} -> ${p.name}`);
          return `
            <div style="background:white; border:1px solid #e5e7eb; padding:1.5rem; margin-bottom:1rem; display:flex; align-items:center; gap:1.5rem;" class="modern-card dark:bg-gray-800 dark:border-gray-700">
              <img src="${p.img || p.image_url || 'https://via.placeholder.com/96'}" 
                   alt="${p.name}" 
                   style="width:96px; height:96px; object-fit:cover; flex-shrink:0; background:#f3f4f6;">
              
              <div style="flex:1; min-width:0;">
                <h3 style="font-size:1.125rem; font-weight:600; text-transform:uppercase; letter-spacing:-0.025em; margin:0 0 0.25rem 0; color:#111827;" class="dark:text-white">${p.name}</h3>
                <p style="font-size:0.875rem; text-transform:uppercase; letter-spacing:0.05em; color:#64748b; margin:0 0 0.5rem 0;">${p.category || 'Apparel'}</p>
                <p style="font-family:Impact,sans-serif; font-size:1.25rem; color:#111827; margin:0;" class="dark:text-white">${formatMoney(Number(p.price))}</p>
              </div>
              
              <div style="display:flex; align-items:center; border:2px solid #e5e7eb;">
                <button style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; cursor:pointer; font-size:1.25rem; font-weight:bold;" 
                        onclick="(function(e){e.stopPropagation();var inp=document.querySelector('[data-qty=\\'${item.id}\\']');if(inp){inp.value=Math.max(1,parseInt(inp.value)-1);inp.dispatchEvent(new Event('input',{bubbles:true}));}})(event)">−</button>
                <input type="number" min="1" value="${item.qty}" data-qty="${item.id}" 
                       style="width:50px; height:40px; text-align:center; border:none; border-left:2px solid #e5e7eb; border-right:2px solid #e5e7eb; font-weight:600; font-size:1rem;">
                <button style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; border:none; background:transparent; cursor:pointer; font-size:1.25rem; font-weight:bold;"
                        onclick="(function(e){e.stopPropagation();var inp=document.querySelector('[data-qty=\\'${item.id}\\']');if(inp){inp.value=parseInt(inp.value)+1;inp.dispatchEvent(new Event('input',{bubbles:true}));}})(event)">+</button>
              </div>
              
              <div style="text-align:right; min-width:100px;">
                <p style="font-family:Impact,sans-serif; font-size:1.5rem; color:#111827; margin:0;" class="dark:text-white">${formatMoney(Number(p.price) * item.qty)}</p>
              </div>
              
              <button data-remove="${item.id}" 
                      style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; border:2px solid transparent; background:transparent; cursor:pointer; color:#64748b; transition:all 0.2s;"
                      onmouseover="this.style.color='#ef4444'; this.style.borderColor='#fecaca';"
                      onmouseout="this.style.color='#64748b'; this.style.borderColor='transparent';">
                <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            </div>`;
        }).join('');
        checkoutBtn.disabled = clearBtn.disabled = false;
      }
      const subtotal = CART.reduce((a, i) => a + (Number(getProduct(i.id)?.price || 0)) * i.qty, 0);
      const shipping = subtotal === 0 ? 0 : (subtotal >= 150 ? 0 : 10);
      const tax = subtotal * 0.08;
      const total = subtotal + shipping + tax;
      subtotalEl.textContent = formatMoney(subtotal);
      const shippingEl = document.getElementById('summary-shipping');
      if (shippingEl) {
        if (shipping === 0 && subtotal >= 150) {
          shippingEl.textContent = 'FREE';
          shippingEl.className = 'text-green-600 dark:text-green-400 text-xl font-impact';
        } else {
          shippingEl.textContent = formatMoney(shipping);
          shippingEl.className = 'text-primary dark:text-white text-2xl font-impact';
        }
      }
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
      // Require account for checkout: if not logged in, open login modal
      let user = null;
      try { user = localStorage.getItem('eshop_user'); } catch { }
      if (!user) {
        // Remember intent so we can resume after signup/login
        try { localStorage.setItem('eshop_intent', 'checkout'); } catch { }

        // Show the login modal using the same Tailwind-based approach as modal-template.blade.php
        const modal = document.getElementById('login-modal');
        if (modal) {
          modal.classList.remove('hidden');
          modal.classList.add('flex');
          document.body.style.overflow = 'hidden';
        } else {
          alert('Please log in to continue to checkout.');
        }
        return; // stop normal checkout until user signs up/logs in
      }

      // Navigate to checkout page when logged in
      window.location.href = '/checkout';
    });
    draw();
  }

  function aboutStats() {
    const pEl = document.getElementById('stat-products');
    const cEl = document.getElementById('stat-categories');
    const ciEl = document.getElementById('stat-cart-items');
    if (pEl) pEl.textContent = CATALOG.length;
    if (cEl) cEl.textContent = CATEGORIES.length || new Set(CATALOG.map(p => p.category)).size;
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
        // Load both categories and products, then render
        Promise.all([loadCategories(), loadCatalog()]).then(function () {
          renderCategoryFilters();
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
        Promise.all([loadCategories(), loadCatalog()]).then(function () {
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
