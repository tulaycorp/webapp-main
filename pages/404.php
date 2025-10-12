<?php 
// Set 404 status code
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Page Not Found - E-Shop</title>
  <?php include __DIR__ . '/../includes/head.php'; ?>
</head>
<body>
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <div class="mb-4">
            <i class="bi bi-exclamation-triangle display-1 text-warning"></i>
          </div>
          <h1 class="display-4 fw-bold text-primary mb-3">404</h1>
          <h2 class="h3 mb-4">Page Not Found</h2>
          <p class="lead mb-4 text-muted">
            Sorry, the page you're looking for doesn't exist. It might have been moved, deleted, or you entered the wrong URL.
          </p>
          
          <div class="d-flex gap-3 justify-content-center flex-wrap mb-5">
            <a href="index.php" class="btn btn-primary btn-lg">
              <i class="bi bi-house me-2"></i>Go Home
            </a>
            <a href="products.php" class="btn btn-outline-primary btn-lg">
              <i class="bi bi-shop me-2"></i>Browse Products
            </a>
            <button onclick="history.back()" class="btn btn-outline-secondary btn-lg">
              <i class="bi bi-arrow-left me-2"></i>Go Back
            </button>
          </div>

          <div class="row g-4 mt-4">
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                  <i class="bi bi-search fs-1 text-primary mb-3"></i>
                  <h5 class="card-title">Search</h5>
                  <p class="card-text">Try searching for what you need using our product search.</p>
                  <a href="products.php" class="btn btn-outline-primary btn-sm">Search Products</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                  <i class="bi bi-question-circle fs-1 text-info mb-3"></i>
                  <h5 class="card-title">Need Help?</h5>
                  <p class="card-text">Contact our support team if you need assistance finding something.</p>
                  <a href="contact.php" class="btn btn-outline-info btn-sm">Contact Us</a>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                  <i class="bi bi-info-circle fs-1 text-success mb-3"></i>
                  <h5 class="card-title">Learn More</h5>
                  <p class="card-text">Find out more about our company and what we offer.</p>
                  <a href="about.php" class="btn btn-outline-success btn-sm">About Us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="footer-container"></div>
  </div>

  <?php include __DIR__ . '/../includes/scripts.php'; ?>
  <script>
    // Add some interactive behavior
    document.addEventListener('DOMContentLoaded', function() {
      // Update cart count
      if (window.Eshop && window.Eshop.pages) {
        const cart = JSON.parse(localStorage.getItem('eshop-cart-v1') || '[]');
        const cartCount = document.getElementById('cart-count');
        if (cartCount) {
          cartCount.textContent = cart.reduce((a, i) => a + i.qty, 0);
        }
      }

      // Log 404 for analytics (in a real app, you'd send this to your analytics service)
      console.warn('404 Error:', {
        url: window.location.href,
        referrer: document.referrer,
        timestamp: new Date().toISOString()
      });
    });
  </script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>