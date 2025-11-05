<?php 
// Set 404 status code
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Page Not Found - FRAMEWORK Supply Co.</title>
  <?php include __DIR__ . '/../includes/head.php'; ?>
</head>
<body class="bg-background min-h-screen">
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition pt-32">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
      <div class="max-w-4xl mx-auto text-center">
        <div class="mb-8">
          <i data-lucide="alert-triangle" class="w-24 h-24 text-primary mx-auto"></i>
        </div>
        <h1 class="text-9xl font-impact text-primary mb-4">404</h1>
        <h2 class="heading-md mb-6">Page Not Found</h2>
        <p class="text-secondary text-lg mb-12 max-w-2xl mx-auto">
          Sorry, the page you're looking for doesn't exist. It might have been moved, deleted, or you entered the wrong URL.
        </p>
        
        <div class="flex gap-4 justify-center flex-wrap mb-16">
          <a href="index.php" class="btn-primary inline-flex items-center gap-2">
            <i data-lucide="home" class="w-5 h-5"></i>
            <span>Go Home</span>
          </a>
          <a href="products.php" class="btn-secondary inline-flex items-center gap-2">
            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
            <span>Browse Products</span>
          </a>
          <button onclick="history.back()" class="btn-secondary inline-flex items-center gap-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
            <span>Go Back</span>
          </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="modern-card p-8 text-center">
            <i data-lucide="search" class="w-12 h-12 text-primary mx-auto mb-4"></i>
            <h5 class="text-xl uppercase tracking-tight text-primary font-semibold mb-3">Search</h5>
            <p class="text-secondary text-sm mb-4">Try searching for what you need using our product search.</p>
            <a href="products.php" class="btn-secondary text-sm">Search Products</a>
          </div>
          <div class="modern-card p-8 text-center">
            <i data-lucide="help-circle" class="w-12 h-12 text-primary mx-auto mb-4"></i>
            <h5 class="text-xl uppercase tracking-tight text-primary font-semibold mb-3">Need Help?</h5>
            <p class="text-secondary text-sm mb-4">Contact our support team if you need assistance.</p>
            <a href="contact.php" class="btn-secondary text-sm">Contact Us</a>
          </div>
          <div class="modern-card p-8 text-center">
            <i data-lucide="info" class="w-12 h-12 text-primary mx-auto mb-4"></i>
            <h5 class="text-xl uppercase tracking-tight text-primary font-semibold mb-3">Learn More</h5>
            <p class="text-secondary text-sm mb-4">Find out more about our company and what we offer.</p>
            <a href="about.php" class="btn-secondary text-sm">About Us</a>
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