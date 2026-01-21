/**
 * Checkout Page JavaScript
 * Handles form validation, Luhn card validation, and order submission
 */

(function () {
    'use strict';

    const STORAGE_KEY = 'eshop-cart-v1';

    // Helper functions
    function loadCart() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); } catch { return []; }
    }

    function clearCart() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify([]));
        window.dispatchEvent(new CustomEvent('cart-updated', { detail: [] }));
    }

    function formatMoney(n) {
        return `$${Number(n).toFixed(2)}`;
    }

    function getSessionToken() {
        try {
            const user = JSON.parse(localStorage.getItem('eshop_user') || 'null');
            return user?.session_token || null;
        } catch { return null; }
    }

    /**
     * Luhn Algorithm Implementation
     * Validates credit card numbers
     */
    function validateLuhn(cardNumber) {
        // Remove spaces and dashes
        const cleaned = cardNumber.replace(/[\s-]/g, '');

        // Check if all digits
        if (!/^\d+$/.test(cleaned)) {
            return false;
        }

        // Check length (13-19 digits)
        if (cleaned.length < 13 || cleaned.length > 19) {
            return false;
        }

        // Luhn algorithm
        let sum = 0;
        let alternate = false;

        for (let i = cleaned.length - 1; i >= 0; i--) {
            let digit = parseInt(cleaned[i], 10);

            if (alternate) {
                digit *= 2;
                if (digit > 9) {
                    digit -= 9;
                }
            }

            sum += digit;
            alternate = !alternate;
        }

        return (sum % 10) === 0;
    }

    /**
     * Detect card type from number
     */
    function getCardType(cardNumber) {
        const cleaned = cardNumber.replace(/[\s-]/g, '');

        if (/^4/.test(cleaned)) {
            return 'visa';
        }
        if (/^5[1-5]/.test(cleaned) || /^2[2-7]/.test(cleaned)) {
            return 'mastercard';
        }
        if (/^3[47]/.test(cleaned)) {
            return 'amex';
        }
        if (/^6(?:011|5)/.test(cleaned)) {
            return 'discover';
        }

        return null;
    }

    /**
     * Format card number with spaces
     */
    function formatCardNumber(value) {
        const cleaned = value.replace(/\D/g, '');
        const groups = cleaned.match(/.{1,4}/g);
        return groups ? groups.join(' ') : cleaned;
    }

    /**
     * Format expiry date
     */
    function formatExpiry(value) {
        const cleaned = value.replace(/\D/g, '');
        if (cleaned.length >= 2) {
            return cleaned.substring(0, 2) + '/' + cleaned.substring(2, 4);
        }
        return cleaned;
    }

    /**
     * Validate expiry date
     */
    function validateExpiry(value) {
        if (!value || value.length < 5) return false;

        const [month, year] = value.split('/');
        if (!month || !year) return false;

        const currentYear = new Date().getFullYear() % 100; // 2 digits
        const currentMonth = new Date().getMonth() + 1;

        const expMonth = parseInt(month, 10);
        const expYear = parseInt(year, 10);

        if (expMonth < 1 || expMonth > 12) return false;

        if (expYear < currentYear) return false;
        if (expYear === currentYear && expMonth < currentMonth) return false;

        return true;
    }

    /**
     * Initialize checkout page
     */
    function initCheckout() {
        const form = document.getElementById('checkout-form');
        if (!form) return;

        const cardNumberInput = document.getElementById('card-number');
        const cardExpiryInput = document.getElementById('card-expiry');
        const cardCvcInput = document.getElementById('card-cvc');
        const cardTypeIcon = document.getElementById('card-type-icon');
        const validationMsg = document.getElementById('card-validation-msg');
        const placeOrderBtn = document.getElementById('place-order-btn');
        const checkoutError = document.getElementById('checkout-error');
        const checkoutErrorMsg = document.getElementById('checkout-error-msg');
        const checkoutSuccess = document.getElementById('checkout-success');
        const checkoutOrderNumber = document.getElementById('checkout-order-number');

        let catalog = [];

        // Load product catalog
        function loadCatalog() {
            return fetch('/api/products.php?action=list')
                .then(res => res.json())
                .then(response => {
                    if (response && response.success && response.products) {
                        catalog = response.products;
                    }
                    return catalog;
                })
                .catch(err => {
                    console.error('Error loading catalog:', err);
                    return [];
                });
        }

        // Get product by ID
        function getProduct(id) {
            return catalog.find(p => p.id == id);
        }

        // Render order summary
        function renderOrderSummary() {
            const cart = loadCart();
            const itemsContainer = document.getElementById('checkout-items');
            const emptyState = document.getElementById('checkout-empty');
            const subtotalEl = document.getElementById('checkout-subtotal');
            const shippingEl = document.getElementById('checkout-shipping');
            const taxEl = document.getElementById('checkout-tax');
            const totalEl = document.getElementById('checkout-total');

            if (cart.length === 0) {
                itemsContainer.innerHTML = '';
                emptyState.classList.remove('hidden');
                placeOrderBtn.disabled = true;
                return;
            }

            emptyState.classList.add('hidden');

            // Render items
            itemsContainer.innerHTML = cart.map(item => {
                const product = getProduct(item.id);
                if (!product) {
                    return `<div class="text-red-500 text-sm">Product not found: ${item.id}</div>`;
                }

                return `
                    <div class="flex items-center gap-4 pb-4 border-b border-border dark:border-gray-700">
                        <img src="${product.img || product.image_url || 'https://via.placeholder.com/60'}" 
                             alt="${product.name}"
                             class="w-14 h-14 object-cover bg-gray-100 dark:bg-gray-700 flex-shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-primary dark:text-white truncate">${product.name}</p>
                            <p class="text-xs text-secondary dark:text-gray-400">Qty: ${item.qty}</p>
                        </div>
                        <p class="text-sm font-impact text-primary dark:text-white">${formatMoney(product.price * item.qty)}</p>
                    </div>
                `;
            }).join('');

            // Calculate totals
            const subtotal = cart.reduce((sum, item) => {
                const product = getProduct(item.id);
                return sum + (product ? product.price * item.qty : 0);
            }, 0);

            const shipping = subtotal === 0 ? 0 : (subtotal >= 150 ? 0 : 10);
            const tax = subtotal * 0.08;
            const total = subtotal + shipping + tax;

            subtotalEl.textContent = formatMoney(subtotal);

            if (shipping === 0 && subtotal >= 150) {
                shippingEl.textContent = 'FREE';
                shippingEl.className = 'text-green-600 dark:text-green-400 text-lg font-impact';
            } else {
                shippingEl.textContent = formatMoney(shipping);
                shippingEl.className = 'text-primary dark:text-white text-lg font-impact';
            }

            taxEl.textContent = formatMoney(tax);
            totalEl.textContent = formatMoney(total);

            // Enable button if cart has items
            updateSubmitButton();
        }

        // Update card type icon
        function updateCardTypeIcon(type) {
            const icons = {
                visa: '<img src="/images/logos/visa.svg" class="w-10 h-7 object-contain" alt="Visa">',
                mastercard: '<img src="/images/logos/mastercard.svg" class="w-10 h-7 object-contain" alt="Mastercard">',
                amex: '<img src="/images/logos/amex.svg" class="w-10 h-7 object-contain" alt="American Express">',
                discover: '<span class="text-xs font-bold text-orange-500">DISC</span>',
                default: '<i data-lucide="credit-card" class="w-6 h-6"></i>'
            };

            cardTypeIcon.innerHTML = icons[type] || icons.default;
            if (window.lucide) {
                window.lucide.createIcons();
            }
        }

        // Validate card (Luhn only, no UI feedback)
        function validateCard() {
            const cardNumber = cardNumberInput.value;
            const cardType = getCardType(cardNumber);
            updateCardTypeIcon(cardType);
            return validateLuhn(cardNumber);
        }

        // Update submit button state
        function updateSubmitButton() {
            const cart = loadCart();
            const hasItems = cart.length > 0;
            const formValid = form.checkValidity();

            // Only disable if cart is empty or required fields are missing
            // We allow invalid card numbers here so validation errors can be shown on click
            placeOrderBtn.disabled = !(hasItems && formValid);
        }

        // Card number formatting and validation
        cardNumberInput.addEventListener('input', function (e) {
            const cursorPos = e.target.selectionStart;
            const oldValue = e.target.value;
            const formatted = formatCardNumber(e.target.value);
            e.target.value = formatted;

            // Adjust cursor position
            if (formatted.length > oldValue.length && cursorPos === oldValue.length) {
                e.target.setSelectionRange(formatted.length, formatted.length);
            }

            validateCard();
            updateSubmitButton();
        });

        // Expiry date formatting
        cardExpiryInput.addEventListener('input', function (e) {
            e.target.value = formatExpiry(e.target.value);
            updateSubmitButton();
        });

        // CVC - only digits
        cardCvcInput.addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '');
            updateSubmitButton();
        });

        // Form input change handler
        form.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('change', updateSubmitButton);
            input.addEventListener('input', updateSubmitButton);
        });

        // Form submission
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            // Hide any previous messages immediately
            checkoutError.classList.add('hidden');
            checkoutSuccess.classList.add('hidden');

            const cart = loadCart();
            if (cart.length === 0) {
                showError('Your cart is empty');
                return;
            }

            // Disable button and show loading immediately
            placeOrderBtn.disabled = true;
            placeOrderBtn.innerHTML = '<span class="inline-flex items-center justify-center gap-2"><span class="loading-spinner"></span><span>Processing...</span></span>';

            // Simulate processing delay (1.5 to 2.5 seconds) for realistic UX
            const processingDelay = 1500 + Math.random() * 1000;
            await new Promise(resolve => setTimeout(resolve, processingDelay));

            const isCardValid = validateLuhn(cardNumberInput.value);
            const isExpiryValid = validateExpiry(cardExpiryInput.value);

            // Generic error for any card issue
            if (!isCardValid || !isExpiryValid) {
                showError('Failed to process order. Please check your credit card information');
                resetSubmitButton();
                return;
            }

            try {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const sessionToken = getSessionToken();

                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                };

                if (sessionToken) {
                    headers['Authorization'] = `Bearer ${sessionToken}`;
                }

                const response = await fetch('/checkout/process', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: headers,
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (result.success) {
                    // Clear local cart
                    clearCart();

                    // Show success
                    checkoutSuccess.classList.remove('hidden');
                    checkoutOrderNumber.textContent = `Order #${result.order.order_number}`;

                    // Hide form and show success state
                    form.querySelector('.lg\\:col-span-2').innerHTML = `
                        <div class="modern-card dark:bg-gray-800 dark:border-gray-700 p-12 text-center">
                            <div class="w-24 h-24 border-4 border-green-500 rounded-full flex items-center justify-center mx-auto mb-8">
                                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h2 class="text-4xl font-impact text-primary dark:text-white uppercase mb-4">Thank You!</h2>
                            <p class="text-xl text-secondary dark:text-gray-400 mb-6">Your order has been placed successfully.</p>
                            <p class="text-lg font-semibold text-primary dark:text-white mb-8">Order #${result.order.order_number}</p>
                            <a href="/products" class="btn-primary dark:bg-white dark:text-gray-900 inline-flex items-center gap-2">
                                <span>Continue Shopping</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    `;

                    // Update order summary to show order details
                    renderOrderSummary();

                    // Update cart count in navbar
                    const cartCount = document.getElementById('cart-count');
                    if (cartCount) cartCount.textContent = '0';
                } else {
                    showError(result.message || 'Failed to process order');
                    resetSubmitButton();
                }
            } catch (error) {
                console.error('Checkout error:', error);
                showError('An error occurred. Please try again.');
                resetSubmitButton();
            }
        });

        function showError(message) {
            checkoutError.classList.remove('hidden');
            checkoutErrorMsg.textContent = message;
        }

        function resetSubmitButton() {
            placeOrderBtn.disabled = false;
            placeOrderBtn.innerHTML = `
                <i data-lucide="lock" class="w-5 h-5"></i>
                <span>Place Order</span>
            `;
            if (window.lucide) {
                window.lucide.createIcons();
            }
        }

        // Check if user is logged in
        function checkAuth() {
            const user = localStorage.getItem('eshop_user');
            if (!user) {
                // Store intent and redirect to cart with login prompt
                localStorage.setItem('eshop_intent', 'checkout');
                window.location.href = '/cart';
                return false;
            }
            return true;
        }

        // Autofill shipping info from user profile
        async function autofillShippingInfo() {
            const sessionToken = getSessionToken();
            if (!sessionToken) return;

            try {
                const response = await fetch('/api/users/profile', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${sessionToken}`
                    }
                });

                const data = await response.json();

                if (data.success && data.user) {
                    const user = data.user;

                    // Autofill form fields
                    const fields = {
                        'shipping_first_name': user.first_name,
                        'shipping_last_name': user.last_name,
                        'shipping_email': user.email,
                        'shipping_phone': user.phone ? (user.country_code || '') + ' ' + user.phone : '',
                        'shipping_address1': user.address1,
                        'shipping_address2': user.address2,
                    };

                    Object.entries(fields).forEach(([name, value]) => {
                        const input = form.querySelector(`[name="${name}"]`);
                        if (input && value) {
                            input.value = value.trim();
                        }
                    });

                    // Also autofill card name
                    const cardNameInput = form.querySelector('[name="card_name"]');
                    if (cardNameInput && user.first_name && user.last_name) {
                        cardNameInput.value = `${user.first_name} ${user.last_name}`.toUpperCase();
                    }

                    // Update submit button state after autofill
                    updateSubmitButton();
                }
            } catch (error) {
                console.error('Error loading user profile:', error);
            }
        }

        // Initialize
        if (!checkAuth()) return;

        loadCatalog().then(() => {
            renderOrderSummary();
            autofillShippingInfo();
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    }

    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initCheckout);
    } else {
        initCheckout();
    }
})();
