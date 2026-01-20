@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - My Account')

@section('content')
<div class="pt-32">
  {{-- Account Hero --}}
  <section class="py-16 px-6 lg:px-8 bg-background dark:bg-gray-800 flex items-center transition-colors duration-300 relative overflow-hidden">
    {{-- Subtle Grid Pattern --}}
    <div class="absolute inset-0 bg-pattern dark:opacity-10"></div>
    
    <div class="max-w-7xl mx-auto w-full relative">
      <div class="text-center">
        <p data-animate="fade-in" data-delay="100" 
           class="text-secondary dark:text-gray-400 mb-3 uppercase tracking-[0.3em] text-sm font-medium">
          Account Settings
        </p>
        <h1 data-animate="slide-up" data-delay="200" 
            class="text-4xl lg:text-6xl text-primary dark:text-white uppercase tracking-tighter font-impact leading-[0.9] mb-4">
          My Account
        </h1>
        <p data-animate="fade-in" data-delay="300"
           class="text-base text-secondary dark:text-gray-400 max-w-md mx-auto">
          Manage your profile, address, and security settings.
        </p>
      </div>
    </div>
  </section>
  
  {{-- Account Content --}}
  <section class="py-12 px-6 lg:px-8 bg-white dark:bg-gray-900 transition-colors duration-300 min-h-[60vh]">
    <div class="max-w-xl mx-auto">
      {{-- Loading State --}}
      <div id="account-loading" class="text-center py-16">
        <div class="loading-spinner mx-auto mb-4" style="width: 40px; height: 40px;"></div>
        <p class="text-secondary dark:text-gray-400">Loading your account...</p>
      </div>
      
      {{-- Account Form --}}
      <div id="account-form-container" class="hidden space-y-8">
        
        {{-- Personal Information --}}
        <div>
          <div class="flex items-center gap-3 mb-5 pb-3 border-b border-border dark:border-gray-700">
            <div class="w-10 h-10 bg-primary dark:bg-white flex items-center justify-center">
              <i data-lucide="user" class="w-5 h-5 text-white dark:text-gray-900"></i>
            </div>
            <h2 class="text-lg font-impact uppercase text-primary dark:text-white tracking-wide">Personal Information</h2>
          </div>
          
          <form id="account-form" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">First Name</label>
                <input type="text" id="first_name" name="first_name" 
                       class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                       placeholder="First name">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name" 
                       class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                       placeholder="Optional">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Last Name</label>
                <input type="text" id="last_name" name="last_name" 
                       class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                       placeholder="Last name">
              </div>
            </div>
            
            <div>
              <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Email Address</label>
              <input type="email" id="email" name="email" 
                     class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-200 dark:bg-gray-700 text-secondary dark:text-gray-400 cursor-not-allowed"
                     placeholder="Email" readonly>
              <p class="text-xs text-secondary dark:text-gray-500 mt-1.5">Email cannot be changed</p>
            </div>
            
            <div class="grid grid-cols-3 gap-4">
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Code</label>
                <input type="text" id="country_code" name="country_code" 
                       class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                       placeholder="+1">
              </div>
              <div class="col-span-2">
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Phone Number</label>
                <input type="tel" id="phone" name="phone" 
                       class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                       placeholder="Phone number">
              </div>
            </div>
          
            {{-- Address Section --}}
            <div class="pt-4">
              <p class="text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-4 flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4"></i>
                Default Shipping Address
              </p>
              
              <div class="space-y-4">
                <div>
                  <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Address Line 1 <span class="text-red-500">*</span></label>
                  <input type="text" id="address1" name="address1" required 
                         class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                         placeholder="Street address">
                </div>
                
                <div>
                  <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Address Line 2</label>
                  <input type="text" id="address2" name="address2" 
                         class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                         placeholder="Apartment, suite, etc. (optional)">
                </div>
              </div>
            </div>
            
            <div class="pt-4">
              <button type="submit" id="save-btn" 
                      class="w-full bg-primary dark:bg-white text-white dark:text-gray-900 py-4 uppercase tracking-wider text-sm font-semibold flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Save Changes</span>
              </button>
            </div>
            
            <div id="form-status" class="hidden text-center py-3 px-4 text-sm"></div>
          </form>
        </div>
        
        {{-- Security Section --}}
        <div>
          <div class="flex items-center gap-3 mb-5 pb-3 border-b border-border dark:border-gray-700">
            <div class="w-10 h-10 bg-primary dark:bg-white flex items-center justify-center">
              <i data-lucide="shield" class="w-5 h-5 text-white dark:text-gray-900"></i>
            </div>
            <h2 class="text-lg font-impact uppercase text-primary dark:text-white tracking-wide">Security</h2>
          </div>
          
          <form id="password-form" class="space-y-4">
            <div>
              <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Current Password</label>
              <input type="password" id="current_password" name="current_password" 
                     class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                     placeholder="Enter current password" required>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">New Password</label>
                <input type="password" id="new_password" name="new_password" 
                       class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                       placeholder="Min. 6 characters" required minlength="6">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-medium mb-2">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" 
                       class="w-full px-4 py-3 border border-border dark:border-gray-600 bg-gray-50 dark:bg-gray-800 text-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-white transition-shadow"
                       placeholder="Confirm password" required>
              </div>
            </div>
            
            <button type="submit" id="password-btn" 
                    class="w-full border-2 border-primary dark:border-white text-primary dark:text-white py-4 uppercase tracking-wider text-sm font-semibold flex items-center justify-center gap-2 bg-transparent">
              <i data-lucide="key" class="w-4 h-4"></i>
              <span>Change Password</span>
            </button>
            
            <div id="password-status" class="hidden text-center py-3 px-4 text-sm"></div>
          </form>
        </div>
        
      </div>
      
      {{-- Not Logged In State --}}
      <div id="account-login" class="text-center py-20 hidden">
        <div class="w-24 h-24 border-2 border-border dark:border-gray-700 flex items-center justify-center mx-auto mb-6">
          <i data-lucide="user" class="w-12 h-12 text-secondary dark:text-gray-400"></i>
        </div>
        <h2 class="text-3xl font-impact text-primary dark:text-white uppercase mb-3">Sign In Required</h2>
        <p class="text-secondary dark:text-gray-400 mb-6 max-w-sm mx-auto">
          Please sign in to manage your account.
        </p>
        <button id="account-login-btn" class="bg-primary dark:bg-white text-white dark:text-gray-900 px-8 py-3 uppercase tracking-wider text-sm font-semibold inline-flex items-center gap-2">
          <i data-lucide="log-in" class="w-4 h-4"></i>
          <span>Sign In</span>
        </button>
      </div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script>
(function() {
    'use strict';

    function getSessionToken() {
        try {
            const user = JSON.parse(localStorage.getItem('eshop_user') || 'null');
            return user?.session_token || null;
        } catch { return null; }
    }

    function getUserData() {
        try {
            return JSON.parse(localStorage.getItem('eshop_user') || 'null');
        } catch { return null; }
    }

    function showStatus(elementId, message, isError = false) {
        const statusEl = document.getElementById(elementId);
        statusEl.textContent = message;
        statusEl.className = `text-center py-3 px-4 text-sm ${isError ? 'bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400' : 'bg-green-50 text-green-600 dark:bg-green-900/20 dark:text-green-400'}`;
        statusEl.classList.remove('hidden');
        
        setTimeout(() => {
            statusEl.classList.add('hidden');
        }, 5000);
    }

    async function loadAccount() {
        const loadingEl = document.getElementById('account-loading');
        const formContainer = document.getElementById('account-form-container');
        const loginEl = document.getElementById('account-login');

        const user = getUserData();
        if (!user || !user.session_token) {
            loadingEl.classList.add('hidden');
            loginEl.classList.remove('hidden');
            
            document.getElementById('account-login-btn')?.addEventListener('click', () => {
                const modal = document.getElementById('login-modal');
                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                }
            });
            
            if (window.lucide) window.lucide.createIcons();
            return;
        }

        try {
            const sessionToken = getSessionToken();
            const response = await fetch('/api/users/profile', {
                headers: {
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${sessionToken}`
                }
            });
            
            const data = await response.json();
            
            loadingEl.classList.add('hidden');
            formContainer.classList.remove('hidden');
            
            if (data.success && data.user) {
                document.getElementById('first_name').value = data.user.first_name || '';
                document.getElementById('middle_name').value = data.user.middle_name || '';
                document.getElementById('last_name').value = data.user.last_name || '';
                document.getElementById('email').value = data.user.email || '';
                document.getElementById('country_code').value = data.user.country_code || '';
                document.getElementById('phone').value = data.user.phone || '';
                document.getElementById('address1').value = data.user.address1 || '';
                document.getElementById('address2').value = data.user.address2 || '';
            } else {
                document.getElementById('first_name').value = user.first_name || '';
                document.getElementById('last_name').value = user.last_name || '';
                document.getElementById('email').value = user.email || '';
            }

            if (window.lucide) window.lucide.createIcons();
        } catch (error) {
            console.error('Error loading account:', error);
            loadingEl.classList.add('hidden');
            formContainer.classList.remove('hidden');
            
            const user = getUserData();
            if (user) {
                document.getElementById('first_name').value = user.first_name || '';
                document.getElementById('last_name').value = user.last_name || '';
                document.getElementById('email').value = user.email || '';
            }
            
            if (window.lucide) window.lucide.createIcons();
        }
    }

    async function handleFormSubmit(e) {
        e.preventDefault();
        
        const saveBtn = document.getElementById('save-btn');
        const originalContent = saveBtn.innerHTML;
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<span class="loading-spinner" style="width: 20px; height: 20px;"></span> Saving...';
        
        const formData = {
            first_name: document.getElementById('first_name').value,
            middle_name: document.getElementById('middle_name').value,
            last_name: document.getElementById('last_name').value,
            country_code: document.getElementById('country_code').value,
            phone: document.getElementById('phone').value,
            address1: document.getElementById('address1').value,
            address2: document.getElementById('address2').value,
        };
        
        try {
            const sessionToken = getSessionToken();
            const response = await fetch('/api/users/profile', {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${sessionToken}`
                },
                body: JSON.stringify(formData)
            });
            
            const data = await response.json();
            
            if (data.success) {
                showStatus('form-status', 'Changes saved successfully!');
                
                const user = getUserData();
                if (user) {
                    user.first_name = formData.first_name;
                    user.last_name = formData.last_name;
                    localStorage.setItem('eshop_user', JSON.stringify(user));
                    
                    const dropdownName = document.getElementById('user-dropdown-name');
                    if (dropdownName) {
                        dropdownName.textContent = formData.first_name || user.email || 'User';
                    }
                }
            } else {
                showStatus('form-status', data.error || 'Failed to save. Please try again.', true);
            }
        } catch (error) {
            console.error('Error updating account:', error);
            showStatus('form-status', 'An error occurred. Please try again.', true);
        } finally {
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalContent;
            if (window.lucide) window.lucide.createIcons();
        }
    }

    async function handlePasswordSubmit(e) {
        e.preventDefault();
        
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        
        if (newPassword !== confirmPassword) {
            showStatus('password-status', 'Passwords do not match.', true);
            return;
        }
        
        if (newPassword.length < 6) {
            showStatus('password-status', 'Password must be at least 6 characters.', true);
            return;
        }
        
        const passwordBtn = document.getElementById('password-btn');
        const originalContent = passwordBtn.innerHTML;
        passwordBtn.disabled = true;
        passwordBtn.innerHTML = '<span class="loading-spinner" style="width: 20px; height: 20px;"></span> Updating...';
        
        try {
            const sessionToken = getSessionToken();
            const response = await fetch('/api/users/change-password', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${sessionToken}`
                },
                body: JSON.stringify({
                    current_password: document.getElementById('current_password').value,
                    new_password: newPassword,
                    confirm_password: confirmPassword,
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showStatus('password-status', 'Password updated successfully!');
                document.getElementById('current_password').value = '';
                document.getElementById('new_password').value = '';
                document.getElementById('confirm_password').value = '';
            } else {
                showStatus('password-status', data.error || 'Current password is incorrect.', true);
            }
        } catch (error) {
            console.error('Error changing password:', error);
            showStatus('password-status', 'An error occurred. Please try again.', true);
        } finally {
            passwordBtn.disabled = false;
            passwordBtn.innerHTML = originalContent;
            if (window.lucide) window.lucide.createIcons();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            loadAccount();
            document.getElementById('account-form')?.addEventListener('submit', handleFormSubmit);
            document.getElementById('password-form')?.addEventListener('submit', handlePasswordSubmit);
        });
    } else {
        loadAccount();
        document.getElementById('account-form')?.addEventListener('submit', handleFormSubmit);
        document.getElementById('password-form')?.addEventListener('submit', handlePasswordSubmit);
    }
})();
</script>
@endpush
