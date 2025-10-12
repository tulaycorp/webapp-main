/**
 * Theme Initialization Script
 * Handles theme detection and initialization before page load to prevent flash
 * Must be executed immediately to avoid FOUC (Flash of Unstyled Content)
 */
(function() {
  try {
    var theme = localStorage.getItem('eshop-theme') || 
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    document.documentElement.setAttribute('data-theme', theme);
    document.documentElement.setAttribute('data-bs-theme', theme === 'dark' ? 'dark' : 'light');
  } catch(e) {
    // Fallback to light theme if there's any error
    console.warn('Theme initialization failed:', e);
  }
})();