/**
 * Animation Library - Replacing Framer Motion with Vanilla JS + GSAP
 * Provides all the animations and interactions from the original framework
 */

(function() {
  'use strict';

  // Animation Engine
  const AnimEngine = {
    // Intersection Observer for scroll animations
    createObserver(callback, options = {}) {
      const defaultOptions = {
        root: null,
        threshold: 0.1,
        rootMargin: '0px'
      };
      return new IntersectionObserver(callback, { ...defaultOptions, ...options });
    },

    // Fade in animation
    fadeIn(element, delay = 0, duration = 600) {
      element.style.opacity = '0';
      element.style.transform = 'translateY(20px)';
      element.style.transition = `opacity ${duration}ms ease, transform ${duration}ms ease`;
      
      setTimeout(() => {
        console.log('Fading in element after delay:', delay);
        element.style.opacity = '1';
        element.style.transform = 'translateY(0)';
      }, delay);
    },

    // Slide in from left
    slideInLeft(element, delay = 0, duration = 600) {
      element.style.opacity = '0';
      element.style.transform = 'translateX(-20px)';
      element.style.transition = `opacity ${duration}ms ease, transform ${duration}ms ease`;
      
      setTimeout(() => {
        element.style.opacity = '1';
        element.style.transform = 'translateX(0)';
      }, delay);
    },

    // Slide in from right
    slideInRight(element, delay = 0, duration = 800) {
      element.style.opacity = '0';
      element.style.transform = 'translateX(50px)';
      element.style.transition = `opacity ${duration}ms ease, transform ${duration}ms ease`;
      
      setTimeout(() => {
        element.style.opacity = '1';
        element.style.transform = 'translateX(0)';
      }, delay);
    },

    // Scale in animation
    scaleIn(element, delay = 0, duration = 600) {
      element.style.opacity = '0';
      element.style.transform = 'scale(0)';
      element.style.transition = `opacity ${duration}ms ease, transform ${duration}ms ease`;
      
      setTimeout(() => {
        element.style.opacity = '1';
        element.style.transform = 'scale(1)';
      }, delay);
    },

    // Parallax scrolling
    parallax(element, speed = 0.5) {
      window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const rate = scrolled * speed;
        element.style.transform = `translateY(${rate}px)`;
      });
    },

    // Hover lift effect
    hoverLift(element, distance = -8) {
      element.style.transition = 'transform 300ms ease, box-shadow 300ms ease';
      
      element.addEventListener('mouseenter', () => {
        element.style.transform = `translateY(${distance}px)`;
      });
      
      element.addEventListener('mouseleave', () => {
        element.style.transform = 'translateY(0)';
      });
    },

    // Hover scale effect
    hoverScale(element, scale = 1.02) {
      element.style.transition = 'transform 200ms ease';
      
      element.addEventListener('mouseenter', () => {
        element.style.transform = `scale(${scale})`;
      });
      
      element.addEventListener('mouseleave', () => {
        element.style.transform = 'scale(1)';
      });
    },

    // Staggered children animation
    staggerChildren(parentElement, animationType = 'fadeIn', delayIncrement = 100) {
      const children = Array.from(parentElement.children);
      children.forEach((child, index) => {
        this[animationType](child, index * delayIncrement);
      });
    },

    // Continuous pulse animation
    pulse(element) {
      element.style.animation = 'pulse 2s infinite';
    },

    // Bounce animation
    bounce(element, duration = 1500) {
      element.style.animation = `bounce ${duration}ms infinite`;
    },

    // Rotate animation on hover
    rotateOnHover(element, degrees = 1) {
      element.style.transition = 'transform 400ms ease';
      
      element.addEventListener('mouseenter', () => {
        element.style.transform = `rotate(${degrees}deg) scale(1.02)`;
      });
      
      element.addEventListener('mouseleave', () => {
        element.style.transform = 'rotate(0deg) scale(1)';
      });
    }
  };

  // Countdown Timer
  class CountdownTimer {
    constructor(element, endTime) {
      this.element = element;
      this.endTime = endTime || new Date().getTime() + (24 * 60 * 60 * 1000); // 24 hours from now
      this.hoursEl = null;
      this.minutesEl = null;
      this.secondsEl = null;
      this.init();
    }

    init() {
      this.createElements();
      this.start();
    }

    createElements() {
      const container = document.createElement('div');
      container.className = 'flex gap-4';
      
      ['hours', 'minutes', 'seconds'].forEach(unit => {
        const box = document.createElement('div');
        box.className = 'bg-white border border-[#e5e7eb] px-6 py-4 shadow-lg hover:shadow-xl transition-shadow cursor-default';
        box.style.transition = 'transform 200ms ease, box-shadow 300ms ease';
        
        const value = document.createElement('div');
        value.className = 'text-3xl text-[#111827] tabular-nums font-impact';
        value.textContent = '00';
        this[`${unit}El`] = value;
        
        const label = document.createElement('div');
        label.className = 'text-xs text-[#64748b] uppercase mt-1 tracking-wider';
        label.textContent = unit === 'hours' ? 'Hours' : unit === 'minutes' ? 'Mins' : 'Secs';
        
        box.appendChild(value);
        box.appendChild(label);
        container.appendChild(box);
        
        // Hover effect
        box.addEventListener('mouseenter', () => {
          box.style.transform = 'translateY(-4px)';
        });
        box.addEventListener('mouseleave', () => {
          box.style.transform = 'translateY(0)';
        });
      });
      
      this.element.appendChild(container);
    }

    start() {
      this.update();
      this.interval = setInterval(() => this.update(), 1000);
    }

    update() {
      const now = new Date().getTime();
      const distance = this.endTime - now;
      
      if (distance < 0) {
        clearInterval(this.interval);
        this.hoursEl.textContent = '00';
        this.minutesEl.textContent = '00';
        this.secondsEl.textContent = '00';
        return;
      }
      
      const hours = Math.floor(distance / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
      const oldHours = this.hoursEl.textContent;
      const newHours = String(hours).padStart(2, '0');
      if (oldHours !== newHours) {
        this.animateChange(this.hoursEl, newHours);
      }
      
      const oldMinutes = this.minutesEl.textContent;
      const newMinutes = String(minutes).padStart(2, '0');
      if (oldMinutes !== newMinutes) {
        this.animateChange(this.minutesEl, newMinutes);
      }
      
      const oldSeconds = this.secondsEl.textContent;
      const newSeconds = String(seconds).padStart(2, '0');
      if (oldSeconds !== newSeconds) {
        this.animateChange(this.secondsEl, newSeconds);
      }
    }

    animateChange(element, newValue) {
      element.style.transform = 'scale(1.2)';
      element.style.opacity = '0';
      setTimeout(() => {
        element.textContent = newValue;
        element.style.transform = 'scale(1)';
        element.style.opacity = '1';
      }, 150);
    }
  }

  // Scroll Progress Indicator
  class ScrollProgress {
    constructor(element) {
      this.element = element;
      this.init();
    }

    init() {
      window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const height = document.documentElement.scrollHeight - window.innerHeight;
        const progress = (scrolled / height) * 100;
        this.element.style.width = progress + '%';
      });
    }
  }

  // Image Lazy Loading with Fade In
  class LazyImage {
    constructor(img) {
      this.img = img;
      this.init();
    }

    init() {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            this.loadImage();
            observer.unobserve(this.img);
          }
        });
      });
      observer.observe(this.img);
    }

    loadImage() {
      const src = this.img.dataset.src;
      if (src) {
        this.img.style.opacity = '0';
        this.img.style.transition = 'opacity 600ms ease';
        this.img.src = src;
        this.img.onload = () => {
          this.img.style.opacity = '1';
        };
      }
    }
  }

  // Expose to global scope
  window.AnimEngine = AnimEngine;
  window.CountdownTimer = CountdownTimer;
  window.ScrollProgress = ScrollProgress;
  window.LazyImage = LazyImage;

  // Initialize animations function
  function initAnimations() {
    console.log('Initializing animations...');
    
    // Fade in elements with data-animate="fade-in"
    const fadeElements = document.querySelectorAll('[data-animate="fade-in"]');
    console.log('Found fade elements:', fadeElements.length);
    fadeElements.forEach((el, index) => {
      const delay = parseInt(el.dataset.delay) || index * 100;
      AnimEngine.fadeIn(el, delay);
    });

    // Slide in elements
    const slideLeftElements = document.querySelectorAll('[data-animate="slide-left"]');
    slideLeftElements.forEach((el, index) => {
      const delay = parseInt(el.dataset.delay) || index * 100;
      AnimEngine.slideInLeft(el, delay);
    });

    const slideRightElements = document.querySelectorAll('[data-animate="slide-right"]');
    slideRightElements.forEach((el, index) => {
      const delay = parseInt(el.dataset.delay) || index * 100;
      AnimEngine.slideInRight(el, delay);
    });

    // Scale in elements
    const scaleElements = document.querySelectorAll('[data-animate="scale-in"]');
    scaleElements.forEach((el, index) => {
      const delay = parseInt(el.dataset.delay) || index * 100;
      AnimEngine.scaleIn(el, delay);
    });

    // Initialize hover effects
    const hoverLiftElements = document.querySelectorAll('[data-hover="lift"]');
    hoverLiftElements.forEach(el => {
      AnimEngine.hoverLift(el);
    });

    const hoverScaleElements = document.querySelectorAll('[data-hover="scale"]');
    hoverScaleElements.forEach(el => {
      AnimEngine.hoverScale(el);
    });

    // Initialize lazy loading
    const lazyImages = document.querySelectorAll('img[data-src]');
    lazyImages.forEach(img => new LazyImage(img));
  }

  // Auto-initialize scroll animations - run immediately if DOM is ready, otherwise wait
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAnimations);
  } else {
    initAnimations();
  }

})();
