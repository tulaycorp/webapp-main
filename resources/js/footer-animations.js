/**
 * Sticky Footer Animations
 * Handles scroll-triggered animations for the footer component
 */

class FooterAnimations {
    constructor() {
        this.footer = document.querySelector('.sticky-footer-content');
        this.animatedElements = [];
        this.hasAnimated = false;
        this.init();
    }

    init() {
        if (!this.footer) return;

        // Collect all elements that should animate
        this.animatedElements = [
            ...this.footer.querySelectorAll('[data-footer-animate]')
        ];

        // Set up intersection observer for scroll-triggered animations
        this.setupObserver();

        // Add hover effects to links
        this.setupLinkHoverEffects();

        // Add hover effects to social icons
        this.setupSocialHoverEffects();
    }

    setupObserver() {
        const options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !this.hasAnimated) {
                    this.animateElements();
                    this.hasAnimated = true;
                }
            });
        }, options);

        if (this.footer) {
            observer.observe(this.footer);
        }
    }

    animateElements() {
        this.animatedElements.forEach((element, index) => {
            const delay = parseInt(element.getAttribute('data-footer-delay')) || index * 100;
            const animation = element.getAttribute('data-footer-animate') || 'fadeInUp';

            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'none';
                
                switch(animation) {
                    case 'fadeInLeft':
                        element.classList.add('footer-animate-left');
                        break;
                    case 'fadeInUp':
                    default:
                        element.classList.add('footer-animate-in');
                        break;
                }
            }, delay);
        });
    }

    setupLinkHoverEffects() {
        const links = this.footer?.querySelectorAll('.footer-link');
        
        links?.forEach(link => {
            const underline = link.querySelector('.footer-link-underline');
            
            link.addEventListener('mouseenter', () => {
                if (underline) {
                    underline.style.width = '100%';
                }
                link.style.transform = 'translateX(8px)';
            });

            link.addEventListener('mouseleave', () => {
                if (underline) {
                    underline.style.width = '0%';
                }
                link.style.transform = 'translateX(0)';
            });
        });
    }

    setupSocialHoverEffects() {
        const socials = this.footer?.querySelectorAll('.footer-social-icon');
        
        socials?.forEach(social => {
            social.addEventListener('mouseenter', () => {
                social.style.transform = 'scale(1.2) rotate(12deg)';
            });

            social.addEventListener('mouseleave', () => {
                social.style.transform = 'scale(1) rotate(0deg)';
            });

            social.addEventListener('mousedown', () => {
                social.style.transform = 'scale(0.9) rotate(0deg)';
            });

            social.addEventListener('mouseup', () => {
                social.style.transform = 'scale(1.2) rotate(12deg)';
            });
        });
    }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        new FooterAnimations();
    });
} else {
    new FooterAnimations();
}

// Re-initialize on page transitions (for SPA-like behavior)
window.addEventListener('page-loaded', () => {
    new FooterAnimations();
});
