<?php /* Products page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Shop - Products</title>
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
  <header class="hero-section py-4 mb-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col">
          <h1 class="display-6 fw-bold text-primary mb-2">Our Products</h1>
          <p class="lead mb-0">Discover our curated collection of premium items</p>
        </div>
        <div class="col-auto">
          <span class="badge bg-primary fs-6" id="product-count">Loading...</span>
        </div>
      </div>
    </div>
  </header>

  <main class="container pb-5">
    <div class="surface-card mb-4">
      <div class="row g-3 align-items-end">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Search</label>
          <input type="text" id="search" class="form-control" placeholder="Search products..." />
        </div>
        <div class="col-md-3">
          <label class="form-label fw-semibold">Category</label>
          <select id="filter-category" class="form-select">
            <option value="">All</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label fw-semibold">Sort By</label>
          <select id="sort" class="form-select">
            <option value="featured">Featured</option>
            <option value="price-asc">Price: Low to High</option>
            <option value="price-desc">Price: High to Low</option>
            <option value="alpha">Alphabetical</option>
          </select>
        </div>
        <div class="col-md-2 d-grid">
          <button id="reset" class="btn btn-outline-secondary mt-3 mt-md-0">Reset</button>
        </div>
      </div>
    </div>

    <div id="product-grid" class="row g-4"></div>
    <div class="text-center mt-4 d-none" id="no-results">
      <p class="text-muted">No products match your search.</p>
    </div>
  </main>

  <div id="footer-container"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="../scripts/app.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../scripts/login.js"></script>
  <script>window.Eshop && window.Eshop.pages.products();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
