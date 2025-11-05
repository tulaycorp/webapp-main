<?php /* Cart page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FRAMEWORK Supply Co. - Shopping Cart</title>
  <?php include __DIR__ . '/../includes/head.php'; ?>
</head>
<body class="bg-background min-h-screen">
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition pt-32">
  <!-- Cart Hero -->
  <section class="py-32 px-6 lg:px-8 bg-white min-h-[50vh] flex items-center">
    <div class="max-w-7xl mx-auto w-full">
      <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-12 gap-8">
        <div>
          <p data-animate="slide-left" data-delay="100" 
             class="text-secondary mb-6 uppercase tracking-[0.3em] text-lg font-medium">
            Shopping Bag
          </p>
          <h1 data-animate="slide-left" data-delay="200" 
              class="text-7xl lg:text-9xl text-primary uppercase tracking-tighter font-impact leading-[0.85] mb-8">
            Your<br/>Cart
          </h1>
          <p data-animate="fade-in" data-delay="300"
             class="text-xl lg:text-2xl text-secondary max-w-2xl leading-relaxed">
            Review your items and proceed to secure checkout when you're ready.
          </p>
        </div>
        <button data-animate="slide-right" data-delay="300" 
                data-hover="scale"
                id="continue-shopping"
                onclick="window.location.href='products.php'"
                class="text-primary uppercase tracking-wider text-base border-2 border-primary px-10 py-5 hover:bg-primary hover:text-white transition-all shadow-lg hover:shadow-xl font-medium">
          Continue Shopping →
        </button>
      </div>
    </div>
  </section>
  
  <!-- Cart Content -->
  <section class="py-20 px-6 lg:px-8 bg-background">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
          <div id="cart-items" class="space-y-8"></div>
          
          <!-- Empty State -->
          <div id="cart-empty" class="text-center py-32 hidden">
            <div data-animate="scale-in" data-delay="0"
                 class="inline-flex items-center justify-center w-40 h-40 bg-white border-2 border-border shadow-2xl mb-12">
              <i data-lucide="shopping-bag" class="w-20 h-20 text-secondary"></i>
            </div>
            <h3 data-animate="fade-in" data-delay="200"
                class="text-5xl lg:text-6xl text-primary uppercase mb-6 font-impact">Cart Empty</h3>
            <p data-animate="fade-in" data-delay="400"
               class="text-secondary mb-12 text-xl">Start adding items to your bag</p>
            <a href="products.php" data-animate="fade-in" data-delay="600" data-hover="scale"
               class="btn-primary inline-flex items-center gap-3 text-lg px-12 py-5">
              <span>Shop Now</span>
              <i data-lucide="arrow-right" class="w-6 h-6"></i>
            </a>
          </div>
        </div>
        
        <!-- Order Summary -->
        <div>
          <div class="modern-card p-10 sticky top-36">
            <h2 class="text-3xl uppercase tracking-tight text-primary font-impact mb-10">Order Summary</h2>
            
            <div class="space-y-6 mb-10">
              <div class="flex justify-between items-center pb-6 border-b-2 border-border">
                <span class="text-secondary uppercase text-base tracking-wider font-medium">Subtotal</span>
                <strong class="text-primary text-2xl font-impact" id="summary-subtotal">$0.00</strong>
              </div>
              <div class="flex justify-between items-center pb-6 border-b-2 border-border">
                <span class="text-secondary uppercase text-base tracking-wider font-medium">Shipping</span>
                <strong class="text-green-600 text-xl font-impact">FREE</strong>
              </div>
              <div class="flex justify-between items-center pb-6 border-b-2 border-border">
                <span class="text-secondary uppercase text-base tracking-wider font-medium">Tax (8%)</span>
                <strong class="text-primary text-2xl font-impact" id="summary-tax">$0.00</strong>
              </div>
              <div class="flex justify-between items-center pt-4">
                <span class="text-primary text-xl uppercase tracking-wider font-semibold">Total</span>
                <strong class="text-primary text-4xl font-impact" id="summary-total">$0.00</strong>
              </div>
            </div>
            
            <div class="space-y-4 mb-10">
              <button data-hover="scale" class="btn-primary w-full py-5 text-lg" id="checkout" disabled>
                Proceed to Checkout
              </button>
              <button data-hover="scale" class="btn-secondary w-full py-5 text-lg" id="clear-cart" disabled>
                Clear Cart
              </button>
            </div>
            
            <div id="checkout-msg" class="bg-green-500/10 border-l-4 border-green-500 p-6 mb-8 hidden">
              <p class="text-green-600 uppercase text-base tracking-wider">✓ Order placed successfully!</p>
            </div>
            
            <!-- Trust Badges -->
            <div class="pt-8 border-t-2 border-border space-y-5">
              <p class="text-base uppercase tracking-wider text-primary font-semibold mb-6">Why Shop With Us</p>
              <div class="flex items-start gap-4 text-base text-secondary">
                <i data-lucide="shield-check" class="w-6 h-6 text-primary flex-shrink-0 mt-1"></i>
                <span class="leading-relaxed">Secure SSL encrypted checkout</span>
              </div>
              <div class="flex items-start gap-4 text-base text-secondary">
                <i data-lucide="truck" class="w-6 h-6 text-primary flex-shrink-0 mt-1"></i>
                <span class="leading-relaxed">Free shipping on orders over $150</span>
              </div>
              <div class="flex items-start gap-4 text-base text-secondary">
                <i data-lucide="rotate-ccw" class="w-6 h-6 text-primary flex-shrink-0 mt-1"></i>
                <span class="leading-relaxed">30-day hassle-free returns</span>
              </div>
              <div class="flex items-start gap-4 text-base text-secondary">
                <i data-lucide="headset" class="w-6 h-6 text-primary flex-shrink-0 mt-1"></i>
                <span class="leading-relaxed">24/7 customer support</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Promo Section -->
  <section class="py-32 px-6 lg:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
        <div class="modern-card p-12 text-center" data-animate="fade-in" data-delay="0">
          <div class="w-24 h-24 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-8 transition-all hover:bg-primary hover:text-white">
            <i data-lucide="percent" class="w-12 h-12"></i>
          </div>
          <h3 class="text-2xl uppercase tracking-tight text-primary font-impact mb-4">Save 10%</h3>
          <p class="text-secondary text-lg leading-relaxed">Use code FIRST10 on your first order over $100</p>
        </div>
        <div class="modern-card p-12 text-center" data-animate="fade-in" data-delay="100">
          <div class="w-24 h-24 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-8 transition-all hover:bg-primary hover:text-white">
            <i data-lucide="gift" class="w-12 h-12"></i>
          </div>
          <h3 class="text-2xl uppercase tracking-tight text-primary font-impact mb-4">Free Gift</h3>
          <p class="text-secondary text-lg leading-relaxed">Get a free tote bag with purchases over $200</p>
        </div>
        <div class="modern-card p-12 text-center" data-animate="fade-in" data-delay="200">
          <div class="w-24 h-24 border-2 border-primary text-primary flex items-center justify-center mx-auto mb-8 transition-all hover:bg-primary hover:text-white">
            <i data-lucide="zap" class="w-12 h-12"></i>
          </div>
          <h3 class="text-2xl uppercase tracking-tight text-primary font-impact mb-4">Fast Delivery</h3>
          <p class="text-secondary text-lg leading-relaxed">Express shipping available at checkout</p>
        </div>
      </div>
    </div>
  </section>

  <div id="footer-container"></div>
  </div>

  <?php include __DIR__ . '/../includes/scripts.php'; ?>
  <script>window.Eshop && window.Eshop.pages.cart();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
