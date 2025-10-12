<?php /* Home page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Shop - Premium Products for Modern Living</title>
  <script>(function(){try{var t=localStorage.getItem('eshop-theme')||(window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');document.documentElement.setAttribute('data-theme',t);document.documentElement.setAttribute('data-bs-theme',t==='dark'?'dark':'light');}catch(e){}})();</script>
  <link href="../dist/styles.css" rel="stylesheet">
  <link href="../dist/theme.css" rel="stylesheet">
  <link href="../styles.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition">
  <section class="hero-section py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="hero-content">
            <h1 class="display-4 fw-bold text-primary mb-3">Premium Products for Modern Living</h1>
            <p class="lead mb-4">Discover our curated collection of furniture, electronics, and lifestyle products designed to enhance your everyday experience.</p>
            <div class="d-flex gap-3 flex-wrap">
              <a href="products.php" class="btn btn-primary btn-lg"><i class="bi bi-shop me-2"></i>Shop Now</a>
              <a href="about.php" class="btn btn-outline-primary btn-lg">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
          <img src="https://picsum.photos/600/400?shopping" alt="Shopping Experience" class="img-fluid rounded shadow">
        </div>
      </div>
    </div>
  </section>

  <section class="section-padding">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Featured Products</h2>
        <p class="lead text-muted">Handpicked items from our premium collection</p>
      </div>
      <div class="row g-4" id="featured-products">
        <div class="col-12 text-center">
          <div class="loading-spinner mx-auto" role="status"><span class="visually-hidden">Loading...</span></div>
        </div>
      </div>
      <div class="text-center mt-5">
        <a href="products.php" class="btn btn-outline-primary btn-lg">View All Products<i class="bi bi-arrow-right ms-2"></i></a>
      </div>
    </div>
  </section>

  <section class="hero-section section-padding">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4 text-center">
          <div class="feature-card h-100">
            <div class="feature-icon bg-primary text-white rounded-circle mx-auto mb-3"><i class="bi bi-truck fs-1"></i></div>
            <h4>Free Shipping</h4>
            <p class="text-muted">Free shipping on all orders over $50. Fast and reliable delivery to your doorstep.</p>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="feature-card h-100">
            <div class="value-icon bg-success text-white rounded-circle mx-auto mb-3"><i class="bi bi-shield-check fs-1"></i></div>
            <h4>Quality Guarantee</h4>
            <p class="text-muted">30-day money-back guarantee. We stand behind the quality of our products.</p>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="feature-card h-100">
            <div class="value-icon bg-info text-white rounded-circle mx-auto mb-3"><i class="bi bi-headset fs-1"></i></div>
            <h4>24/7 Support</h4>
            <p class="text-muted">Round-the-clock customer support. We're here to help whenever you need us.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div id="footer-container"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../scripts/app.js"></script>
  <script src="../scripts/login.js"></script>
  <script>if (window.Eshop?.pages?.home) window.Eshop.pages.home();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
