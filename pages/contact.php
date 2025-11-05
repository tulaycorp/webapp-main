<?php /* Contact page (PHP) */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FRAMEWORK Supply Co. - Contact</title>
  <?php include __DIR__ . '/../includes/head.php'; ?>
</head>
<body class="bg-background min-h-screen">
  <?php include __DIR__ . '/../components/navbar.php'; ?>
  <?php include __DIR__ . '/../components/modal-template.php'; ?>

  <div id="page-content" class="page-transition pt-32">
  <!-- Contact Hero -->
  <section class="py-32 px-6 lg:px-8 bg-white min-h-[60vh] flex items-center">
    <div class="max-w-5xl mx-auto text-center w-full">
      <!-- Icon -->
      <div data-animate="scale-in" data-delay="0"
           class="inline-flex items-center justify-center w-32 h-32 border-2 border-primary text-primary shadow-2xl mb-12 transition-all hover:bg-primary hover:text-white">
        <i data-lucide="mail" class="w-16 h-16"></i>
      </div>

      <!-- Heading -->
      <h1 data-animate="fade-in" data-delay="200"
          class="text-7xl lg:text-9xl text-primary uppercase tracking-tighter font-impact mb-12 leading-[0.85]">
        Get In<br/>Touch
      </h1>
      
      <p data-animate="fade-in" data-delay="400"
         class="text-2xl lg:text-3xl text-secondary max-w-3xl mx-auto leading-relaxed mb-8">
        Have a question or want to work together? Drop us a message and we'll get back to you within 24 hours.
      </p>
      
      <p data-animate="fade-in" data-delay="600"
         class="text-lg text-secondary uppercase tracking-[0.3em]">
        We're here to help
      </p>
    </div>
  </section>
  
  <!-- Contact Form Section -->
  <section class="py-32 px-6 lg:px-8 bg-background">

    <div class="max-w-7xl mx-auto">
      <div class="mb-20">
        <h2 data-animate="fade-in" data-delay="0"
            class="text-5xl lg:text-7xl text-primary uppercase tracking-tighter font-impact mb-6">
          Send Us a<br/>Message
        </h2>
        <p data-animate="fade-in" data-delay="200"
           class="text-xl text-secondary max-w-2xl">
          Fill out the form below and our team will get back to you as soon as possible.
        </p>
      </div>
      
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
        <!-- Form -->
        <div class="lg:col-span-2" data-animate="slide-right" data-delay="300">
          <form id="contact-form" class="space-y-10" novalidate>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div>
                <label class="text-base uppercase tracking-[0.2em] text-primary font-semibold mb-4 block">FIRST NAME</label>
                <input required type="text" class="form-input text-lg py-4" id="first-name" name="firstName" placeholder="John" />
                <div class="text-red-500 text-sm mt-2 hidden">Required field</div>
              </div>
              <div>
                <label class="text-base uppercase tracking-[0.2em] text-primary font-semibold mb-4 block">LAST NAME</label>
                <input required type="text" class="form-input text-lg py-4" id="last-name" name="lastName" placeholder="Doe" />
                <div class="text-red-500 text-sm mt-2 hidden">Required field</div>
              </div>
            </div>
            
            <div>
              <label class="text-base uppercase tracking-[0.2em] text-primary font-semibold mb-4 block" for="email">EMAIL ADDRESS</label>
              <input required type="email" class="form-input text-lg py-4" id="email" name="email" placeholder="john.doe@example.com" />
              <div class="text-red-500 text-sm mt-2 hidden">Enter a valid email</div>
            </div>
            
            <div>
              <label class="text-base uppercase tracking-[0.2em] text-primary font-semibold mb-4 block" for="topic">TOPIC</label>
              <select id="topic" name="topic" class="form-input text-lg py-4" required>
                <option value="" selected disabled>Select a topic</option>
                <option>General Inquiry</option>
                <option>Order Support</option>
                <option>Partnership Opportunities</option>
                <option>Press & Media</option>
                <option>Wholesale</option>
                <option>Other</option>
              </select>
              <div class="text-red-500 text-sm mt-2 hidden">Please choose a topic</div>
            </div>
            
            <div>
              <label class="text-base uppercase tracking-[0.2em] text-primary font-semibold mb-4 block" for="message">YOUR MESSAGE</label>
              <textarea required id="message" name="message" rows="8" class="form-input text-lg py-4" placeholder="Tell us about your project or inquiry..."></textarea>
              <div class="text-red-500 text-sm mt-2 hidden">Message required</div>
            </div>
            
            <button data-hover="scale" class="btn-primary w-full md:w-auto px-16 py-5 text-lg" type="submit">
              Send Message
            </button>
            <div id="contact-success" class="bg-green-500/10 border-l-4 border-green-500 p-6 mt-8 hidden">
              <p class="text-green-600 uppercase text-base tracking-wider">✓ Message sent successfully! We'll respond within 24 hours.</p>
            </div>
          </form>
        </div>
        
        <!-- Contact Info -->
        <div class="space-y-8" data-animate="slide-left" data-delay="300">
          <!-- Support Card -->
          <div class="modern-card p-10">
            <h3 class="text-3xl uppercase tracking-tight text-primary font-impact mb-8">Contact Info</h3>
            <p class="text-secondary text-lg mb-10 leading-relaxed">Reach out to us through any of these channels. We're here to help!</p>
            <ul class="space-y-8">
              <li class="flex items-start gap-5 group cursor-pointer">
                <div class="w-16 h-16 border-2 border-primary text-primary flex items-center justify-center flex-shrink-0 group-hover:bg-primary transition-all shadow-md">
                  <i data-lucide="mail" class="w-8 h-8 group-hover:text-white transition-colors"></i>
                </div>
                <div>
                  <p class="text-sm text-secondary uppercase tracking-wider mb-2">Email</p>
                  <p class="text-primary text-lg font-medium">support@framework.co</p>
                </div>
              </li>
              <li class="flex items-start gap-5 group cursor-pointer">
                <div class="w-16 h-16 border-2 border-primary text-primary flex items-center justify-center flex-shrink-0 group-hover:bg-primary transition-all shadow-md">
                  <i data-lucide="phone" class="w-8 h-8 group-hover:text-white transition-colors"></i>
                </div>
                <div>
                  <p class="text-sm text-secondary uppercase tracking-wider mb-2">Phone</p>
                  <p class="text-primary text-lg font-medium">(555) 123-4567</p>
                </div>
              </li>
              <li class="flex items-start gap-5 group cursor-pointer">
                <div class="w-16 h-16 border-2 border-primary text-primary flex items-center justify-center flex-shrink-0 group-hover:bg-primary transition-all shadow-md">
                  <i data-lucide="map-pin" class="w-8 h-8 group-hover:text-white transition-colors"></i>
                </div>
                <div>
                  <p class="text-sm text-secondary uppercase tracking-wider mb-2">Address</p>
                  <p class="text-primary text-lg font-medium">123 Street Ave<br/>New York, NY 10001</p>
                </div>
              </li>
              <li class="flex items-start gap-5 group cursor-pointer">
                <div class="w-16 h-16 border-2 border-primary text-primary flex items-center justify-center flex-shrink-0 group-hover:bg-primary transition-all shadow-md">
                  <i data-lucide="clock" class="w-8 h-8 group-hover:text-white transition-colors"></i>
                </div>
                <div>
                  <p class="text-sm text-secondary uppercase tracking-wider mb-2">Business Hours</p>
                  <p class="text-primary text-lg font-medium">Monday – Friday<br/>9:00 AM – 5:00 PM EST</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- FAQ Section -->
  <section class="py-32 px-6 lg:px-8 bg-white">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-20">
        <h2 data-animate="fade-in" data-delay="0"
            class="text-5xl lg:text-7xl text-primary uppercase tracking-tighter font-impact mb-6">
          Quick<br/>Answers
        </h2>
        <p data-animate="fade-in" data-delay="200"
           class="text-xl text-secondary">
          Frequently asked questions
        </p>
      </div>
      
      <div class="space-y-6">
        <div class="modern-card p-8" data-animate="fade-in" data-delay="0">
          <h4 class="text-2xl text-primary font-impact mb-4">HOW LONG DOES SHIPPING TAKE?</h4>
          <p class="text-secondary text-lg leading-relaxed">Standard shipping takes 3-5 business days within the US. International shipping varies by location, typically 7-14 business days.</p>
        </div>
        <div class="modern-card p-8" data-animate="fade-in" data-delay="100">
          <h4 class="text-2xl text-primary font-impact mb-4">WHAT IS YOUR RETURN POLICY?</h4>
          <p class="text-secondary text-lg leading-relaxed">We offer a 30-day money-back guarantee on all products. Items must be unworn, unwashed, and in original condition with tags attached.</p>
        </div>
        <div class="modern-card p-8" data-animate="fade-in" data-delay="200">
          <h4 class="text-2xl text-primary font-impact mb-4">DO YOU OFFER WHOLESALE PRICING?</h4>
          <p class="text-secondary text-lg leading-relaxed">Yes! We work with select retailers and boutiques. Contact us at wholesale@framework.co for more information about bulk orders.</p>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Newsletter CTA -->
  <section class="py-32 px-6 lg:px-8 bg-primary">
    <div class="max-w-4xl mx-auto text-center">
      <h3 data-animate="fade-in" data-delay="0"
          class="text-5xl lg:text-7xl text-white uppercase tracking-tighter font-impact mb-8">
        Stay Connected
      </h3>
      <p data-animate="fade-in" data-delay="200"
         class="text-xl text-white/80 mb-12">
        Get the latest updates, exclusive offers, and street culture news
      </p>
      <div data-animate="fade-in" data-delay="400"
           class="flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto">
        <input type="email" placeholder="ENTER YOUR EMAIL" 
               class="flex-1 px-6 py-5 text-lg bg-white/10 border-2 border-white/20 text-white placeholder:text-white/40 focus:border-white/60 transition-all" />
        <button class="bg-white text-primary px-12 py-5 text-lg uppercase tracking-wider font-medium hover:bg-white/90 transition-all shadow-xl hover:shadow-2xl">
          Subscribe
        </button>
      </div>
    </div>

  <div id="footer-container"></div>
  </div>

  <?php include __DIR__ . '/../includes/scripts.php'; ?>
  <script src="../dist/jquery.validate.min.js"></script>
  <script src="../scripts/contact-validation.js"></script>
  <script>window.Eshop && window.Eshop.pages.contact();</script>
  <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>
