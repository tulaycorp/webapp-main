@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - My Orders')

@section('content')
<div class="pt-32">
  {{-- Orders Hero --}}
  <section class="py-20 px-6 lg:px-8 bg-background dark:bg-gray-800 min-h-[30vh] flex items-center transition-colors duration-300 relative overflow-hidden">
    {{-- Subtle Grid Pattern --}}
    <div class="absolute inset-0 bg-pattern dark:opacity-10"></div>
    
    <div class="max-w-7xl mx-auto w-full relative">
      <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-8 gap-6">
        <div>
          <p data-animate="slide-left" data-delay="100" 
             class="text-secondary dark:text-gray-400 mb-4 uppercase tracking-[0.3em] text-base font-medium">
            Account
          </p>
          <h1 data-animate="slide-left" data-delay="200" 
              class="text-5xl lg:text-7xl text-primary dark:text-white uppercase tracking-tighter font-impact leading-[0.85] mb-6">
            My Orders
          </h1>
          <p data-animate="fade-in" data-delay="300"
             class="text-lg lg:text-xl text-secondary dark:text-gray-400 max-w-xl leading-relaxed">
            View your order history and track your purchases.
          </p>
        </div>
        <button data-animate="slide-right" data-delay="300" 
                data-hover="scale"
                onclick="window.location.href='{{ route('products') }}'"
                class="text-primary dark:text-white uppercase tracking-wider text-sm border-2 border-primary dark:border-white px-8 py-4 hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-gray-900 transition-all shadow-lg hover:shadow-xl font-medium">
          Continue Shopping &rarr;
        </button>
      </div>
    </div>
  </section>
  
  {{-- Orders Content --}}
  <section class="py-16 px-6 lg:px-8 bg-background dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-5xl mx-auto">
      {{-- Loading State --}}
      <div id="orders-loading" class="text-center py-16">
        <div class="loading-spinner mx-auto mb-4" style="width: 40px; height: 40px;"></div>
        <p class="text-secondary dark:text-gray-400">Loading your orders...</p>
      </div>
      
      {{-- Orders List --}}
      <div id="orders-list" class="space-y-6 hidden">
        {{-- Orders rendered via JS --}}
      </div>
      
      {{-- Empty State --}}
      <div id="orders-empty" class="text-center py-20 hidden">
        <div class="w-32 h-32 border-2 border-border dark:border-gray-700 flex items-center justify-center mx-auto mb-8">
          <i data-lucide="package" class="w-16 h-16 text-secondary dark:text-gray-400"></i>
        </div>
        <h2 class="text-4xl font-impact text-primary dark:text-white uppercase mb-4">No Orders Yet</h2>
        <p class="text-lg text-secondary dark:text-gray-400 mb-8 max-w-md mx-auto">
          You haven't placed any orders yet. Start shopping to see your orders here.
        </p>
        <a href="{{ route('products') }}" class="btn-primary dark:bg-white dark:text-gray-900 inline-flex items-center gap-2">
          <span>Start Shopping</span>
          <i data-lucide="arrow-right" class="w-5 h-5"></i>
        </a>
      </div>
      
      {{-- Not Logged In State --}}
      <div id="orders-login" class="text-center py-20 hidden">
        <div class="w-32 h-32 border-2 border-border dark:border-gray-700 flex items-center justify-center mx-auto mb-8">
          <i data-lucide="user" class="w-16 h-16 text-secondary dark:text-gray-400"></i>
        </div>
        <h2 class="text-4xl font-impact text-primary dark:text-white uppercase mb-4">Sign In Required</h2>
        <p class="text-lg text-secondary dark:text-gray-400 mb-8 max-w-md mx-auto">
          Please sign in to view your order history.
        </p>
        <button id="orders-login-btn" class="btn-primary dark:bg-white dark:text-gray-900 inline-flex items-center gap-2">
          <i data-lucide="log-in" class="w-5 h-5"></i>
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

    function formatMoney(n) {
        return '$' + Number(n).toFixed(2);
    }

    function getSessionToken() {
        try {
            const user = JSON.parse(localStorage.getItem('eshop_user') || 'null');
            return user?.session_token || null;
        } catch { return null; }
    }

    function getStatusColor(status) {
        const colors = {
            'pending': 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
            'processing': 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
            'shipped': 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
            'delivered': 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            'cancelled': 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
        };
        return colors[status] || 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
    }

    function renderOrder(order) {
        return `
            <div class="modern-card dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-border dark:border-gray-700">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 border-2 border-primary dark:border-white flex items-center justify-center">
                                <i data-lucide="package" class="w-6 h-6 text-primary dark:text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-impact text-primary dark:text-white uppercase">${order.order_number}</h3>
                                <p class="text-sm text-secondary dark:text-gray-400">${order.created_at_formatted}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="px-3 py-1 text-xs uppercase tracking-wider font-semibold rounded ${getStatusColor(order.status)}">
                                ${order.status_label}
                            </span>
                            <span class="text-2xl font-impact text-primary dark:text-white">${formatMoney(order.total)}</span>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Items</p>
                            <div class="space-y-2">
                                ${order.items.map(item => `
                                    <div class="flex justify-between text-sm">
                                        <span class="text-primary dark:text-white">${item.product_name} x ${item.quantity}</span>
                                        <span class="text-secondary dark:text-gray-400">${formatMoney(item.total)}</span>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Shipping To</p>
                            <p class="text-sm text-primary dark:text-white">${order.customer_name}</p>
                            <p class="text-sm text-secondary dark:text-gray-400">${order.shipping_address}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-border dark:border-gray-700">
                        <div class="flex flex-wrap justify-between gap-4 text-sm">
                            <div class="flex gap-6">
                                <span class="text-secondary dark:text-gray-400">Total: <strong class="text-primary dark:text-white">${formatMoney(order.total)}</strong></span>
                                <span class="text-secondary dark:text-gray-400">Shipping: <strong class="text-primary dark:text-white">${order.shipping === 0 ? 'FREE' : formatMoney(order.shipping)}</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    async function loadOrders() {
        const loadingEl = document.getElementById('orders-loading');
        const listEl = document.getElementById('orders-list');
        const emptyEl = document.getElementById('orders-empty');
        const loginEl = document.getElementById('orders-login');

        // Check if user is logged in
        const user = localStorage.getItem('eshop_user');
        if (!user) {
            loadingEl.classList.add('hidden');
            loginEl.classList.remove('hidden');
            
            // Wire up login button
            document.getElementById('orders-login-btn')?.addEventListener('click', () => {
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
            const headers = { 'Accept': 'application/json' };
            if (sessionToken) {
                headers['Authorization'] = `Bearer ${sessionToken}`;
            }

            const response = await fetch('/orders/data', {
                credentials: 'same-origin',
                headers: headers
            });
            const data = await response.json();

            loadingEl.classList.add('hidden');

            if (data.success && data.orders && data.orders.length > 0) {
                listEl.innerHTML = data.orders.map(renderOrder).join('');
                listEl.classList.remove('hidden');
            } else {
                emptyEl.classList.remove('hidden');
            }

            if (window.lucide) window.lucide.createIcons();
        } catch (error) {
            console.error('Error loading orders:', error);
            loadingEl.classList.add('hidden');
            emptyEl.classList.remove('hidden');
            if (window.lucide) window.lucide.createIcons();
        }
    }

    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadOrders);
    } else {
        loadOrders();
    }
})();
</script>
@endpush
