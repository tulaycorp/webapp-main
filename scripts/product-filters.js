/**
 * Product Filter Tags - Matching Framework Design
 */

(function() {
  'use strict';

  // Initialize filter tags
  document.addEventListener('DOMContentLoaded', function() {
    const filterTags = document.querySelectorAll('.filter-tag');
    
    filterTags.forEach(tag => {
      tag.addEventListener('click', function() {
        // Remove active class from all tags
        filterTags.forEach(t => {
          t.classList.remove('active', 'bg-primary', 'text-white');
          t.classList.add('bg-white', 'text-primary', 'border', 'border-border');
        });
        
        // Add active class to clicked tag
        this.classList.add('active', 'bg-primary', 'text-white');
        this.classList.remove('bg-white', 'text-primary', 'border', 'border-border');
        
        // Get filter value
        const filterValue = this.dataset.filter;
        
        // Trigger filtering (this will be handled by app.js)
        if (window.Eshop && window.Eshop.filterProducts) {
          window.Eshop.filterProducts(filterValue);
        }
      });
    });
  });

})();
