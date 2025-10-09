/* E-Shop Client-side Application */
class EShopApp {
  constructor() {
    this.cart = this.loadCart();
    this.currentUser = null;
    this.apiBase = '/api';
    this.init();
  }

  // Initialize the application
  init() {
    this.updateCartCount();
    this.initTheme();
    this.initPage();
    this.bindGlobalEvents();
  }

  // Cart management
  loadCart() {
    try {
      return JSON.parse(localStorage.getItem('eshop-cart-v1') || '[]');
    } catch {
      return [];
    }
  }

  saveCart() {
    localStorage.setItem('eshop-cart-v1', JSON.stringify(this.cart));
    this.updateCartCount();
  }

  updateCartCount() {
    const countEl = document.getElementById('cart-count');
    if (countEl) {
      const total = this.cart.reduce((sum, item) => sum + item.qty, 0);
      countEl.textContent = total;
    }
  }

  addToCart(productId) {
    const existing = this.cart.find(item => item.id === productId);
    if (existing) {
      existing.qty++;
    } else {
      this.cart.push({ id: productId, qty: 1 });
    }
    this.saveCart();
  }

  removeFromCart(productId) {
    this.cart = this.cart.filter(item => item.id !== productId);
    this.saveCart();
  }

  updateQuantity(productId, qty) {
    const item = this.cart.find(item => item.id === productId);
    if (item && qty > 0) {
      item.qty = qty;
      this.saveCart();
    }
  }

  clearCart() {
    this.cart = [];
    this.saveCart();
  }

  // API calls
  async fetchProducts(filters = {}) {
    try {
      const params = new URLSearchParams(filters);
      const response = await fetch(`${this.apiBase}/products?${params}`);
      return await response.json();
    } catch (error) {
      console.error('Error fetching products:', error);
      return [];
    }
  }

  async fetchProduct(id) {
    try {
      const response = await fetch(`${this.apiBase}/products/${id}`);
      return await response.json();
    } catch (error) {
      console.error('Error fetching product:', error);
      return null;
    }
  }

  async fetchCategories() {
    try {
      const response = await fetch(`${this.apiBase}/categories`);
      return await response.json();
    } catch (error) {
      console.error('Error fetching categories:', error);
      return [];
    }
  }

  async submitContact(formData) {
    try {
      const response = await fetch(`${this.apiBase}/contact`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      });
      return await response.json();
    } catch (error) {
      console.error('Error submitting contact form:', error);
      return { error: 'Failed to send message' };
    }
  }

  async register(userData) {
    try {
      const response = await fetch(`${this.apiBase}/auth/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(userData)
      });
      return await response.json();
    } catch (error) {
      console.error('Error registering user:', error);
      return { error: 'Registration failed' };
    }
  }

  async login(credentials) {
    try {
      const response = await fetch(`${this.apiBase}/auth/login`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(credentials)
      });
      return await response.json();
    } catch (error) {
      console.error('Error logging in:', error);
      return { error: 'Login failed' };
    }
  }

  // Theme management
  initTheme() {
    const themeBtn = document.getElementById('theme-toggle');
    if (themeBtn) {
      const currentTheme = this.getCurrentTheme();
      this.applyTheme(currentTheme);
      themeBtn.addEventListener('click', () => {
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        this.applyTheme(newTheme);
      });
    }
  }

  getCurrentTheme() {
    try {
      return localStorage.getItem('eshop-theme') || 
             (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    } catch {
      return 'light';
    }
  }

  applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    document.documentElement.setAttribute('data-bs-theme', theme === 'dark' ? 'dark' : 'light');
    try {
      localStorage.setItem('eshop-theme', theme);
    } catch {}
    
    const btn = document.getElementById('theme-toggle');
    if (btn) {
      btn.textContent = theme === 'dark' ? 'Light' : 'Dark';
      btn.setAttribute('aria-pressed', theme === 'dark');
    }
  }

  // Utility functions
  formatMoney(amount) {
    return `$${amount.toFixed(2)}`;
  }

  // Page initialization
  initPage() {
    const page = this.detectPage();
    switch (page) {
      case 'home':
        this.initHomePage();
        break;
      case 'products':
        this.initProductsPage();
        break;
      case 'cart':
        this.initCartPage();
        break;
      case 'about':
        this.initAboutPage();
        break;
      case 'contact':
        this.initContactPage();
        break;
    }
  }

  detectPage() {
    const path = window.location.pathname;
    if (path.includes('products')) return 'products';
    if (path.includes('cart')) return 'cart';
    if (path.includes('about')) return 'about';
    if (path.includes('contact')) return 'contact';
    return 'home';
  }

  // Page-specific initialization
  async initHomePage() {
    const container = document.getElementById('featured-products');
    if (container) {
      const products = await this.fetchProducts({ featured: 'true' });
      const limitedProducts = products.slice(0, 3);
      container.innerHTML = limitedProducts.map(product => this.createProductCard(product)).join('');
      this.bindAddToCartButtons(container);
    }
  }

  async initProductsPage() {
    const grid = document.getElementById('product-grid');
    if (!grid) return;

    // Populate filters
    await this.initProductFilters();
    
    // Initial load
    await this.loadAndDisplayProducts();
  }

  async initProductFilters() {
    const categorySelect = document.getElementById('filter-category');
    if (categorySelect) {
      const categories = await this.fetchCategories();
      categories.forEach(category => {
        if (![...categorySelect.options].some(option => option.value === category)) {
          categorySelect.appendChild(new Option(category, category));
        }
      });
    }

    // Bind filter events
    const search = document.getElementById('search');
    const categoryFilter = document.getElementById('filter-category');
    const sortSelect = document.getElementById('sort');
    const resetBtn = document.getElementById('reset');

    const applyFilters = () => this.loadAndDisplayProducts();

    if (search) search.addEventListener('input', applyFilters);
    if (categoryFilter) categoryFilter.addEventListener('change', applyFilters);
    if (sortSelect) sortSelect.addEventListener('change', applyFilters);
    if (resetBtn) {
      resetBtn.addEventListener('click', () => {
        if (search) search.value = '';
        if (categoryFilter) categoryFilter.value = '';
        if (sortSelect) sortSelect.value = 'featured';
        applyFilters();
      });
    }
  }

  async loadAndDisplayProducts() {
    const grid = document.getElementById('product-grid');
    const noResults = document.getElementById('no-results');
    if (!grid) return;

    const filters = this.getProductFilters();
    const products = await this.fetchProducts(filters);
    
    grid.innerHTML = products.map(product => this.createProductCard(product)).join('');
    this.bindAddToCartButtons(grid);
    
    if (noResults) {
      noResults.classList.toggle('d-none', products.length > 0);
    }
  }

  getProductFilters() {
    const search = document.getElementById('search');
    const category = document.getElementById('filter-category');
    const sort = document.getElementById('sort');
    
    return {
      search: search ? search.value.trim() : '',
      category: category ? category.value : '',
      sort: sort ? sort.value : 'featured'
    };
  }

  async initCartPage() {
    await this.renderCart();
  }

  async renderCart() {
    const container = document.getElementById('cart-items');
    const empty = document.getElementById('cart-empty');
    const subtotalEl = document.getElementById('summary-subtotal');
    const taxEl = document.getElementById('summary-tax');
    const totalEl = document.getElementById('summary-total');
    const checkoutBtn = document.getElementById('checkout');
    const clearBtn = document.getElementById('clear-cart');

    if (!container) return;

    if (this.cart.length === 0) {
      container.innerHTML = '';
      if (empty) empty.classList.remove('d-none');
      if (checkoutBtn) checkoutBtn.disabled = true;
      if (clearBtn) clearBtn.disabled = true;
    } else {
      if (empty) empty.classList.add('d-none');
      
      // Fetch product details for cart items
      const cartWithProducts = await Promise.all(
        this.cart.map(async item => ({
          ...item,
          product: await this.fetchProduct(item.id)
        }))
      );

      container.innerHTML = cartWithProducts
        .filter(item => item.product)
        .map(item => this.createCartItemCard(item))
        .join('');

      if (checkoutBtn) checkoutBtn.disabled = false;
      if (clearBtn) clearBtn.disabled = false;

      // Bind cart events
      this.bindCartEvents(container);
    }

    // Update totals
    await this.updateCartTotals(subtotalEl, taxEl, totalEl);

    // Bind checkout and clear events
    if (checkoutBtn) {
      checkoutBtn.addEventListener('click', () => this.handleCheckout());
    }
    if (clearBtn) {
      clearBtn.addEventListener('click', () => {
        this.clearCart();
        this.renderCart();
      });
    }
  }

  async updateCartTotals(subtotalEl, taxEl, totalEl) {
    if (!subtotalEl || !taxEl || !totalEl) return;

    let subtotal = 0;
    for (const item of this.cart) {
      const product = await this.fetchProduct(item.id);
      if (product) {
        subtotal += product.price * item.qty;
      }
    }

    const tax = subtotal * 0.08;
    const total = subtotal + tax;

    subtotalEl.textContent = this.formatMoney(subtotal);
    taxEl.textContent = this.formatMoney(tax);
    totalEl.textContent = this.formatMoney(total);
  }

  initAboutPage() {
    // Update statistics
    this.updateAboutStats();
  }

  async updateAboutStats() {
    const products = await this.fetchProducts();
    const categories = await this.fetchCategories();
    const cartItems = this.cart.reduce((sum, item) => sum + item.qty, 0);

    const statsElements = {
      'stat-products': products.length,
      'stat-categories': categories.length,
      'stat-cart-items': cartItems
    };

    Object.entries(statsElements).forEach(([id, value]) => {
      const el = document.getElementById(id);
      if (el) el.textContent = value;
    });
  }

  initContactPage() {
    const form = document.getElementById('contact-form');
    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        await this.handleContactSubmission(form);
      });
    }
  }

  // Event handlers and UI components
  createProductCard(product) {
    return `
      <div class="col-sm-6 col-md-4 col-lg-3">
        <div class="card h-100 shadow-sm">
          <img src="${product.img}" class="card-img-top" alt="${product.name}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-1">${product.name}</h5>
            <p class="text-primary fw-semibold mb-2">${this.formatMoney(product.price)}</p>
            <button data-add="${product.id}" class="btn btn-sm btn-primary mt-auto">Add to Cart</button>
          </div>
        </div>
      </div>
    `;
  }

  createCartItemCard(item) {
    const { product, qty } = item;
    return `
      <div class="card shadow-sm">
        <div class="card-body d-flex align-items-center gap-3 flex-wrap">
          <img src="${product.img}" alt="${product.name}" class="rounded" style="width:90px;height:60px;object-fit:cover;">
          <div class="flex-grow-1">
            <h5 class="mb-1">${product.name}</h5>
            <div class="small text-muted">${this.formatMoney(product.price)} each</div>
          </div>
          <div class="d-flex align-items-center gap-2">
            <input type="number" min="1" value="${qty}" data-qty="${product.id}" class="form-control form-control-sm" style="width:80px;" />
            <button class="btn btn-outline-danger btn-sm" data-remove="${product.id}">×</button>
          </div>
          <div class="ms-auto fw-semibold">${this.formatMoney(product.price * qty)}</div>
        </div>
      </div>
    `;
  }

  bindAddToCartButtons(container) {
    container.querySelectorAll('[data-add]').forEach(btn => {
      btn.addEventListener('click', (e) => {
        const productId = btn.getAttribute('data-add');
        this.addToCart(productId);
        btn.blur();
      });
    });
  }

  bindCartEvents(container) {
    container.addEventListener('input', (e) => {
      const productId = e.target.getAttribute('data-qty');
      if (productId) {
        const qty = parseInt(e.target.value, 10) || 1;
        this.updateQuantity(productId, qty);
        this.renderCart();
      }
    });

    container.addEventListener('click', (e) => {
      const removeBtn = e.target.closest('[data-remove]');
      if (removeBtn) {
        const productId = removeBtn.getAttribute('data-remove');
        this.removeFromCart(productId);
        this.renderCart();
      }
    });
  }

  bindGlobalEvents() {
    // Global event listeners can go here
  }

  async handleContactSubmission(form) {
    const formData = new FormData(form);
    const data = {
      name: formData.get('name'),
      email: formData.get('email'),
      message: formData.get('message')
    };

    const result = await this.submitContact(data);
    
    if (result.error) {
      this.showMessage('error', result.error);
    } else {
      this.showMessage('success', result.message);
      form.reset();
    }
  }

  handleCheckout() {
    const checkoutMsg = document.getElementById('checkout-msg');
    if (checkoutMsg) {
      checkoutMsg.classList.remove('d-none');
      setTimeout(() => checkoutMsg.classList.add('d-none'), 3000);
    }
    this.clearCart();
    this.renderCart();
  }

  showMessage(type, message) {
    // Simple message display - could be enhanced with a toast system
    alert(message);
  }
}

// Initialize the application when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.eshop = new EShopApp();
});