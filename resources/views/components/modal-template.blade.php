{{-- LOGIN MODAL (Tailwind + Framework Design) --}}
<div id="login-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" tabindex="-1">
  <div class="relative w-full max-w-md mx-4">
    <div class="bg-white border-2 border-primary shadow-2xl">
      {{-- Header --}}
      <div class="border-b-2 border-primary p-8">
        <div class="flex items-center justify-between">
          <h2 class="text-4xl uppercase tracking-tighter font-impact text-primary">Hello!</h2>
          <button type="button" class="text-primary hover:text-secondary transition-colors" id="login-close">
            <i data-lucide="x" class="w-8 h-8"></i>
          </button>
        </div>
      </div>
      
      {{-- Body --}}
      <div class="p-8">
        <form id="login-form" class="space-y-6">
          <div>
            <label for="login-email" class="text-label block mb-3">EMAIL ADDRESS <span class="text-red-500">*</span></label>
            <input id="login-email" name="email" type="email" 
                   class="form-input text-base" 
                   required 
                   placeholder="your.email@example.com"
                   autocomplete="email">
            <div class="text-red-500 text-sm mt-2 hidden" id="login-email-error">
              Please enter a valid email address
            </div>
          </div>
          
          <div>
            <label for="login-password" class="text-label block mb-3">PASSWORD <span class="text-red-500">*</span></label>
            <div class="relative">
              <input id="login-password" name="password" type="password" 
                     class="form-input text-base pr-12" 
                     required 
                     placeholder="Enter your password">
              <button type="button" 
                      id="toggle-login-password"
                      class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary hover:text-primary transition-colors">
                <i data-lucide="eye" class="w-5 h-5" id="login-eye-icon"></i>
              </button>
            </div>
            <div class="text-red-500 text-sm mt-2 hidden" id="login-password-error">
              Password is required
            </div>
          </div>
          
          <div class="flex items-center">
            <input type="checkbox" id="remember-me" class="w-4 h-4 border-2 border-border">
            <label for="remember-me" class="ml-3 text-sm text-secondary">Remember me for 30 days</label>
          </div>
          
          <button type="submit" class="btn-primary w-full text-lg">
            Sign In
          </button>
          
          <div id="login-feedback" class="hidden p-4 border-l-4" role="alert"></div>
        </form>
        
        <div class="mt-8 pt-8 border-t-2 border-border">
          <div class="text-center space-y-4">
            <a href="#" id="forgot-password-link" class="block text-primary hover:underline uppercase text-sm tracking-wider">
              Forgot your password?
            </a>
            <p class="text-secondary">
              Don't have an account? 
              <a href="#" id="show-signup-modal" class="text-primary hover:underline font-semibold uppercase text-sm tracking-wider">
                Sign up here
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- SIGNUP MODAL --}}
<div id="signup-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" tabindex="-1">
  <div class="relative w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
    <div class="bg-white border-2 border-primary shadow-2xl">
      {{-- Header --}}
      <div class="border-b-2 border-primary p-8">
        <div class="flex items-center justify-between">
          <h2 class="text-4xl uppercase tracking-tighter font-impact text-primary">Create Account</h2>
          <button type="button" class="text-primary hover:text-secondary transition-colors" id="signup-close">
            <i data-lucide="x" class="w-8 h-8"></i>
          </button>
        </div>
      </div>
      
      {{-- Body --}}
      <div class="p-8">
        <form id="signup-form" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="signup-first-name" class="text-label block mb-3">FIRST NAME <span class="text-red-500">*</span></label>
              <input id="signup-first-name" name="firstName" type="text" 
                     class="form-input text-base" 
                     required 
                     placeholder="John"
                     autocomplete="given-name">
              <div class="text-red-500 text-sm mt-2 hidden" id="signup-firstname-error">Required (min 2 chars)</div>
            </div>
            
            <div>
              <label for="signup-last-name" class="text-label block mb-3">LAST NAME <span class="text-red-500">*</span></label>
              <input id="signup-last-name" name="lastName" type="text" 
                     class="form-input text-base" 
                     required 
                     placeholder="Doe"
                     autocomplete="family-name">
              <div class="text-red-500 text-sm mt-2 hidden" id="signup-lastname-error">Required (min 2 chars)</div>
            </div>
          </div>
          
          <div>
            <label for="signup-middle-name" class="text-label block mb-3">MIDDLE NAME (OPTIONAL)</label>
            <input id="signup-middle-name" name="middleName" type="text" 
                   class="form-input text-base" 
                   placeholder="Optional"
                   autocomplete="additional-name">
          </div>
          
          <div>
            <label for="signup-email" class="text-label block mb-3">EMAIL ADDRESS <span class="text-red-500">*</span></label>
            <input id="signup-email" name="email" type="email" 
                   class="form-input text-base" 
                   required 
                   placeholder="your.email@example.com"
                   autocomplete="email">
            <div class="text-red-500 text-sm mt-2 hidden" id="signup-email-error">Please enter a valid email</div>
          </div>
          
          <div>
            <label for="signup-address1" class="text-label block mb-3">ADDRESS LINE 1 <span class="text-red-500">*</span></label>
            <input id="signup-address1" name="address1" type="text" 
                   class="form-input text-base" 
                   required 
                   placeholder="123 Street Name"
                   autocomplete="address-line1">
            <div class="text-red-500 text-sm mt-2 hidden" id="signup-address-error">Address required</div>
          </div>
          
          <div>
            <label for="signup-address2" class="text-label block mb-3">ADDRESS LINE 2 (OPTIONAL)</label>
            <input id="signup-address2" name="address2" type="text" 
                   class="form-input text-base" 
                   placeholder="Apt, Suite, Unit, etc."
                   autocomplete="address-line2">
          </div>
          
          <div>
            <label for="signup-phone" class="text-label block mb-3">PHONE NUMBER (OPTIONAL)</label>
            <div class="flex gap-3">
              <select id="signup-country-code" name="countryCode" class="form-input text-base w-24">
                <option value="+64">+64 NZ</option>
                <option value="+61">+61 AU</option>
                <option value="+1">+1 US</option>
                <option value="+44">+44 UK</option>
              </select>
              <input id="signup-phone" name="phone" type="tel" 
                     class="form-input text-base flex-1" 
                     placeholder="123 456 7890"
                     autocomplete="tel">
            </div>
          </div>
          
          <div>
            <label for="signup-password" class="text-label block mb-3">PASSWORD <span class="text-red-500">*</span></label>
            <div class="relative">
              <input id="signup-password" name="password" type="password" 
                     class="form-input text-base pr-12" 
                     required 
                     placeholder="Min 6 characters">
              <button type="button" 
                      id="toggle-signup-password"
                      class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary hover:text-primary transition-colors">
                <i data-lucide="eye" class="w-5 h-5" id="signup-eye-icon"></i>
              </button>
            </div>
            <div class="text-red-500 text-sm mt-2 hidden" id="signup-password-error">Min 6 characters required</div>
          </div>
          
          <div>
            <label for="signup-password-confirm" class="text-label block mb-3">CONFIRM PASSWORD <span class="text-red-500">*</span></label>
            <div class="relative">
              <input id="signup-password-confirm" name="password-confirm" type="password" 
                     class="form-input text-base pr-12" 
                     required 
                     placeholder="Re-enter password">
              <button type="button" 
                      id="toggle-signup-confirm"
                      class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary hover:text-primary transition-colors">
                <i data-lucide="eye" class="w-5 h-5" id="signup-confirm-icon"></i>
              </button>
            </div>
            <div class="text-red-500 text-sm mt-2 hidden" id="signup-confirm-error">Passwords must match</div>
          </div>
          
          <div class="flex items-start gap-3">
            <input type="checkbox" id="agree-terms" required class="w-4 h-4 border-2 border-border mt-1">
            <label for="agree-terms" class="text-sm text-secondary">
              I agree to the <a href="{{ route('terms-of-service') }}" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline">Terms of Service</a> and 
              <a href="{{ route('privacy-policy') }}" target="_blank" rel="noopener noreferrer" class="text-primary hover:underline">Privacy Policy</a>
            </label>
          </div>
          <div class="text-red-500 text-sm hidden" id="signup-terms-error">You must agree to continue</div>
          
          <button type="submit" class="btn-primary w-full text-lg">
            Create Account
          </button>
          
          <div id="signup-feedback" class="hidden p-4 border-l-4" role="alert"></div>
        </form>
        
        <div class="mt-8 pt-8 border-t-2 border-border text-center">
          <p class="text-secondary">
            Already have an account? 
            <a href="#" id="show-login-modal" class="text-primary hover:underline font-semibold uppercase text-sm tracking-wider">
              Sign in here
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- FORGOT PASSWORD MODAL --}}
<div id="forgot-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" tabindex="-1">
  <div class="relative w-full max-w-md mx-4">
    <div class="bg-white border-2 border-primary shadow-2xl">
      {{-- Header --}}
      <div class="border-b-2 border-primary p-8">
        <div class="flex items-center justify-between">
          <h2 class="text-4xl uppercase tracking-tighter font-impact text-primary">Reset Password</h2>
          <button type="button" class="text-primary hover:text-secondary transition-colors" id="forgot-close">
            <i data-lucide="x" class="w-8 h-8"></i>
          </button>
        </div>
      </div>
      
      {{-- Body --}}
      <div class="p-8">
        <p class="text-secondary mb-6">Enter your email and we'll send you a reset link.</p>
        
        <form id="forgot-form" class="space-y-6">
          <div>
            <label for="forgot-email" class="text-label block mb-3">EMAIL ADDRESS <span class="text-red-500">*</span></label>
            <input id="forgot-email" name="email" type="email" 
                   class="form-input text-base" 
                   required 
                   placeholder="your.email@example.com"
                   autocomplete="email">
            <div class="text-red-500 text-sm mt-2 hidden" id="forgot-email-error">Please enter a valid email</div>
          </div>
          
          <button type="submit" id="forgot-submit-btn" class="btn-primary w-full text-lg">
            Send Reset Link
          </button>
          
          <div id="forgot-feedback" class="hidden p-4 border-l-4" role="alert"></div>
        </form>
        
        <div class="mt-8 pt-8 border-t-2 border-border text-center">
          <p class="text-secondary">
            Remembered your password? 
            <a href="#" id="show-login-from-forgot" class="text-primary hover:underline font-semibold uppercase text-sm tracking-wider">
              Back to sign in
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- SIGN OUT MODAL --}}
<div id="signout-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" tabindex="-1">
  <div class="relative w-full max-w-md mx-4">
    <div class="bg-white border-2 border-primary shadow-2xl">
      {{-- Header --}}
      <div class="border-b-2 border-primary p-8">
        <div class="flex items-center justify-between">
          <h2 class="text-4xl uppercase tracking-tighter font-impact text-primary">Sign Out</h2>
          <button type="button" class="text-primary hover:text-secondary transition-colors" id="signout-close">
            <i data-lucide="x" class="w-8 h-8"></i>
          </button>
        </div>
      </div>
      
      {{-- Body --}}
      <div class="p-8">
        <p class="text-secondary mb-2">You're currently signed in as <strong id="signout-identity" class="text-primary">user</strong>.</p>
        <p class="text-secondary mb-6">Are you sure you want to sign out?</p>
        
        <div class="flex gap-4">
          <button type="button" class="btn-secondary flex-1" id="signout-cancel">
            Cancel
          </button>
          <button type="button" class="btn-primary flex-1" id="signout-confirm">
            Sign Out
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Modal functionality
document.addEventListener('DOMContentLoaded', function() {
  // Modal show/hide
  function showModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.body.style.overflow = 'hidden';
    }
  }
  
  function hideModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      document.body.style.overflow = '';
    }
  }
  
  // Close buttons
  ['login-close', 'signup-close', 'forgot-close', 'signout-close', 'signout-cancel'].forEach(id => {
    const btn = document.getElementById(id);
    if (btn) {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        hideModal(id.replace('-close', '-modal').replace('-cancel', '-modal'));
      });
    }
  });
  
  // Modal switches
  const modalSwitches = {
    'show-signup-modal': () => { hideModal('login-modal'); showModal('signup-modal'); },
    'show-login-modal': () => { hideModal('signup-modal'); hideModal('forgot-modal'); showModal('login-modal'); },
    'forgot-password-link': () => { hideModal('login-modal'); showModal('forgot-modal'); },
    'show-login-from-forgot': () => { hideModal('forgot-modal'); showModal('login-modal'); }
  };
  
  Object.entries(modalSwitches).forEach(([id, fn]) => {
    const el = document.getElementById(id);
    if (el) el.addEventListener('click', (e) => { e.preventDefault(); fn(); });
  });
  
  // Expose global modal helpers
  window.EshopModals = {
    show: showModal,
    hide: hideModal,
    showSignout: function() {
      // Check if user is logged in
      let user = null;
      try { user = localStorage.getItem('eshop_user'); } catch {}
      
      if (user) {
        // User is logged in - show signout modal
        try {
          const userData = JSON.parse(user);
          const identityEl = document.getElementById('signout-identity');
          if (identityEl) {
            identityEl.textContent = userData.email || userData.first_name || 'user';
          }
        } catch {}
        showModal('signout-modal');
      } else {
        // User is not logged in - show login modal
        showModal('login-modal');
      }
    }
  };

  // Password toggles - handle each field individually with correct IDs
  const passwordToggles = [
    { toggle: 'toggle-login-password', input: 'login-password', icon: 'login-eye-icon' },
    { toggle: 'toggle-signup-password', input: 'signup-password', icon: 'signup-eye-icon' },
    { toggle: 'toggle-signup-confirm', input: 'signup-password-confirm', icon: 'signup-confirm-icon' }
  ];
  
  passwordToggles.forEach(({ toggle: toggleId, input: inputId, icon: iconId }) => {
    const toggle = document.getElementById(toggleId);
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (toggle && input && icon) {
      toggle.addEventListener('click', () => {
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        icon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
        if (window.lucide) window.lucide.createIcons();
      });
    }
  });
  
  // Click outside to close
  ['login-modal', 'signup-modal', 'forgot-modal', 'signout-modal'].forEach(modalId => {
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.addEventListener('click', (e) => {
        if (e.target === modal) hideModal(modalId);
      });
    }
  });
  
  // User button listener removed - handled by navbar component to support dropdown

  
  // Handle signout confirmation
  const signoutConfirm = document.getElementById('signout-confirm');
  if (signoutConfirm) {
    signoutConfirm.addEventListener('click', async () => {
      // Visual feedback - show loading state
      const originalText = signoutConfirm.textContent;
      signoutConfirm.innerHTML = '<span class="inline-flex items-center justify-center gap-2"><span class="loading-spinner" style="width: 16px; height: 16px;"></span><span>Signing Out...</span></span>';
      signoutConfirm.disabled = true;
      
      // Get user data BEFORE clearing
      let sessionToken = null;
      try {
        const user = JSON.parse(localStorage.getItem('eshop_user') || '{}');
        sessionToken = user.session_token;
      } catch {}
      
      // Clear localStorage
      localStorage.removeItem('eshop_user');
      localStorage.removeItem('eshop-cart-v1');
      
      // Call logout API
      if (sessionToken) {
        try {
          await fetch('/api/users/logout', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ session_token: sessionToken })
          });
        } catch {}
      }
      
      // Reset guest cart session (rotate cookie, delete old cart)
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (csrfToken) {
          await fetch('/cart/guest/reset', {
            method: 'POST',
            headers: { 
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            credentials: 'include'
          });
        }
      } catch {}
      
      hideModal('signout-modal');
      window.location.href = '/';

    });
  }
  
  // Handle login form submission
  const loginForm = document.getElementById('login-form');
  if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const email = document.getElementById('login-email').value;
      const password = document.getElementById('login-password').value;
      const feedback = document.getElementById('login-feedback');
      const submitBtn = loginForm.querySelector('button[type="submit"]');
      
      // Visual feedback - show loading state
      const originalBtnText = submitBtn.textContent;
      submitBtn.innerHTML = '<span class="inline-flex items-center justify-center gap-2"><span class="loading-spinner" style="width: 16px; height: 16px;"></span><span>Signing In...</span></span>';
      submitBtn.disabled = true;
      
      // Get guest session ID from cookie for cart merge
      function getGuestSessionId() {
        const match = document.cookie.match(/eshop_session_id=([^;]+)/);
        return match ? decodeURIComponent(match[1]) : null;
      }
      
      try {
        const response = await fetch('/api/users/login', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'include',
          body: JSON.stringify({ 
            email, 
            password,
            guest_session_id: getGuestSessionId()
          })
        });
        const data = await response.json();
        
        if (data.success) {
          localStorage.setItem('eshop_user', JSON.stringify(data.user));
          // Clear local cart - server will have merged cart
          localStorage.removeItem('eshop-cart-v1');
          feedback.className = 'p-4 border-l-4 border-primary bg-gray-100 dark:bg-gray-800 text-primary dark:text-white';
          feedback.textContent = 'Login successful! Redirecting...';
          feedback.classList.remove('hidden');
          setTimeout(() => {
            hideModal('login-modal');
            window.location.reload();
          }, 1000);
        } else {
          feedback.className = 'p-4 border-l-4 border-red-600 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400';
          feedback.textContent = data.error || 'Login failed';
          feedback.classList.remove('hidden');
          // Reset button
          submitBtn.textContent = originalBtnText;
          submitBtn.disabled = false;
        }
      } catch (err) {
        feedback.className = 'p-4 border-l-4 border-red-600 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400';
        feedback.textContent = 'Network error. Please try again.';
        feedback.classList.remove('hidden');
        // Reset button
        submitBtn.textContent = originalBtnText;
        submitBtn.disabled = false;
      }
    });
  }
  
  // Handle signup form submission
  const signupForm = document.getElementById('signup-form');
  if (signupForm) {
    signupForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const feedback = document.getElementById('signup-feedback');
      const submitBtn = signupForm.querySelector('button[type="submit"]');
      
      const password = document.getElementById('signup-password').value;
      const confirmPassword = document.getElementById('signup-password-confirm').value;
      
      if (password !== confirmPassword) {
        document.getElementById('signup-confirm-error').classList.remove('hidden');
        return;
      }
      
      // Visual feedback - show loading state
      const originalBtnText = submitBtn.textContent;
      submitBtn.innerHTML = '<span class="inline-flex items-center justify-center gap-2"><span class="loading-spinner" style="width: 16px; height: 16px;"></span><span>Creating Account...</span></span>';
      submitBtn.disabled = true;
      
      const formData = {
        first_name: document.getElementById('signup-first-name').value,
        last_name: document.getElementById('signup-last-name').value,
        middle_name: document.getElementById('signup-middle-name').value,
        email: document.getElementById('signup-email').value,
        address1: document.getElementById('signup-address1').value,
        address2: document.getElementById('signup-address2').value,
        country_code: document.getElementById('signup-country-code').value,
        phone: document.getElementById('signup-phone').value,
        password: password
      };
      
      try {
        const response = await fetch('/api/users/signup', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(formData)
        });
        const data = await response.json();
        
        if (data.success) {
          feedback.className = 'p-4 border-l-4 border-primary bg-gray-100 dark:bg-gray-800 text-primary dark:text-white';
          feedback.textContent = 'Account created! Please sign in.';
          feedback.classList.remove('hidden');
          setTimeout(() => {
            hideModal('signup-modal');
            showModal('login-modal');
          }, 1500);
        } else {
          feedback.className = 'p-4 border-l-4 border-red-600 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400';
          feedback.textContent = data.error || 'Signup failed';
          feedback.classList.remove('hidden');
          // Reset button
          submitBtn.textContent = originalBtnText;
          submitBtn.disabled = false;
        }
      } catch (err) {
        feedback.className = 'p-4 border-l-4 border-red-600 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400';
        feedback.textContent = 'Network error. Please try again.';
        feedback.classList.remove('hidden');
        // Reset button
        submitBtn.textContent = originalBtnText;
        submitBtn.disabled = false;
      }
    });
  }
  
  // Initialize Lucide icons in modals
  if (window.lucide) window.lucide.createIcons();
});
</script>
