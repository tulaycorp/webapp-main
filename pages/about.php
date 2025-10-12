<?php /* About page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Framework - About</title>
  <script>(function(){try{var t=localStorage.getItem('eshop-theme')||(window.matchMedia('(prefers-color-scheme: dark)').matches?'dark':'light');document.documentElement.setAttribute('data-theme',t);document.documentElement.setAttribute('data-bs-theme',t==='dark'?'dark':'light');}catch(e){}})();</script>
  <link href="../dist/styles.css" rel="stylesheet" />
  <link href="../dist/theme.css" rel="stylesheet" />
  <link href="../styles.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body>
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition">
  <header class="header-plain py-5 mb-4">
    <div class="container">
      <h1 class="display-6 fw-semibold mb-2">About Framework</h1>
      <p class="lead mb-0 text-muted">A demo storefront showcasing UI patterns with a clean, card-first theme.</p>
    </div>
  </header>

  <main class="container pb-5">
    <div class="row g-5">
      <div class="col-lg-7">
        <div class="surface-card">
          <h2 class="h4">Our Mission</h2>
          <p>We built Framework as a lightweight demonstration of a modern e‑commerce front-end using only static HTML pages styled through a single compiled stylesheet. The goal is to highlight component layout, responsive behavior, and a sprinkle of progressive enhancement via a tiny JavaScript module.</p>
          <h2 class="h4 mt-4">Tech Stack</h2>
          <ul class="list-group mb-3">
            <li class="list-group-item">Bootstrap utility-inspired classes (provided in dist/styles.css)</li>
            <li class="list-group-item">Vanilla JavaScript for catalog, cart, and filtering logic</li>
            <li class="list-group-item">Graceful degradation: content remains readable without JS</li>
          </ul>
          <h2 class="h4 mt-4">Features Demonstrated</h2>
          <ul>
            <li>Responsive navbar with collapse behavior</li>
            <li>Dynamic product listing & filtering</li>
            <li>Client-side cart persisted in localStorage</li>
            <li>Reusable layout elements + shared stylesheet</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="h5">Quick Stats</h3>
            <ul class="list-unstyled small mb-0">
              <li><strong id="stat-products">0</strong> Products</li>
              <li><strong id="stat-categories">0</strong> Categories</li>
              <li><strong id="stat-cart-items">0</strong> Items in Cart</li>
            </ul>
          </div>
        </div>
        <div class="mt-4">
          <h3 class="h6 text-uppercase text-muted">Design Notes</h3>
          <p class="small">This project intentionally avoids a build framework for the HTML to keep the focus on layout. In a production app we'd hydrate components server-side or use a framework.</p>
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
  <script>window.Eshop && window.Eshop.pages.about();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
