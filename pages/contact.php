<?php /* Contact page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>E-Shop - Contact</title>
  <?php include __DIR__ . '/../includes/head.php'; ?>
</head>
<body>
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition">
  <header class="header-plain py-5 mb-4">
    <div class="container">
      <h1 class="display-6 fw-semibold mb-2">Contact Us</h1>
      <p class="lead mb-0 text-muted">We'd love to hear from you.</p>
    </div>
  </header>

  <main class="container pb-5">
    <div class="row g-5">
      <div class="col-lg-7">
        <form id="contact-form" class="needs-validation surface-card" novalidate>
          <div class="mb-3">
            <label class="form-label fw-semibold" for="first-name">Name</label>
            <div class="row g-3">
              <div class="col-12 col-md-4">
                <input required type="text" class="form-control" id="first-name" name="firstName" placeholder="First name" />
                <div class="invalid-feedback">Please enter your first name.</div>
              </div>
              <div class="col-12 col-md-4">
                <input type="text" class="form-control" id="middle-name" name="middleName" placeholder="Middle name (optional)" />
              </div>
              <div class="col-12 col-md-4">
                <input required type="text" class="form-control" id="last-name" name="lastName" placeholder="Last name" />
                <div class="invalid-feedback">Please enter your last name.</div>
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold" for="email">Email</label>
            <input required type="email" class="form-control" id="email" name="email" placeholder="you@example.com" />
            <div class="invalid-feedback">Enter a valid email.</div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold" for="topic">Topic</label>
            <select id="topic" name="topic" class="form-select" required>
              <option value="" selected disabled>Select a topic</option>
              <option>General Inquiry</option>
              <option>Order Support</option>
              <option>Partnership</option>
              <option>Other</option>
            </select>
            <div class="invalid-feedback">Please choose a topic.</div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold" for="message">Message</label>
            <textarea required id="message" name="message" rows="5" class="form-control" placeholder="How can we help?"></textarea>
            <div class="invalid-feedback">Message cannot be empty.</div>
          </div>
          <button class="btn btn-primary" type="submit">Send Message</button>
          <div id="contact-success" class="alert alert-success mt-3 d-none">Thank you! We'll respond shortly.</div>
        </form>
      </div>
      <div class="col-lg-5">
        <div class="card shadow-sm mb-4 surface-card">
          <div class="card-body">
            <h2 class="h5">Support</h2>
            <p class="small mb-2">We respond to most inquiries within one business day.</p>
            <ul class="list-unstyled small mb-0">
              <li><strong>Email:</strong> support@eshop.test</li>
              <li><strong>Phone:</strong> (555) 123‑4567</li>
              <li><strong>Hours:</strong> Mon–Fri 9am–5pm</li>
            </ul>
          </div>
        </div>
        <div class="ratio ratio-16x9 rounded overflow-hidden shadow-sm">
          <iframe src="https://maps.google.com/maps?q=New%20York&t=&z=11&ie=UTF8&iwloc=&output=embed" loading="lazy" title="Map"></iframe>
        </div>
      </div>
    </div>
  </main>

  <div id="footer-container"></div>
  </div>

  <?php include __DIR__ . '/../includes/scripts.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js"></script>
  <script src="../scripts/contact-validation.js"></script>
  <script>window.Eshop && window.Eshop.pages.contact();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
