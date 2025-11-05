<?php /** Common scripts placed before </body> */ ?>
<script src="../dist/jquery-3.7.1.min.js"></script>
<script src="../dist/jquery.validate.min.js"></script>
<script src="../scripts/animations.js"></script>
<script src="../scripts/app.js"></script>
<script src="../scripts/login.js"></script>
<script>
  // Initialize Lucide icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // Initialize Hero Animations
  document.addEventListener('DOMContentLoaded', function() {
    // Hero content fade on scroll
    const heroContent = document.getElementById('hero-content');
    if (heroContent) {
      window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const opacity = 1 - (scrolled / 500);
        heroContent.style.opacity = Math.max(0, opacity);
      });
    }

    // Initialize countdown timer
    const countdownEl = document.getElementById('countdown-timer');
    if (countdownEl && window.CountdownTimer) {
      // Set end time to 24 hours from now
      const endTime = new Date().getTime() + (24 * 60 * 60 * 1000);
      new CountdownTimer(countdownEl, endTime);
    }

    // Product card hover effects
    document.querySelectorAll('.product-card').forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px)';
      });
      card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
      });
    });

    // Scroll animations for features
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animated');
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
      observer.observe(el);
    });

    // Re-initialize Lucide icons after dynamic content
    setTimeout(() => {
      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    }, 100);
  });
</script>
