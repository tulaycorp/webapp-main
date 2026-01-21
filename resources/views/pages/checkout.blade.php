@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - Checkout')

@section('content')
<div class="pt-32">
  {{-- Checkout Hero --}}
  <section class="py-20 px-6 lg:px-8 bg-background dark:bg-gray-800 min-h-[30vh] flex items-center transition-colors duration-300 relative overflow-hidden">
    {{-- Subtle Grid Pattern --}}
    <div class="absolute inset-0 bg-pattern dark:opacity-10"></div>
    
    <div class="max-w-7xl mx-auto w-full relative">
      <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-8 gap-6">
        <div>
          <p data-animate="slide-left" data-delay="100" 
             class="text-secondary dark:text-gray-400 mb-4 uppercase tracking-[0.3em] text-base font-medium">
            Secure Checkout
          </p>
          <h1 data-animate="slide-left" data-delay="200" 
              class="text-5xl lg:text-7xl text-primary dark:text-white uppercase tracking-tighter font-impact leading-[0.85] mb-6">
            Checkout
          </h1>
          <p data-animate="fade-in" data-delay="300"
             class="text-lg lg:text-xl text-secondary dark:text-gray-400 max-w-xl leading-relaxed">
            Complete your order securely. All transactions are encrypted.
          </p>
        </div>
        <button data-animate="slide-right" data-delay="300" 
                data-hover="scale"
                onclick="window.location.href='{{ route('cart') }}'"
                class="text-primary dark:text-white uppercase tracking-wider text-sm border-2 border-primary dark:border-white px-8 py-4 hover:bg-primary dark:hover:bg-white hover:text-white dark:hover:text-gray-900 transition-all shadow-lg hover:shadow-xl font-medium">
          &larr; Back to Cart
        </button>
      </div>
    </div>
  </section>
  
  {{-- Checkout Form --}}
  <section class="py-16 px-6 lg:px-8 bg-background dark:bg-gray-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto">
      <form id="checkout-form" class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        {{-- Left Column: Shipping & Payment --}}
        <div class="lg:col-span-2 space-y-10">
          
          {{-- Shipping Information --}}
          <div class="modern-card dark:bg-gray-800 dark:border-gray-700 p-8">
            <h2 class="text-2xl uppercase tracking-tight text-primary dark:text-white font-impact mb-8 flex items-center gap-3">
              <span class="w-10 h-10 border-2 border-primary dark:border-white flex items-center justify-center text-lg">1</span>
              Shipping Information
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">First Name *</label>
                <input type="text" name="shipping_first_name" required
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="John">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Last Name *</label>
                <input type="text" name="shipping_last_name" required
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="Doe">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Email *</label>
                <input type="email" name="shipping_email" required
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="john@example.com">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Phone</label>
                <input type="tel" name="shipping_phone"
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="+1 (555) 123-4567">
              </div>
              <div class="md:col-span-2">
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Address Line 1 *</label>
                <input type="text" name="shipping_address1" required
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="123 Main Street">
              </div>
              <div class="md:col-span-2">
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Address Line 2</label>
                <input type="text" name="shipping_address2"
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="Apt, Suite, Unit (optional)">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">City *</label>
                <input type="text" name="shipping_city" required
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="New York">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">State/Province *</label>
                <input type="text" name="shipping_state" required
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="NY">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">ZIP/Postal Code *</label>
                <input type="text" name="shipping_zip" required
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="10001">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Country *</label>
                <select name="shipping_country" required
                        class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                  <option value="">Select Country</option>
                  <option value="US" selected>United States</option>
                  <option value="CA">Canada</option>
                  <option value="UK">United Kingdom</option>
                  <option value="AU">Australia</option>
                  <option value="DE">Germany</option>
                  <option value="FR">France</option>
                </select>
              </div>
            </div>
          </div>
          
          {{-- Payment Information --}}
          <div class="modern-card dark:bg-gray-800 dark:border-gray-700 p-8">
            <h2 class="text-2xl uppercase tracking-tight text-primary dark:text-white font-impact mb-8 flex items-center gap-3">
              <span class="w-10 h-10 border-2 border-primary dark:border-white flex items-center justify-center text-lg">2</span>
              Payment Information
            </h2>
            

            
            <div class="space-y-6">
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Cardholder Name *</label>
                <input type="text" name="card_name" required
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                       placeholder="JOHN DOE">
              </div>
              <div>
                <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Card Number *</label>
                <div class="relative">
                  <input type="text" name="card_number" id="card-number" required
                         maxlength="19"
                         class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white pr-14 font-mono"
                         placeholder="4242 4242 4242 4242">
                  <div id="card-type-icon" class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary dark:text-gray-400">
                    <i data-lucide="credit-card" class="w-6 h-6"></i>
                  </div>
                </div>
                <div id="card-validation-msg" class="mt-2 text-sm hidden"></div>
              </div>
              <div class="grid grid-cols-2 gap-6">
                <div>
                  <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Expiry Date *</label>
                  <input type="text" name="card_expiry" id="card-expiry" required
                         maxlength="5"
                         class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white font-mono"
                         placeholder="MM/YY">
                </div>
                <div>
                  <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">CVC *</label>
                  <input type="text" name="card_cvc" id="card-cvc" required
                         maxlength="4"
                         class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white font-mono"
                         placeholder="123">
                </div>
              </div>
            </div>
          </div>
        </div>
        
        {{-- Right Column: Order Summary --}}
        <div>
          <div class="modern-card dark:bg-gray-800 dark:border-gray-700 p-8 sticky top-36">
            <h2 class="text-2xl uppercase tracking-tight text-primary dark:text-white font-impact mb-8">Order Summary</h2>
            
            {{-- Cart Items --}}
            <div id="checkout-items" class="space-y-4 mb-8 max-h-64 overflow-y-auto">
              {{-- Items loaded via JS --}}
            </div>
            
            {{-- Empty State --}}
            <div id="checkout-empty" class="text-center py-8 hidden">
              <i data-lucide="shopping-bag" class="w-12 h-12 text-secondary dark:text-gray-400 mx-auto mb-4"></i>
              <p class="text-secondary dark:text-gray-400">Your cart is empty</p>
              <a href="{{ route('products') }}" class="text-primary dark:text-white underline mt-2 inline-block">Shop Now</a>
            </div>
            
            {{-- Discount Code Input --}}
            <div class="border-t-2 border-border dark:border-gray-700 pt-6 mb-6">
              <label class="block text-xs uppercase tracking-wider text-secondary dark:text-gray-400 font-semibold mb-2">Discount Code</label>
              <div class="flex gap-2">
                <input type="text" id="coupon-code-input" 
                       class="form-input dark:bg-gray-700 dark:border-gray-600 dark:text-white flex-1"
                       placeholder="Enter code"
                       style="text-transform: uppercase;">
                <button type="button" id="apply-coupon-btn" data-hover="scale"
                        class="btn-secondary px-6 whitespace-nowrap">
                  Apply
                </button>
              </div>
              <input type="hidden" name="coupon_code" id="validated-coupon-code">
              {{-- Coupon Messages --}}
              <div id="coupon-success" class="bg-green-500/10 border-l-4 border-green-500 p-3 mt-3 hidden">
                <p class="text-green-600 dark:text-green-400 text-sm" id="coupon-success-msg"></p>
              </div>
              <div id="coupon-error" class="bg-red-500/10 border-l-4 border-red-500 p-3 mt-3 hidden">
                <p class="text-red-600 dark:text-red-400 text-sm" id="coupon-error-msg"></p>
              </div>
            </div>
            
            {{-- Totals --}}
            <div class="space-y-4 border-t-2 border-border dark:border-gray-700 pt-6 mb-8">
              <div class="flex justify-between items-center">
                <span class="text-secondary dark:text-gray-400 uppercase text-sm tracking-wider font-medium">Subtotal</span>
                <strong class="text-primary dark:text-white text-lg font-impact" id="checkout-subtotal">$0.00</strong>
              </div>
              <div class="flex justify-between items-center">
                <span class="text-secondary dark:text-gray-400 uppercase text-sm tracking-wider font-medium">Shipping</span>
                <strong class="text-lg font-impact" id="checkout-shipping">$0.00</strong>
              </div>
              <div class="flex justify-between items-center">
                <span class="text-secondary dark:text-gray-400 uppercase text-sm tracking-wider font-medium">Tax (8%)</span>
                <strong class="text-primary dark:text-white text-lg font-impact" id="checkout-tax">$0.00</strong>
              </div>
              {{-- Discount Row (Hidden by default) --}}
              <div class="flex justify-between items-center hidden" id="checkout-discount-row">
                <span class="text-green-600 dark:text-green-400 uppercase text-sm tracking-wider font-medium">
                  Discount (<span id="applied-coupon-code"></span>)
                  <button type="button" id="remove-coupon-btn" class="ml-2 text-red-500 hover:text-red-700">
                    <i data-lucide="x" class="w-4 h-4 inline"></i>
                  </button>
                </span>
                <strong class="text-green-600 dark:text-green-400 text-lg font-impact" id="checkout-discount">-$0.00</strong>
              </div>
              <div class="flex justify-between items-center pt-4 border-t-2 border-border dark:border-gray-700">
                <span class="text-primary dark:text-white text-lg uppercase tracking-wider font-semibold">Total</span>
                <strong class="text-primary dark:text-white text-3xl font-impact" id="checkout-total">$0.00</strong>
              </div>
            </div>
            
            {{-- Submit Button --}}
            <button type="submit" id="place-order-btn" data-hover="scale"
                    class="btn-primary dark:bg-white dark:text-gray-900 w-full py-5 text-lg flex items-center justify-center gap-3"
                    disabled>
              <i data-lucide="lock" class="w-5 h-5"></i>
              <span>Place Order</span>
            </button>
            
            {{-- Error Message --}}
            <div id="checkout-error" class="bg-red-500/10 border-l-4 border-red-500 p-4 mt-6 hidden">
              <p class="text-red-600 dark:text-red-400 text-sm" id="checkout-error-msg"></p>
            </div>
            
            {{-- Success Message --}}
            <div id="checkout-success" class="bg-green-500/10 border-l-4 border-green-500 p-4 mt-6 hidden">
              <div class="flex items-start gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5"></i>
                <div>
                  <p class="text-green-600 dark:text-green-400 font-medium">Order Placed Successfully!</p>
                  <p class="text-green-600 dark:text-green-400 text-sm" id="checkout-order-number"></p>
                </div>
              </div>
            </div>
            
            {{-- Trust Badges --}}
            <div class="pt-8 border-t-2 border-border dark:border-gray-700 mt-8 space-y-4">
              <div class="flex items-center gap-3 text-sm text-secondary dark:text-gray-400">
                <i data-lucide="shield-check" class="w-5 h-5 text-primary dark:text-white flex-shrink-0"></i>
                <span>256-bit SSL Encryption</span>
              </div>
              <div class="flex items-center gap-3 text-sm text-secondary dark:text-gray-400">
                <i data-lucide="lock" class="w-5 h-5 text-primary dark:text-white flex-shrink-0"></i>
                <span>Secure Payment Processing</span>
              </div>
              <div class="flex items-center gap-3 text-sm text-secondary dark:text-gray-400">
                <i data-lucide="refresh-cw" class="w-5 h-5 text-primary dark:text-white flex-shrink-0"></i>
                <span>30-Day Money Back Guarantee</span>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/checkout.js') }}" defer></script>
@endpush
