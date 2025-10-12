<?php /* Cart page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Shop - Shopping Cart</title>
  <script>(function(){try{var t=localStorage.getItem('eshop-theme')||(window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');document.documentElement.setAttribute('data-theme',t);document.documentElement.setAttribute('data-bs-theme',t==='dark'?'dark':'light');}catch(e){}})();</script>
  <link href="../dist/styles.css" rel="stylesheet" />
  <link href="../dist/theme.css" rel="stylesheet" />
  <link href="../styles.css" rel="stylesheet" />
  
</head>
<body>
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition">
  <header class="hero-section py-5 mb-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col">
          <h1 class="display-6 fw-bold text-primary mb-2"><i class="bi bi-cart3 me-2"></i>Your Cart</h1>
          <p class="lead mb-0">Review your items and proceed to checkout</p>
        </div>
      </div>
    </div>
  </header>

  <main class="container pb-5">
    <div class="row g-4">
      <div class="col-lg-8">
        <div id="cart-items" class="vstack gap-3"></div>
        <div id="cart-empty" class="alert alert-info d-none">Your cart is empty. <a href="products.php" class="alert-link">Browse products</a>.</div>
      </div>
      <div class="col-lg-4">
        <div class="card shadow-sm surface-card">
          <div class="card-body">
            <h2 class="h5">Summary</h2>
            <ul class="list-unstyled small mb-3">
              <li class="d-flex justify-content-between"><span>Subtotal</span><strong id="summary-subtotal">$0.00</strong></li>
              <li class="d-flex justify-content-between"><span>Tax (8%)</span><strong id="summary-tax">$0.00</strong></li>
              <li class="d-flex justify-content-between border-top pt-2"><span>Total</span><strong id="summary-total" class="fs-5">$0.00</strong></li>
            </ul>
            <button class="btn btn-primary w-100" id="checkout" disabled>Checkout</button>
            <button class="btn btn-outline-danger w-100 mt-2" id="clear-cart" disabled>Clear Cart</button>
            <div id="checkout-msg" class="alert alert-success mt-3 d-none">Order placed (demo)!</div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <div id="footer-container"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../scripts/app.js"></script>
  <script src="../scripts/login.js"></script>
  <script>window.Eshop && window.Eshop.pages.cart();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
