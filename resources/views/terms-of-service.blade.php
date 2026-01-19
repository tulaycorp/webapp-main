@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - Terms of Service')

@section('meta')
<meta name="description" content="Terms of Service for FRAMEWORK Supply Co. - Review our terms and conditions for using our services and purchasing our products.">
@endsection

@section('content')
<div class="pt-32">
  {{-- Terms of Service Hero Section --}}
  <section class="py-16 px-6 lg:px-8 bg-white dark:bg-gray-800 relative overflow-hidden transition-colors duration-300">
    {{-- Decorative Element --}}
    <div class="absolute top-1/4 right-0 w-64 h-64 bg-background dark:bg-gray-700 rounded-full filter blur-3xl opacity-50"></div>

    <div class="max-w-7xl mx-auto relative">
      {{-- Header --}}
      <div data-animate="fade-in" data-delay="0" class="text-center mb-12">
        {{-- Badge --}}
        <div class="inline-block bg-background dark:bg-gray-700 border border-border dark:border-gray-600 px-4 py-2 mb-6">
          <span class="text-sm text-primary dark:text-white uppercase tracking-wider">Legal</span>
        </div>

        {{-- Heading --}}
        <h1 class="text-5xl lg:text-7xl text-primary dark:text-white uppercase tracking-tighter leading-[0.9] font-impact mb-4">
          Terms of<br/>
          <span class="block dark:text-stroke-white" 
                style="-webkit-text-stroke: 1px currentColor; -webkit-text-fill-color: transparent;">
            Service
          </span>
        </h1>

        <p class="text-secondary dark:text-gray-400 text-lg">
          Last Updated: January 19, 2026 | Version 3.0
        </p>
      </div>

      {{-- Quick Navigation --}}
      <div data-animate="fade-in" data-delay="200" class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 mb-12 text-center">
        <h3 class="text-primary dark:text-white uppercase tracking-wider mb-4 font-semibold flex items-center justify-center gap-2">
          <i data-lucide="list" class="w-5 h-5"></i>
          Quick Navigation
        </h3>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 text-sm max-w-5xl mx-auto">
          <a href="#agreement" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">1. Agreement to Terms</a>
          <a href="#eligibility" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">2. Eligibility & Account</a>
          <a href="#products" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">3. Products & Pricing</a>
          <a href="#shipping" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">4. Shipping & Delivery</a>
          <a href="#returns" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">5. Returns & Refunds</a>
          <a href="#intellectual" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">6. Intellectual Property</a>
          <a href="#conduct" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">7. User Conduct</a>
          <a href="#support" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">8. Customer Support</a>
          <a href="#disclaimers" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">9. Disclaimers & Liability</a>
          <a href="#indemnification" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">10. Indemnification</a>
          <a href="#disputes" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">11. Dispute Resolution</a>
          <a href="#governing" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">12. Governing Law</a>
          <a href="#force" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">13. Force Majeure</a>
          <a href="#general" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">14. General Provisions</a>
          <a href="#contact" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">15. Contact Information</a>
          <a href="#california" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 pl-16">16. California Disclosures</a>
        </div>
      </div>

      {{-- Terms of Service Content --}}
      <div data-animate="fade-in" data-delay="300" class="tos-content bg-white dark:bg-gray-800 border border-border dark:border-gray-700 p-8 lg:p-16">
        
        {{-- Section 1 --}}
        <section id="agreement" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">1</span>
            Agreement to Terms & Binding Contract
          </h2>
          
          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">1.1 Acceptance of Terms</h3>
          <div class="prose-content">
            <p>Welcome to <strong>FRAMEWORK SUPPLY CO.</strong> ("FRAMEWORK," "Company," "we," "us," or "our"). These Terms of Service ("Terms," "Agreement," or "TOS") constitute a legally binding agreement between you ("User," "Customer," "you," or "your") and FRAMEWORK SUPPLY CO. governing your access to and use of our website, mobile applications, services, products, and any related platforms (collectively, the "Services").</p>
            <p class="font-bold text-primary dark:text-white">BY ACCESSING, BROWSING, OR USING OUR SERVICES, YOU ACKNOWLEDGE THAT YOU HAVE READ, UNDERSTOOD, AND AGREE TO BE BOUND BY THESE TERMS AND ALL APPLICABLE LAWS AND REGULATIONS.</p>
            <p>If you do not agree to these Terms in their entirety, you must immediately cease all use of our Services and refrain from making any purchases.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">1.2 Modifications to Terms</h3>
          <div class="prose-content">
            <p>FRAMEWORK SUPPLY CO. reserves the unilateral right to modify, amend, update, or replace any provision of these Terms at any time without prior notice. Modifications become effective immediately upon posting to our website. Your continued use of the Services following any changes constitutes acceptance of those changes.</p>
            <p>Material changes will be communicated via:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Prominent website banner notifications</li>
              <li>Email notifications to registered account holders</li>
              <li>In-app notifications for mobile users</li>
              <li>Dashboard alerts upon login</li>
              <li>Social media announcements for significant policy changes</li>
            </ul>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">1.3 Supplementary Agreements</h3>
          <div class="prose-content">
            <p>These Terms incorporate by reference and are supplemented by:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Privacy Policy</li>
              <li>Return & Refund Policy</li>
              <li>Shipping & Delivery Policy</li>
              <li>Community Guidelines</li>
              <li>Intellectual Property Policy</li>
              <li>Acceptable Use Policy</li>
              <li>Cookie Policy</li>
            </ul>
          </div>
        </section>

        {{-- Section 2 --}}
        <section id="eligibility" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">2</span>
            Eligibility & Account Registration
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">2.1 Age Requirements</h3>
          <div class="prose-content">
            <p><strong>MINIMUM AGE:</strong> You must be at least <strong>18 years of age</strong> or the age of majority in your jurisdiction to create an account or make purchases. Users between 13-17 years may use our Services only with verifiable parental or guardian consent and supervision.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">2.2 Account Creation & Security</h3>
          <div class="prose-content">
            <p>To access certain features, you must create an account by providing:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Full legal name</li>
              <li>Valid email address</li>
              <li>Secure password meeting our security requirements</li>
              <li>Phone number (for order verification and support)</li>
              <li>Date of birth (for age verification)</li>
              <li>Billing and shipping addresses</li>
            </ul>
            <p class="mt-4"><strong>Account Security Obligations:</strong></p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>You are solely responsible for maintaining the confidentiality of your account credentials</li>
              <li>You must notify us immediately of any unauthorized access or security breach</li>
              <li>You are liable for all activities occurring under your account</li>
              <li>Sharing account credentials is strictly prohibited</li>
              <li>Multi-factor authentication (MFA) is strongly recommended</li>
            </ul>
          </div>
        </section>

        {{-- Section 3 --}}
        <section id="products" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">3</span>
            Products, Pricing & Availability
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">3.1 Limited Edition Exclusivity</h3>
          <div class="prose-content">
            <p>FRAMEWORK SUPPLY CO. specializes in <strong>limited-edition streetwear designs</strong> with production strictly capped at <strong>500 units per design</strong> to ensure exclusivity and maintain brand integrity. Once inventory is depleted, designs are permanently retired and will not be reproduced.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">3.2 Pricing & Payment</h3>
          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Pricing Policy</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• All prices in USD</li>
                <li>• Subject to change without notice</li>
                <li>• Pricing errors don't constitute binding offers</li>
                <li>• Dynamic pricing based on demand</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Payment Methods</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Major credit/debit cards</li>
                <li>• PayPal, Apple Pay, Google Pay</li>
                <li>• Shop Pay, Affirm</li>
                <li>• Cryptocurrency (where permitted)</li>
              </ul>
            </div>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">3.3 Free Shipping Program</h3>
          <div class="prose-content">
            <p>Orders exceeding <strong>$150 USD</strong> (before taxes) qualify for free standard shipping to eligible destinations within the continental United Kingdom. Standard shipping timeframe: 5-7 business days. Excludes Alaska, Hawaii, U.S. territories, and international destinations.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">3.4 Purchase Quantity Limitations</h3>
          <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 p-6 mt-6">
            <p class="text-yellow-800 dark:text-yellow-200 text-sm">
              <strong>Important:</strong> To ensure fair distribution of limited-edition products:
            </p>
            <ul class="text-yellow-800 dark:text-yellow-200 text-sm mt-2 list-disc pl-6 space-y-1">
              <li>Maximum 2 units per design per customer</li>
              <li>Maximum 5 total items per order</li>
              <li>One order per customer per 24-hour period during exclusive releases</li>
            </ul>
          </div>
        </section>

        {{-- Section 4 --}}
        <section id="shipping" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">4</span>
            Shipping, Delivery & Risk of Loss
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">4.1 Shipping Locations</h3>
          <div class="prose-content">
            <p>We currently ship to: All 50 United Kingdom, Canada, EU member states, United Kingdom, Australia, Japan, and select additional countries.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">4.2 Processing & Delivery Timeframes</h3>
          <div class="overflow-x-auto mt-6">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b-2 border-primary dark:border-white">
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Service Level</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Timeframe</th>
                </tr>
              </thead>
              <tbody class="text-secondary dark:text-gray-400">
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Standard Processing</td>
                  <td class="py-3">1-3 business days</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Standard Domestic</td>
                  <td class="py-3">5-7 business days</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Expedited Domestic</td>
                  <td class="py-3">2-3 business days</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Overnight Domestic</td>
                  <td class="py-3">1 business day</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">International Standard</td>
                  <td class="py-3">10-21 business days</td>
                </tr>
                <tr>
                  <td class="py-3 font-medium text-primary dark:text-white">International Express</td>
                  <td class="py-3">5-10 business days</td>
                </tr>
              </tbody>
            </table>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">4.3 Risk of Loss</h3>
          <div class="prose-content">
            <p>Title and risk of loss pass to you upon delivery to the carrier. We are not responsible for lost, stolen, or damaged packages after carrier acceptance, though we will assist with carrier claims.</p>
          </div>
        </section>

        {{-- Section 5 --}}
        <section id="returns" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">5</span>
            Returns, Refunds & 30-Day Money-Back Guarantee
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">5.1 Return Eligibility</h3>
          <div class="prose-content">
            <p>FRAMEWORK SUPPLY CO. offers a <strong>30-day money-back guarantee</strong> from the date of delivery (not purchase date) under the following conditions:</p>
          </div>

          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3 flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                Eligible Returns
              </h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Unworn items with original tags</li>
                <li>• Unused in original packaging</li>
                <li>• No signs of wear or alteration</li>
                <li>• Original proof of purchase</li>
                <li>• Within 30 days of delivery</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3 flex items-center gap-2">
                <i data-lucide="x-circle" class="w-5 h-5"></i>
                Non-Returnable Items
              </h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Final sale/clearance items</li>
                <li>• Used, worn, or washed products</li>
                <li>• Items without original tags</li>
                <li>• Intimate apparel</li>
                <li>• Custom/personalized products</li>
              </ul>
            </div>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">5.2 Refund Processing</h3>
          <div class="border-l-4 border-primary dark:border-white pl-6 mt-6">
            <p class="text-secondary dark:text-gray-400 text-sm"><strong class="text-primary dark:text-white">Refund Timeline:</strong></p>
            <ul class="text-secondary dark:text-gray-400 text-sm mt-2 space-y-1">
              <li>• Inspection: 3-5 business days upon receipt</li>
              <li>• Refund issuance: 2-3 business days after approval</li>
              <li>• Bank/credit card processing: 5-10 business days</li>
              <li>• Total timeframe: Up to 14 business days</li>
            </ul>
          </div>
        </section>

        {{-- Section 6 --}}
        <section id="intellectual" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">6</span>
            Intellectual Property Rights
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">6.1 Ownership & Proprietary Rights</h3>
          <div class="prose-content">
            <p>All content, features, functionality, designs, logos, trademarks, service marks, graphics, photographs, text, software, code, and other materials (collectively, "Content") available through our Services are owned by FRAMEWORK SUPPLY CO., its licensors, or other content providers and are protected by United Kingdom and international copyright laws, trademark laws, and other intellectual property rights laws.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">6.2 Limited License</h3>
          <div class="prose-content">
            <p>Subject to your compliance with these Terms, we grant you a limited, non-exclusive, non-transferable, non-sublicensable, revocable license to access and use the Services for personal, non-commercial purposes.</p>
            <p class="mt-4"><strong>You may not:</strong></p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Modify, reproduce, distribute, or create derivative works</li>
              <li>Reverse engineer, decompile, or disassemble any software</li>
              <li>Remove copyright, trademark, or proprietary notices</li>
              <li>Use automated systems (bots, scrapers) to access Services</li>
              <li>Use Content for commercial purposes without authorization</li>
            </ul>
          </div>
        </section>

        {{-- Section 7 --}}
        <section id="conduct" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">7</span>
            User Conduct & Prohibited Activities
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">7.1 Acceptable Use</h3>
          <div class="prose-content">
            <p>You agree to use our Services only for lawful purposes and in accordance with these Terms. You will not engage in:</p>
          </div>

          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Fraudulent Activities</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-1">
                <li>• Use of stolen payment information</li>
                <li>• Providing false information</li>
                <li>• Creating multiple accounts</li>
                <li>• Exploiting pricing errors</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Unauthorized Access</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-1">
                <li>• Attempting to gain unauthorized access</li>
                <li>• Bypassing security measures</li>
                <li>• Using another user's account</li>
                <li>• Testing system vulnerabilities</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Abusive Behavior</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-1">
                <li>• Harassing users or staff</li>
                <li>• Posting offensive content</li>
                <li>• Hate speech or violence</li>
                <li>• Impersonating others</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Commercial Misuse</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-1">
                <li>• Bulk resale operations</li>
                <li>• Using automated purchasing bots</li>
                <li>• Market price manipulation</li>
                <li>• Unauthorized data scraping</li>
              </ul>
            </div>
          </div>
        </section>

        {{-- Section 8 --}}
        <section id="support" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">8</span>
            24/7 Customer Support & Communications
          </h2>

          <div class="grid md:grid-cols-3 gap-6 mt-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 text-center">
              <i data-lucide="message-circle" class="w-8 h-8 text-primary dark:text-white mx-auto mb-3"></i>
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Live Chat</h4>
              <p class="text-sm text-secondary dark:text-gray-400">24/7 availability</p>
              <p class="text-sm text-secondary dark:text-gray-400">Immediate response</p>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 text-center">
              <i data-lucide="mail" class="w-8 h-8 text-primary dark:text-white mx-auto mb-3"></i>
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Email Support</h4>
              <p class="text-sm text-secondary dark:text-gray-400">support@frameworksupply.co</p>
              <p class="text-sm text-secondary dark:text-gray-400">Response within 24 hours</p>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 text-center">
              <i data-lucide="phone" class="w-8 h-8 text-primary dark:text-white mx-auto mb-3"></i>
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Phone Support</h4>
              <p class="text-sm text-secondary dark:text-gray-400">24/7 availability</p>
              <p class="text-sm text-secondary dark:text-gray-400">Immediate connection</p>
            </div>
          </div>
        </section>

        {{-- Section 9 --}}
        <section id="disclaimers" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">9</span>
            Disclaimers & Limitations of Liability
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">9.1 Service "As Is" Disclaimer</h3>
          <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 p-6">
            <p class="text-yellow-800 dark:text-yellow-200 text-sm font-bold">
              THE SERVICES AND ALL CONTENT ARE PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, NON-INFRINGEMENT, OR COURSE OF PERFORMANCE.
            </p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">9.2 Limitation of Liability</h3>
          <div class="prose-content">
            <p>TO THE MAXIMUM EXTENT PERMITTED BY LAW, FRAMEWORK SUPPLY CO., ITS AFFILIATES, DIRECTORS, OFFICERS, EMPLOYEES, AGENTS, AND LICENSORS SHALL NOT BE LIABLE FOR:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Indirect, incidental, special, consequential, or punitive damages</li>
              <li>Loss of profits, revenue, data, or business opportunities</li>
              <li>Cost of substitute goods or services</li>
              <li>Personal injury or property damage (except where prohibited by law)</li>
            </ul>
            <p class="mt-4"><strong>Maximum Liability:</strong> In no event shall our aggregate liability exceed the amount you paid to us in the 12 months preceding the claim, or $100 USD, whichever is greater.</p>
          </div>
        </section>

        {{-- Section 10 --}}
        <section id="indemnification" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">10</span>
            Indemnification
          </h2>

          <div class="prose-content">
            <p>You agree to defend, indemnify, and hold harmless FRAMEWORK SUPPLY CO., its affiliates, licensors, and service providers, and their respective officers, directors, employees, contractors, agents, licensors, suppliers, successors, and assigns from and against any claims, liabilities, damages, judgments, awards, losses, costs, expenses, or fees (including reasonable attorneys' fees) arising out of or relating to:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Your violation of these Terms</li>
              <li>Your use or misuse of the Services</li>
              <li>Your violation of any law or third-party rights</li>
              <li>User-generated content you submit or post</li>
              <li>Fraudulent or illegal activities</li>
              <li>Unauthorized access using your account</li>
              <li>Product misuse resulting in injury or damage</li>
            </ul>
          </div>
        </section>

        {{-- Section 11 --}}
        <section id="disputes" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">11</span>
            Dispute Resolution & Arbitration
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">11.1 Informal Dispute Resolution</h3>
          <div class="prose-content">
            <p>Before initiating formal proceedings, you agree to contact us at <a href="mailto:legal@frameworksupply.co" class="underline">legal@frameworksupply.co</a> to attempt informal resolution. We will attempt to resolve disputes amicably within 30 days.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">11.2 Binding Arbitration</h3>
          <div class="prose-content">
            <p>You and FRAMEWORK SUPPLY CO. agree that any dispute, claim, or controversy arising out of or relating to these Terms or Services will be settled by binding arbitration administered by the American Arbitration Association (AAA) under AAA Consumer Arbitration Rules.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">11.3 Class Action Waiver</h3>
          <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-6">
            <p class="text-red-800 dark:text-red-200 text-sm font-bold">
              YOU AND FRAMEWORK SUPPLY CO. AGREE THAT DISPUTES WILL BE RESOLVED ON AN INDIVIDUAL BASIS. YOU WAIVE ANY RIGHT TO PARTICIPATE IN CLASS ACTIONS, CLASS ARBITRATIONS, PRIVATE ATTORNEY GENERAL ACTIONS, OR CONSOLIDATED PROCEEDINGS.
            </p>
          </div>
        </section>

        {{-- Section 12 --}}
        <section id="governing" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">12</span>
            Governing Law & Jurisdiction
          </h2>

          <div class="prose-content">
            <p>These Terms and any disputes are governed by the laws of the United Kingdom, without regard to conflict of law principles. For disputes not subject to arbitration, you consent to the exclusive jurisdiction and venue of state and federal courts.</p>
          </div>
        </section>

        {{-- Section 13 --}}
        <section id="force" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">13</span>
            Force Majeure
          </h2>

          <div class="prose-content">
            <p>FRAMEWORK SUPPLY CO. shall not be liable for any failure or delay in performance resulting from circumstances beyond our reasonable control, including but not limited to:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Natural disasters (earthquakes, floods, fires, storms)</li>
              <li>War, terrorism, riots, civil unrest</li>
              <li>Pandemics, epidemics, public health emergencies</li>
              <li>Government actions, regulations, or restrictions</li>
              <li>Labor disputes, strikes, lockouts</li>
              <li>Utility failures, telecommunications outages</li>
              <li>Supplier failures or material shortages</li>
              <li>Shipping carrier disruptions</li>
              <li>Cyberattacks or network intrusions</li>
            </ul>
          </div>
        </section>

        {{-- Section 14 --}}
        <section id="general" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">14</span>
            General Provisions
          </h2>

          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Entire Agreement</h4>
              <p class="text-secondary dark:text-gray-400 text-sm">These Terms constitute the entire agreement between you and FRAMEWORK SUPPLY CO. regarding the Services.</p>
            </div>

            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Severability</h4>
              <p class="text-secondary dark:text-gray-400 text-sm">If any provision is held invalid or unenforceable, remaining provisions remain in full effect.</p>
            </div>

            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Waiver</h4>
              <p class="text-secondary dark:text-gray-400 text-sm">Failure to enforce any right or provision does not constitute a waiver of future enforcement.</p>
            </div>

            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Assignment</h4>
              <p class="text-secondary dark:text-gray-400 text-sm">You may not assign these Terms without our prior written consent.</p>
            </div>
          </div>
        </section>

        {{-- Section 15 --}}
        <section id="contact" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">15</span>
            Contact Information
          </h2>

          <div class="bg-primary dark:bg-white text-white dark:text-gray-900 p-8">
            <div class="grid md:grid-cols-2 gap-6">
              <div>
                <h4 class="uppercase tracking-wide mb-3">General Inquiries</h4>
                <p class="text-sm opacity-90">
                  <strong>Email:</strong> legal@frameworksupply.co<br>
                  <strong>24/7 Support:</strong> support@frameworksupply.co
                </p>
              </div>
              <div>
                <h4 class="uppercase tracking-wide mb-3">Legal Department</h4>
                <p class="text-sm opacity-90">
                  FRAMEWORK SUPPLY CO.<br>
                  Legal & Compliance Department
                </p>
              </div>
            </div>
          </div>
        </section>

        {{-- Section 16 --}}
        <section id="california" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">16</span>
            California-Specific Disclosures
          </h2>

          <div class="prose-content">
            <p>California residents are entitled to the following consumer rights information:</p>
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 mt-4">
              <p class="text-primary dark:text-white font-medium mb-2">Complaint Assistance Unit</p>
              <p class="text-secondary dark:text-gray-400 text-sm">
                Division of Consumer Services<br>
                California Department of Consumer Affairs<br>
                1625 North Market Blvd., Suite N 112<br>
                Sacramento, CA 95834<br>
                <strong>Phone:</strong> (916) 445-1254 or (800) 952-5210
              </p>
            </div>
          </div>
        </section>

        {{-- Final Acknowledgment --}}
        <div class="border-t-2 border-primary dark:border-white pt-8 mt-8">
          <p class="text-secondary dark:text-gray-400 text-sm">
            By using FRAMEWORK SUPPLY CO., you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.
          </p>
          <div class="mt-4 text-sm text-secondary dark:text-gray-400">
            <p><strong>Last Updated:</strong> January 19, 2026</p>
            <p><strong>Terms Version:</strong> 3.0</p>
            <p><strong>Effective Date:</strong> January 19, 2026</p>
          </div>
        </div>
      </div>

      {{-- Back to Top --}}
      <div data-animate="fade-in" data-delay="400" class="text-center mt-8">
        <a href="#" class="inline-flex items-center gap-2 text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors">
          <i data-lucide="arrow-up" class="w-4 h-4"></i>
          Back to Top
        </a>
      </div>
    </div>
  </section>
</div>

<style>
  .prose-content p {
    color: #64748b;
    margin-bottom: 1rem;
    line-height: 1.75;
    text-align: justify;
  }
  
  .dark .prose-content p {
    color: #9ca3af;
  }
  
  .prose-content strong {
    color: #111827;
  }
  
  .dark .prose-content strong {
    color: #fff;
  }
  
  .tos-content h2 {
    scroll-margin-top: 8rem;
  }
  
  .tos-content ul li,
  .tos-content .text-secondary,
  .tos-content .dark\:text-gray-400 {
    text-align: justify;
  }
  
  .tos-content table td {
    text-align: left;
  }
  
  .prose-content a {
    color: #111827;
    text-decoration: underline;
  }
  
  .dark .prose-content a {
    color: #fff;
  }
  
  /* Smooth scrolling */
  html {
    scroll-behavior: smooth;
  }
</style>
@endsection
