/* E-Shop Demo JS (no external dependencies) */
(function(){
  // Component loader function with fallback for direct file opening
  async function loadComponent(componentName, targetSelector) {
    try {
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
    } catch (error) {
      console.warn(`Could not load component ${componentName}, using fallback:`, error);
      // Fallback: inject components directly for local file access
      if (componentName === 'navbar') {
        loadNavbarFallback(targetSelector);
      } else if (componentName === 'modal-template') {
        loadModalFallback(targetSelector);
      }
    }
  }

  // Fallback navbar for when component loading fails
  function loadNavbarFallback(targetSelector) {
    const navbarHTML = `
    <!-- NAVBAR COMPONENT (Modern Fallback) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow">
      <div class="container">
        <a class="navbar-brand fw-bold" href="bootstrap.html">
          <i class="bi bi-shop me-2"></i>E-Shop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="bootstrap.html" data-page="home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="products.html" data-page="products">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="about.html" data-page="about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.html" data-page="contact">Contact</a></li>
            <li class="nav-item">
              <a class="nav-link position-relative" href="cart.html" data-page="cart">
                <i class="bi bi-cart3"></i>
                Cart
                <span class="badge bg-warning text-dark ms-1" id="cart-count">0</span>
              </a>
            </li>
            <li class="nav-item ms-lg-2"><a class="nav-link" id="nav-login-btn" href="#" role="button">Login</a></li>
            <li class="nav-item ms-lg-2">
              <a id="theme-toggle" class="nav-link" href="#" aria-pressed="false" aria-label="Toggle theme">
                <span id="theme-emoji" aria-hidden="true">🌙</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>`;
    
    const targetElement = document.querySelector(targetSelector);
    if (targetElement) {
      targetElement.innerHTML = navbarHTML;
      setActiveNavigation();
    }
  }

  // Fallback modals for when component loading fails
  function loadModalFallback(targetSelector) {
    const modalHTML = `
    <!-- LOGIN MODAL (Fallback) -->
    <div id="login-modal" class="modal d-none" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
          <div class="modal-header bg-primary text-white border-0">
            <h5 class="modal-title fw-bold" id="login-title">
              <i class="bi bi-person-circle me-2"></i>Welcome Back
            </h5>
            <button type="button" class="btn-close btn-close-white" id="login-close" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form id="login-form" novalidate>
              <div class="mb-3">
                <label for="login-email" class="form-label fw-semibold text-dark">
                  <i class="bi bi-envelope me-1"></i>Email Address
                </label>
      <input id="login-email" name="email" type="email" class="form-control form-control-lg" required 
                       placeholder="Enter your email" 
                       pattern="[^\s].*" 
        oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/^\s+/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}" 
                       onkeydown="if(event.key === ' ' && this.value.length === 0) return false;"
                       autocomplete="email" spellcheck="false">
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle me-1"></i>Please enter a valid email address
                </div>
              </div>
              <div class="mb-3">
                <label for="login-password" class="form-label fw-semibold text-dark">
                  <i class="bi bi-lock me-1"></i>Password
                </label>
                <div class="input-group">
                  <input id="login-password" name="password" type="password" class="form-control form-control-lg" 
                         required placeholder="Enter your password">
                  <button class="btn btn-outline-secondary" type="button" id="toggle-login-password">
                    <i class="bi bi-eye" id="login-eye-icon"></i>
                  </button>
                </div>
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle me-1"></i>Password must be at least 3 characters
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label text-muted small" for="remember-me">
                    Remember me for 30 days
                  </label>
                </div>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                  <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                </button>
              </div>
              <div id="login-feedback" class="mt-3 alert" style="display:none;" role="alert"></div>
            </form>
            <hr class="my-4">
            <div class="text-center">
              <p class="mb-2">
                <a href="#" id="forgot-password-link" class="text-decoration-none text-primary">
                  <i class="bi bi-question-circle me-1"></i>Forgot your password?
                </a>
              </p>
              <p class="mb-0 text-muted">
                Don't have an account? 
                <a href="#" id="show-signup-modal" class="text-decoration-none fw-semibold text-primary">
                  Sign up here
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

            <!-- SIGN OUT MODAL (Fallback) -->
            <div id="signout-modal" class="modal d-none" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                  <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title fw-bold">
                      <i class="bi bi-box-arrow-right me-2"></i>Sign out
                    </h5>
                    <button type="button" class="btn-close btn-close-white" id="signout-close" aria-label="Close"></button>
                  </div>
                  <div class="modal-body p-4">
                    <p class="mb-2">You're currently signed in as <strong id="signout-identity">user</strong>.</p>
                    <p class="mb-0">Are you sure you want to sign out?</p>
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" id="signout-cancel">Cancel</button>
                    <button type="button" class="btn btn-danger" id="signout-confirm">
                      <i class="bi bi-box-arrow-right me-1"></i>Sign out
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- FORGOT PASSWORD MODAL (Fallback) -->
            <div id="forgot-modal" class="modal d-none" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                  <div class="modal-header bg-info text-white border-0">
                    <h5 class="modal-title fw-bold" id="forgot-title">
                      <i class="bi bi-envelope-at me-2"></i>Reset your password
                    </h5>
                    <button type="button" class="btn-close btn-close-white" id="forgot-close" aria-label="Close"></button>
                  </div>
                  <div class="modal-body p-4">
                    <form id="forgot-form" novalidate>
                      <div class="mb-3">
                        <label for="forgot-email" class="form-label fw-semibold text-dark">
                          <i class="bi bi-envelope me-1"></i>Email Address
                        </label>
              <input id="forgot-email" name="email" type="email" class="form-control form-control-lg" required 
                placeholder="Enter your account email"
                pattern="[^\\s].*"
                oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/^\\s+/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}"
                onkeydown="if(event.key === ' ' && this.value.length === 0) return false;"
                autocomplete="email" spellcheck="false">
                        <div class="invalid-feedback">
                          <i class="bi bi-exclamation-circle me-1"></i>Please enter a valid email address
                        </div>
                      </div>
                      <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-info btn-lg text-white">
                          <i class="bi bi-send me-2"></i>Send reset link
                        </button>
                      </div>
                      <div id="forgot-feedback" class="mt-3 alert" style="display:none;" role="alert"></div>
                    </form>
                    <hr class="my-4">
                    <div class="text-center">
                      <p class="mb-0 text-muted">
                        Remembered your password?
                        <a href="#" id="show-login-from-forgot" class="text-decoration-none fw-semibold text-primary">
                          Back to sign in
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    <!-- SIGNUP MODAL (Fallback) -->
    <div id="signup-modal" class="modal d-none" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
          <div class="modal-header bg-success text-white border-0">
            <h5 class="modal-title fw-bold" id="signup-title">
              <i class="bi bi-person-plus me-2"></i>Create Account
            </h5>
            <button type="button" class="btn-close btn-close-white" id="signup-close" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form id="signup-form" novalidate>
              <div class="mb-3">
                <label class="form-label fw-semibold text-dark" for="signup-first-name">
                  <i class="bi bi-person me-1"></i>Name
                </label>
                <div class="row g-2">
                  <div class="col-12">
          <input id="signup-first-name" name="firstName" type="text" class="form-control form-control-lg" required 
                           placeholder="First name" minlength="2" maxlength="50"
            oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/\\s+$/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}"
                           onkeydown="if(event.key===' ' && this.selectionStart===this.value.length) return false;"
                           autocomplete="given-name">
                    <div class="invalid-feedback">
                      <i class="bi bi-exclamation-circle me-1"></i>Please enter your first name (min 2 chars)
                    </div>
                  </div>
                  <div class="col-12">
          <input id="signup-middle-name" name="middleName" type="text" class="form-control form-control-lg"
                           placeholder="Middle name (optional)" maxlength="50"
            oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/\\s+$/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}"
                           onkeydown="if(event.key===' ' && this.selectionStart===this.value.length) return false;"
                           autocomplete="additional-name">
                  </div>
                  <div class="col-12">
          <input id="signup-last-name" name="lastName" type="text" class="form-control form-control-lg" required 
                           placeholder="Last name" minlength="2" maxlength="50"
            oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/\\s+$/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}"
                           onkeydown="if(event.key===' ' && this.selectionStart===this.value.length) return false;"
                           autocomplete="family-name">
                    <div class="invalid-feedback">
                      <i class="bi bi-exclamation-circle me-1"></i>Please enter your last name (min 2 chars)
                    </div>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="signup-email" class="form-label fw-semibold text-dark">
                  <i class="bi bi-envelope me-1"></i>Email Address
                </label>
      <input id="signup-email" name="email" type="email" class="form-control form-control-lg" required 
                       placeholder="Enter your email address"
                       pattern="[^\s].*" 
        oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/^\s+/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}" 
                       onkeydown="if(event.key === ' ' && this.value.length === 0) return false;"
                       autocomplete="email" spellcheck="false">
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle me-1"></i>Please enter a valid email address
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-semibold text-dark" for="signup-address1">
                  <i class="bi bi-geo-alt me-1"></i>Address
                </label>
                <div class="row g-2">
                  <div class="col-12">
                    <input id="signup-address1" name="address1" type="text" class="form-control form-control-lg" required 
                           placeholder="Address Line 1" maxlength="100"
                           oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/\\s{2,}/g,' ').replace(/^\\s+/,'').replace(/\\s+$/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}"
                           onkeydown="if(event.key===' ' && (this.value.charAt(this.selectionStart-1)===' ' || this.selectionStart===0 || this.selectionStart===this.value.length)) return false;"
                           autocomplete="address-line1">
                    <div class="invalid-feedback">
                      <i class="bi bi-exclamation-circle me-1"></i>Please enter your address
                    </div>
                  </div>
                  <div class="col-12">
                    <input id="signup-address2" name="address2" type="text" class="form-control form-control-lg"
                           placeholder="Address Line 2 (optional)" maxlength="100"
                           oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/\\s{2,}/g,' ').replace(/^\\s+/,'').replace(/\\s+$/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}"
                           onkeydown="if(event.key===' ' && (this.value.charAt(this.selectionStart-1)===' ' || this.selectionStart===0 || this.selectionStart===this.value.length)) return false;"
                           autocomplete="address-line2">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="signup-phone" class="form-label fw-semibold text-dark">
                  <i class="bi bi-telephone me-1"></i>Phone Number (optional)
                </label>
                <div class="input-group">
                  <select id="signup-country-code" name="countryCode" class="form-select" style="max-width: 120px;">
                    <option value="+64" selected>+64 (NZ)</option>
                    <option value="+61">+61 (AU)</option>
                    <option value="+1">+1 (US/CA)</option>
                    <option value="+44">+44 (UK)</option>
                    <option value="+33">+33 (FR)</option>
                    <option value="+49">+49 (DE)</option>
                  </select>
                  <input id="signup-phone" name="phone" type="tel" class="form-control form-control-lg" 
                         placeholder="Enter your phone number" maxlength="15"
                         oninput="var s=this.selectionStart,v=this.value,nv=v.replace(/\\s+$/,'');if(nv!==v){this.value=nv;try{this.setSelectionRange(Math.min(s,nv.length),Math.min(s,nv.length));}catch(e){}}"
                         onkeydown="if(event.key===' ' && this.selectionStart===this.value.length) return false;"
                         autocomplete="tel">
                </div>
                <div class="form-text text-muted small">
                  <i class="bi bi-info-circle me-1"></i>Optional field - enter your phone number without country code
                </div>
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle me-1"></i>Please enter a valid phone number
                </div>
              </div>
              <div class="mb-3">
                <label for="signup-password" class="form-label fw-semibold text-dark">
                  <i class="bi bi-lock me-1"></i>Password
                </label>
                <div class="input-group">
                  <input id="signup-password" name="password" type="password" class="form-control form-control-lg" 
                         required placeholder="Create a password" minlength="6">
                  <button class="btn btn-outline-secondary" type="button" id="toggle-signup-password">
                    <i class="bi bi-eye" id="signup-eye-icon"></i>
                  </button>
                </div>
                <div class="form-text text-muted small">
                  <i class="bi bi-info-circle me-1"></i>At least 6 characters long
                </div>
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle me-1"></i>Password must be at least 6 characters
                </div>
              </div>
              <div class="mb-3">
                <label for="signup-password-confirm" class="form-label fw-semibold text-dark">
                  <i class="bi bi-lock-fill me-1"></i>Confirm Password
                </label>
                <div class="input-group">
                  <input id="signup-password-confirm" name="password-confirm" type="password" class="form-control form-control-lg" 
                         required placeholder="Confirm your password" minlength="6">
                  <button class="btn btn-outline-secondary" type="button" id="toggle-signup-confirm">
                    <i class="bi bi-eye" id="signup-confirm-icon"></i>
                  </button>
                </div>
                <div class="invalid-feedback">
                  <i class="bi bi-exclamation-circle me-1"></i>Passwords do not match
                </div>
              </div>
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="agree-terms" required>
                  <label class="form-check-label text-muted small" for="agree-terms">
                    I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and 
                    <a href="#" class="text-decoration-none">Privacy Policy</a>
                  </label>
                  <div class="invalid-feedback">
                    <i class="bi bi-exclamation-circle me-1"></i>You must agree to the terms
                  </div>
                </div>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success btn-lg">
                  <i class="bi bi-person-check me-2"></i>Create Account
                </button>
              </div>
              <div id="signup-feedback" class="mt-3 alert" style="display:none;" role="alert"></div>
            </form>
            <hr class="my-4">
            <div class="text-center">
              <p class="mb-0 text-muted">
                Already have an account? 
                <a href="#" id="show-login-modal" class="text-decoration-none fw-semibold text-primary">
                  Sign in here
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>`;
    
    const targetElement = document.querySelector(targetSelector);
    if (targetElement) {
      targetElement.insertAdjacentHTML('beforeend', modalHTML);
    }
  }

  // Set active navigation based on current page
  function setActiveNavigation() {
    const currentPage = window.location.pathname.split('/').pop().replace('.html', '');
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
  const CATALOG = [
    { id: 'chair-1', name: 'Elegant Chair', price: 99, category: 'Furniture', featured: true, img: 'https://picsum.photos/300/200?chair' },
    { id: 'lamp-1', name: 'Smart Lamp', price: 49, category: 'Lighting', featured: true, img: 'https://picsum.photos/300/200?lamp' },
    { id: 'desk-1', name: 'Modern Desk', price: 199, category: 'Furniture', featured: true, img: 'https://picsum.photos/300/200?desk' },
    { id: 'headphones-1', name: 'Wireless Headphones', price: 149, category: 'Electronics', featured: false, img: 'https://picsum.photos/300/200?headphones' },
    { id: 'plant-1', name: 'Decorative Plant', price: 25, category: 'Decor', featured: false, img: 'https://picsum.photos/300/200?plant' },
    { id: 'mug-1', name: 'Ceramic Mug', price: 15, category: 'Kitchen', featured: false, img: 'https://picsum.photos/300/200?mug' },
    { id: 'notebook-1', name: 'Premium Notebook', price: 12, category: 'Stationery', featured: false, img: 'https://picsum.photos/300/200?notebook' },
    { id: 'backpack-1', name: 'Urban Backpack', price: 89, category: 'Accessories', featured: false, img: 'https://picsum.photos/300/200?backpack' },
    { id: 'bottle-1', name: 'Steel Water Bottle', price: 29, category: 'Accessories', featured: false, img: 'https://picsum.photos/300/200?bottle' }
  ];

  function loadCart(){
    try { return JSON.parse(localStorage.getItem(STORAGE_KEY)||'[]'); } catch { return []; }
  }
  function saveCart(cart){ localStorage.setItem(STORAGE_KEY, JSON.stringify(cart)); updateCartCount(cart); }
  function updateCartCount(cart){
    const el = document.getElementById('cart-count');
    if(el) el.textContent = cart.reduce((a,i)=>a+i.qty,0);
  }
  function formatMoney(n){ return `$${n.toFixed(2)}`; }
  function getProduct(id){ return CATALOG.find(p=>p.id===id); }

  // Shared state
  let CART = loadCart();

  function addToCart(id){
    const existing = CART.find(i=>i.id===id);
    if(existing) existing.qty++; else CART.push({id, qty:1});
    saveCart(CART);
  }
  function removeFromCart(id){
    CART = CART.filter(i=>i.id!==id); saveCart(CART);
  }
  function setQty(id, qty){
    const item = CART.find(i=>i.id===id); if(!item) return; item.qty = Math.max(1, qty); saveCart(CART);
  }
  function clearCart(){ CART = []; saveCart(CART); }

  function productCard(product){
    return `<div class="col-sm-6 col-md-4 col-lg-3"><div class="card h-100 shadow-sm">
      <img src="${product.img}" class="card-img-top" alt="${product.name}">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title mb-1">${product.name}</h5>
        <p class="text-primary fw-semibold mb-2">${formatMoney(product.price)}</p>
        <button data-add="${product.id}" class="btn btn-sm btn-primary mt-auto">Add to Cart</button>
      </div>
    </div></div>`;
  }

  function bindAddButtons(container){
    container.querySelectorAll('[data-add]').forEach(btn=>{
      btn.addEventListener('click', e=>{
        addToCart(btn.getAttribute('data-add'));
        btn.blur();
        // Visual feedback similar to modern app
        const originalText = btn.textContent;
        btn.textContent = 'Added!';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-primary');
        setTimeout(()=>{
          btn.textContent = originalText;
          btn.classList.add('btn-primary');
          btn.classList.remove('btn-success');
        }, 900);
      });
    });
  }

  function renderFeatured(){
    const wrap = document.getElementById('featured-products'); if(!wrap) return;
    const featured = CATALOG.filter(p=>p.featured).slice(0,3);
    wrap.innerHTML = featured.map(productCard).join('');
    bindAddButtons(wrap);
  }

  function renderCatalog(){
    const grid = document.getElementById('product-grid'); if(!grid) return;
    const search = document.getElementById('search');
    const catSel = document.getElementById('filter-category');
    const sortSel = document.getElementById('sort');
    const noRes = document.getElementById('no-results');

    // Populate categories
    const cats = [...new Set(CATALOG.map(p=>p.category))];
    cats.sort().forEach(c=>{ if(![...catSel.options].some(o=>o.value===c)) catSel.append(new Option(c,c)); });

    function apply(){
      let list = [...CATALOG];
      const q = (search.value||'').trim().toLowerCase();
      const cat = catSel.value;
      if(q) list = list.filter(p=>p.name.toLowerCase().includes(q));
      if(cat) list = list.filter(p=>p.category===cat);
      switch(sortSel.value){
        case 'price-asc': list.sort((a,b)=>a.price-b.price); break;
        case 'price-desc': list.sort((a,b)=>b.price-a.price); break;
        case 'alpha': list.sort((a,b)=>a.name.localeCompare(b.name)); break;
        default: list.sort((a,b)=> (b.featured?1:0)-(a.featured?1:0));
      }
      grid.innerHTML = list.map(productCard).join('');
      bindAddButtons(grid);
      noRes.classList.toggle('d-none', list.length>0);
    }

    ['input','change'].forEach(ev=>{
      search.addEventListener(ev, apply);
      catSel.addEventListener(ev, apply);
      sortSel.addEventListener(ev, apply);
    });
    document.getElementById('reset').addEventListener('click', ()=>{ search.value=''; catSel.value=''; sortSel.value='featured'; apply(); });
    apply();
  }

  function renderCart(){
    const wrap = document.getElementById('cart-items'); if(!wrap) return;
    const empty = document.getElementById('cart-empty');
    const subtotalEl = document.getElementById('summary-subtotal');
    const taxEl = document.getElementById('summary-tax');
    const totalEl = document.getElementById('summary-total');
    const checkoutBtn = document.getElementById('checkout');
    const clearBtn = document.getElementById('clear-cart');
    const checkoutMsg = document.getElementById('checkout-msg');

    function draw(){
      if(CART.length===0){
        wrap.innerHTML='';
        empty.classList.remove('d-none');
        checkoutBtn.disabled = clearBtn.disabled = true;
      } else {
        empty.classList.add('d-none');
        wrap.innerHTML = CART.map(item=>{
          const p = getProduct(item.id); if(!p) return '';
          return `<div class="card shadow-sm"><div class="card-body d-flex align-items-center gap-3 flex-wrap">
            <img src="${p.img}" alt="${p.name}" class="rounded" style="width:90px;height:60px;object-fit:cover;">
            <div class="flex-grow-1">
              <h5 class="mb-1">${p.name}</h5>
              <div class="small text-muted">${formatMoney(p.price)} each</div>
            </div>
            <div class="d-flex align-items-center gap-2">
              <input type="number" min="1" value="${item.qty}" data-qty="${item.id}" class="form-control form-control-sm" style="width:80px;" />
              <button class="btn btn-outline-danger btn-sm" data-remove="${item.id}">×</button>
            </div>
            <div class="ms-auto fw-semibold">${formatMoney(p.price*item.qty)}</div>
          </div></div>`;
        }).join('');
        checkoutBtn.disabled = clearBtn.disabled = false;
      }
      const subtotal = CART.reduce((a,i)=> a + (getProduct(i.id)?.price||0)*i.qty, 0);
      const tax = subtotal * 0.08;
      const total = subtotal + tax;
      subtotalEl.textContent = formatMoney(subtotal);
      taxEl.textContent = formatMoney(tax);
      totalEl.textContent = formatMoney(total);
      updateCartCount(CART);
    }

    wrap.addEventListener('input', e=>{
      const id = e.target.getAttribute('data-qty');
      if(id) setQty(id, parseInt(e.target.value,10)||1);
      draw();
    });
    wrap.addEventListener('click', e=>{
      const btn = e.target.closest('[data-remove]');
      if(btn){ removeFromCart(btn.getAttribute('data-remove')); draw(); }
    });
    clearBtn.addEventListener('click', ()=>{ clearCart(); draw(); });
    checkoutBtn.addEventListener('click', ()=>{
      // Require account for checkout: if not logged in, open Create Account modal
      let user = null;
      try { user = localStorage.getItem('eshop_user'); } catch {}
      if (!user) {
        // Remember intent so we can resume after signup/login
        try { localStorage.setItem('eshop_intent', 'checkout'); } catch {}
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
      setTimeout(()=> checkoutMsg.classList.add('d-none'), 2500);
    });
    draw();
  }

  function aboutStats(){
    const pEl = document.getElementById('stat-products');
    const cEl = document.getElementById('stat-categories');
    const ciEl = document.getElementById('stat-cart-items');
    if(pEl) pEl.textContent = CATALOG.length;
    if(cEl) cEl.textContent = new Set(CATALOG.map(p=>p.category)).size;
    if(ciEl) ciEl.textContent = CART.reduce((a,i)=>a+i.qty,0);
  }

  function contactForm(){
    const form = document.getElementById('contact-form'); if(!form) return;
    // If jQuery Validation is present, let it manage submission/validation to avoid duplicate handlers
    if (window.jQuery && window.jQuery.fn && window.jQuery.fn.validate) {
      return;
    }
    form.addEventListener('submit', e=>{
      e.preventDefault();
      // Form submission logic would go here
      form.reset();
    });
  }

  // Page initializers
  window.Eshop = {
    pages: {
      home(){ renderFeatured(); updateCartCount(CART); },
      products(){ renderCatalog(); updateCartCount(CART); },
      cart(){ renderCart(); },
      about(){ aboutStats(); updateCartCount(CART); },
      contact(){ contactForm(); updateCartCount(CART); }
    }
  };

  // Auto-detect page by body data attribute in future (simpler: look for known anchor)
  document.addEventListener('DOMContentLoaded', async ()=>{
    // Load navbar component first
    await loadComponent('navbar', '#navbar-container');
    
    // Load modal components on all pages
    await loadComponent('modal-template', 'body');
    
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
      function applyTheme(theme){
        document.documentElement.setAttribute('data-theme', theme);
        document.documentElement.setAttribute('data-bs-theme', theme==='dark' ? 'dark' : 'light');
        try { localStorage.setItem(THEME_STORAGE_KEY, theme); } catch {}
        if(btn){
          const emoji = btn.querySelector('#theme-emoji');
          if (emoji){
            emoji.textContent = theme==='dark' ? '☀️' : '🌙';
          }
          btn.setAttribute('aria-pressed', theme==='dark');
        }
      }
      if(btn){
        // Initialize icon and aria state
        const current = document.documentElement.getAttribute('data-theme') || 'light';
        const emoji = btn.querySelector('#theme-emoji');
        if (emoji){
          emoji.textContent = current==='dark' ? '☀️' : '🌙';
        }
        btn.setAttribute('aria-pressed', current==='dark');
        if (window.jQuery) {
          window.jQuery(btn).on('click', function(e){
            if (e && typeof e.preventDefault === 'function') e.preventDefault();
            const t = (document.documentElement.getAttribute('data-theme')==='dark') ? 'light' : 'dark';
            applyTheme(t);
          });
        } else {
          btn.addEventListener('click', (e)=>{
            if (e && typeof e.preventDefault === 'function') e.preventDefault();
            const t = (document.documentElement.getAttribute('data-theme')==='dark') ? 'light' : 'dark';
            applyTheme(t);
          });
        }
      }

      // If featured products container exists treat as home
      if(document.getElementById('featured-products')) window.Eshop.pages.home();
    }, 200); // Increased delay to ensure modals are fully loaded
  });

  // Initial badge update
  updateCartCount(CART);
})();
