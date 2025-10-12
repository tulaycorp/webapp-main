<?php /* NAVBAR COMPONENT (PHP include) */ ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow no-theme-effect">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/webapp-main/pages/bootstrap.php">
      <i class="bi bi-shop me-2"></i>Framework
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/webapp-main/pages/bootstrap.php" data-page="home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/webapp-main/pages/products.php" data-page="products">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="/webapp-main/pages/about.php" data-page="about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/webapp-main/pages/contact.php" data-page="contact">Contact</a></li>
        <li class="nav-item">
          <a class="nav-link position-relative" href="/webapp-main/pages/cart.php" data-page="cart">
            <i class="bi bi-cart3"></i>
            Cart
            <span class="badge bg-warning text-dark ms-1" id="cart-count">0</span>
          </a>
        </li>
        <li class="nav-item ms-lg-2"><a class="nav-link" id="nav-login-btn" href="#" role="button">Login</a></li>
        <li class="nav-item ms-lg-2">
          <a id="theme-toggle" class="nav-link" href="#" aria-pressed="false" aria-label="Toggle theme">
            <span id="theme-emoji" aria-hidden="true">🌙</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
