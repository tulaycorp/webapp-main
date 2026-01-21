{{-- STICKY FOOTER COMPONENT --}}
<div class="relative h-[70vh]" style="clip-path: polygon(0% 0, 100% 0%, 100% 100%, 0 100%);">
  <div class="relative h-[calc(100vh+70vh)] -top-[100vh]">
    <div class="h-[70vh] sticky top-[calc(100vh-70vh)]">
      <footer class="sticky-footer-content bg-primary py-6 md:py-12 px-4 md:px-12 h-full w-full flex flex-col justify-between relative overflow-hidden transition-colors duration-300">
        
        {{-- Dark gradient at bottom --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent pointer-events-none"></div>

        {{-- Navigation Section --}}
        <div class="relative z-10">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-12 lg:gap-20">
            
            {{-- About Section --}}
            <div class="flex flex-col gap-2" data-footer-animate="fadeInLeft" data-footer-delay="0" style="opacity: 0;">
              <h3 class="mb-2 uppercase text-white/80 text-xs font-semibold tracking-widest border-b border-white/20 pb-1 hover:text-white transition-colors duration-300">
                About
              </h3>
              <a href="{{ route('home') }}" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  Home
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
              <a href="{{ route('about') }}" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  About Us
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
              <a href="{{ route('contact') }}" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  Contact
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
            </div>

            {{-- Shop Section --}}
            <div class="flex flex-col gap-2" data-footer-animate="fadeInLeft" data-footer-delay="100" style="opacity: 0;">
              <h3 class="mb-2 uppercase text-white/80 text-xs font-semibold tracking-widest border-b border-white/20 pb-1 hover:text-white transition-colors duration-300">
                Shop
              </h3>
              <a href="{{ route('products') }}" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  All Products
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
              <a href="{{ route('cart') }}" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  Cart
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
            </div>

            {{-- Legal Section --}}
            <div class="flex flex-col gap-2" data-footer-animate="fadeInLeft" data-footer-delay="200" style="opacity: 0;">
              <h3 class="mb-2 uppercase text-white/80 text-xs font-semibold tracking-widest border-b border-white/20 pb-1 hover:text-white transition-colors duration-300">
                Legal
              </h3>
              <a href="{{ route('privacy-policy') }}" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  Privacy Policy
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
              <a href="{{ route('terms-of-service') }}" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  Terms of Service
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
              <a href="{{ route('shipping-policy') }}" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  Shipping Policy
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
            </div>

            {{-- Social Section --}}
            <div class="flex flex-col gap-2" data-footer-animate="fadeInLeft" data-footer-delay="300" style="opacity: 0;">
              <h3 class="mb-2 uppercase text-white/80 text-xs font-semibold tracking-widest border-b border-white/20 pb-1 hover:text-white transition-colors duration-300">
                Connect
              </h3>
              <a href="#" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  Twitter
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
              <a href="#" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  GitHub
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
              <a href="#" class="footer-link text-white/70 hover:text-white transition-all duration-300 font-sans text-xs md:text-sm relative inline-block">
                <span class="relative">
                  LinkedIn
                  <span class="footer-link-underline absolute bottom-0 left-0 h-0.5 bg-white w-0 transition-all duration-300"></span>
                </span>
              </a>
            </div>

          </div>
        </div>

        {{-- Footer Bottom Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end relative z-10 gap-4 md:gap-6 mt-6">
          <div class="flex-1" data-footer-animate="fadeInUp" data-footer-delay="800" style="opacity: 0;">
            <h1 class="text-[12vw] md:text-[10vw] lg:text-[8vw] xl:text-[6vw] leading-[0.8] font-impact text-white cursor-default tracking-[-0.05em]">
              FRAMEWORK
            </h1>
          </div>

          <div class="text-left md:text-right" data-footer-animate="fadeInUp" data-footer-delay="1000" style="opacity: 0;">
            <p class="text-white/70 text-xs md:text-sm hover:text-white transition-colors duration-300">
              &copy; {{ date('Y') }} FRAMEWORK Supply Co. All rights reserved.
            </p>
          </div>
        </div>

      </footer>
    </div>
  </div>
</div>
