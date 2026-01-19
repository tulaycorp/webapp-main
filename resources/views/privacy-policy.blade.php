@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - Privacy Policy')

@section('meta')
<meta name="description" content="Privacy Policy for FRAMEWORK Supply Co. - Learn how we collect, use, and protect your personal information.">
@endsection

@section('content')
<div class="pt-32">
  {{-- Privacy Policy Hero Section --}}
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
          Privacy<br/>
          <span class="block dark:text-stroke-white" 
                style="-webkit-text-stroke: 1px currentColor; -webkit-text-fill-color: transparent;">
            Policy
          </span>
        </h1>

        <p class="text-secondary dark:text-gray-400 text-lg">
          Last Updated: January 19, 2026 | Version 2.0
        </p>
      </div>

      {{-- Quick Navigation --}}
      <div data-animate="fade-in" data-delay="200" class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 mb-12">
        <h3 class="text-primary dark:text-white uppercase tracking-wider mb-4 font-semibold flex items-center justify-center gap-2">
          <i data-lucide="list" class="w-5 h-5"></i>
          Quick Navigation
        </h3>
        <div class="grid md:grid-cols-2 gap-2 text-sm max-w-3xl mx-auto">
          <a href="#introduction" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">1. Introduction & Overview</a>
          <a href="#information-collect" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">2. Information We Collect</a>
          <a href="#how-we-use" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">3. How We Use Your Information</a>
          <a href="#security" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">4. Data Security & Protection</a>
          <a href="#cookies" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">5. Cookies & Tracking</a>
          <a href="#third-party" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">6. Third-Party Sharing</a>
          <a href="#international" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">7. International Data Transfers</a>
          <a href="#your-rights" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">8. Your Privacy Rights</a>
          <a href="#retention" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">9. Data Retention</a>
          <a href="#children" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">10. Children's Privacy</a>
          <a href="#changes" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">11. Policy Changes</a>
          <a href="#contact" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1 px-4 pl-24">12. Contact Information</a>
        </div>
      </div>

      {{-- Privacy Policy Content --}}
      <div data-animate="fade-in" data-delay="300" class="privacy-content bg-white dark:bg-gray-800 border border-border dark:border-gray-700 p-8 lg:p-16">
        
        {{-- Section 1 --}}
        <section id="introduction" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">1</span>
            Introduction & Overview
          </h2>
          <div class="prose-content">
            <p>Welcome to <strong>FRAMEWORK SUPPLY CO.</strong> ("Company," "we," "us," "our," or "FRAMEWORK"). We are committed to protecting your privacy and ensuring you have a positive experience on our website and mobile applications.</p>
            <p>This comprehensive Privacy Policy explains how we collect, use, disclose, and protect your information when you visit our e-commerce platform, purchase our limited-edition streetwear products, interact with our customer support services, or engage with us across any digital touchpoint.</p>
            <p>FRAMEWORK SUPPLY CO. specializes in curated, limited-edition streetwear designs with production capped at <strong>500 units per design</strong> to ensure exclusivity and minimize duplication. This Privacy Policy applies to all information collected through our website, mobile applications, social media channels, email communications, and any other means through which you interact with FRAMEWORK SUPPLY CO.</p>
          </div>
        </section>

        {{-- Section 2 --}}
        <section id="information-collect" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">2</span>
            Information We Collect
          </h2>
          
          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">2.1 Information You Provide Directly</h3>
          <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400">
            <li><strong class="text-primary dark:text-white">Account Registration Information:</strong> Name, email address, password, date of birth, phone number, and security questions when you create an account</li>
            <li><strong class="text-primary dark:text-white">Shipping & Billing Information:</strong> Physical addresses, phone numbers, and delivery preferences for order fulfillment and our Free Shipping program (orders over $150)</li>
            <li><strong class="text-primary dark:text-white">Payment Information:</strong> Credit card numbers, debit card details, digital wallet information, billing addresses, and payment transaction history. Payment processing is handled by PCI-DSS compliant third-party processors</li>
            <li><strong class="text-primary dark:text-white">Customer Communications:</strong> Messages, inquiries, feedback, product reviews, testimonials, and responses to surveys or questionnaires</li>
            <li><strong class="text-primary dark:text-white">Customer Support Data:</strong> Chat transcripts, email support correspondence, support ticket information, and call recordings with your consent for our 24/7 Support services</li>
            <li><strong class="text-primary dark:text-white">Social Media Profiles:</strong> If you link social media accounts or authenticate through social platforms</li>
            <li><strong class="text-primary dark:text-white">Preference & Interest Data:</strong> Style preferences, size information, notification preferences, wish lists, and product interest indicators</li>
            <li><strong class="text-primary dark:text-white">User-Generated Content:</strong> Photos, videos, comments, and social posts where you mention or feature FRAMEWORK products</li>
          </ul>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">2.2 Information Collected Automatically</h3>
          <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400">
            <li><strong class="text-primary dark:text-white">Device Information:</strong> IP address, device type, operating system, browser type, device identifiers, mobile network information, and unique device IDs</li>
            <li><strong class="text-primary dark:text-white">Browsing Behavior:</strong> Pages visited, time spent on pages, click patterns, search queries, product views, cart contents (even if not purchased), and navigation patterns</li>
            <li><strong class="text-primary dark:text-white">Cookies & Similar Technologies:</strong> Session IDs, persistent cookies, web beacons, pixels, and similar tracking technologies to enhance user experience</li>
            <li><strong class="text-primary dark:text-white">Location Data:</strong> GPS coordinates (with permission), IP-based location inference, and geolocation data used for local delivery optimization and targeted marketing</li>
            <li><strong class="text-primary dark:text-white">Biometric Data:</strong> Fingerprint or facial recognition data if you use biometric authentication on our mobile app</li>
            <li><strong class="text-primary dark:text-white">Error & Performance Data:</strong> Crash reports, system logs, application performance metrics, and diagnostic information</li>
            <li><strong class="text-primary dark:text-white">Referral Data:</strong> Information about how you were referred to our platform (affiliate links, promotional codes, marketing campaigns)</li>
          </ul>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">2.3 Information From Third Parties</h3>
          <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400">
            <li><strong class="text-primary dark:text-white">Social Media Platforms:</strong> Profile information when you authenticate through social networks</li>
            <li><strong class="text-primary dark:text-white">Payment Processors:</strong> Transaction verification, fraud detection results, and payment status</li>
            <li><strong class="text-primary dark:text-white">Shipping & Logistics Partners:</strong> Delivery status, tracking information, and carrier data</li>
            <li><strong class="text-primary dark:text-white">Marketing & Analytics Partners:</strong> Aggregate behavioral data, market research insights, and performance metrics</li>
            <li><strong class="text-primary dark:text-white">Data Brokers & Aggregators:</strong> Publicly available information for verification and risk assessment purposes</li>
            <li><strong class="text-primary dark:text-white">Business Partners:</strong> Co-marketing partners, affiliates, and strategic collaborators may share customer information with your consent</li>
          </ul>
        </section>

        {{-- Section 3 --}}
        <section id="how-we-use" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">3</span>
            How We Use Your Information
          </h2>

          <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3 flex items-center gap-2">
                <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                Core Operations
              </h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-1">
                <li>• Processing and fulfilling orders</li>
                <li>• Managing 30-day money-back guarantee</li>
                <li>• Account management</li>
                <li>• Transactional communications</li>
                <li>• Identity verification</li>
                <li>• Fraud prevention</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3 flex items-center gap-2">
                <i data-lucide="headphones" class="w-5 h-5"></i>
                Customer Support
              </h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-1">
                <li>• 24/7 support services</li>
                <li>• Inquiry responses</li>
                <li>• Service quality improvement</li>
                <li>• Staff training</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3 flex items-center gap-2">
                <i data-lucide="megaphone" class="w-5 h-5"></i>
                Marketing
              </h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-1">
                <li>• Promotional communications</li>
                <li>• New product launches</li>
                <li>• Personalized recommendations</li>
                <li>• Market research</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3 flex items-center gap-2">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
                Security & Compliance
              </h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-1">
                <li>• Fraud detection</li>
                <li>• Security audits</li>
                <li>• Legal compliance</li>
                <li>• Terms enforcement</li>
              </ul>
            </div>
          </div>
        </section>

        {{-- Section 4 --}}
        <section id="security" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">4</span>
            Data Security & Protection
          </h2>

          <div class="space-y-6">
            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Technical Safeguards</h4>
              <p class="text-secondary dark:text-gray-400 text-sm">TLS/SSL encryption, AES-256 encryption at rest, multi-layered firewalls, role-based access control, OAuth 2.0 authentication, and regular security scanning.</p>
            </div>

            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Administrative Safeguards</h4>
              <p class="text-secondary dark:text-gray-400 text-sm">Background checks for employees, documented security policies, regular training, vendor security assessments, and data minimization principles.</p>
            </div>

            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Physical Safeguards</h4>
              <p class="text-secondary dark:text-gray-400 text-sm">Secure data centers with 24/7 monitoring, environmental controls, video surveillance, and secure document destruction.</p>
            </div>

            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 p-4 mt-6">
              <p class="text-yellow-800 dark:text-yellow-200 text-sm">
                <strong>Important:</strong> While we implement comprehensive security measures, no method of transmission over the internet is completely secure. You are responsible for maintaining the confidentiality of your account credentials.
              </p>
            </div>
          </div>
        </section>

        {{-- Section 5 --}}
        <section id="cookies" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">5</span>
            Cookies & Tracking Technologies
          </h2>

          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b-2 border-primary dark:border-white">
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Cookie Type</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Purpose</th>
                </tr>
              </thead>
              <tbody class="text-secondary dark:text-gray-400">
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Essential</td>
                  <td class="py-3">Required for authentication, account security, and basic functionality</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Performance</td>
                  <td class="py-3">Measure website performance and user engagement</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Functional</td>
                  <td class="py-3">Remember preferences, language settings, and login information</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Marketing</td>
                  <td class="py-3">Track conversions, enable retargeting, and personalize ads</td>
                </tr>
                <tr>
                  <td class="py-3 font-medium text-primary dark:text-white">Analytics</td>
                  <td class="py-3">Collect aggregated usage data for optimization</td>
                </tr>
              </tbody>
            </table>
          </div>

          <p class="text-secondary dark:text-gray-400 mt-6 text-sm">
            You can control cookie preferences through your browser settings. You may also opt out via the Network Advertising Initiative (NAI) or Digital Advertising Alliance (DAA).
          </p>
        </section>

        {{-- Section 6 --}}
        <section id="third-party" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">6</span>
            Third-Party Information Sharing
          </h2>

          <div class="prose-content mb-6">
            <p>We share your information with trusted third parties who assist us in operating our platform:</p>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach([
              ['Payment', 'Stripe, PayPal'],
              ['Shipping', 'USPS, UPS, FedEx'],
              ['Email', 'SendGrid, Mailchimp'],
              ['Analytics', 'Google Analytics'],
              ['Marketing', 'Meta, Google, TikTok'],
              ['Support', 'Zendesk, Intercom'],
              ['Hosting', 'AWS, Google Cloud'],
              ['Security', 'MaxMind, Sift']
            ] as $partner)
              <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-4 text-center">
                <p class="text-primary dark:text-white font-medium text-sm uppercase">{{ $partner[0] }}</p>
                <p class="text-secondary dark:text-gray-400 text-xs">{{ $partner[1] }}</p>
              </div>
            @endforeach
          </div>

          <p class="text-secondary dark:text-gray-400 mt-6 text-sm">
            All third parties are contractually bound by Data Processing Agreements (DPAs) and required to maintain equivalent data protection standards.
          </p>
        </section>

        {{-- Section 7 --}}
        <section id="international" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">7</span>
            International Data Transfers
          </h2>

          <div class="prose-content">
            <p>FRAMEWORK SUPPLY CO. operates globally. Personal data may be transferred to countries with differing data protection laws. We rely on:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Standard Contractual Clauses (SCCs)</li>
              <li>Data Processing Agreements</li>
              <li>Adequacy Decisions</li>
              <li>Explicit Consent</li>
            </ul>
            <p class="mt-4">For EU–US data transfers, we rely on appropriate legal mechanisms and provide an EU-specific privacy addendum upon request.</p>
          </div>
        </section>

        {{-- Section 8 --}}
        <section id="your-rights" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">8</span>
            Your Privacy Rights
          </h2>

          <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-4">General Rights</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Right to Access</li>
                <li>• Right to Correction</li>
                <li>• Right to Deletion</li>
                <li>• Right to Withdraw Consent</li>
                <li>• Right to Opt-Out</li>
                <li>• Right to Data Portability</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-4">GDPR Rights (EU)</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Right to Restrict Processing</li>
                <li>• Right to Object</li>
                <li>• Right to Complain</li>
                <li>• Rights Against Automated Decisions</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-4">CCPA Rights (California)</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Right to Know</li>
                <li>• Right to Delete</li>
                <li>• Right to Opt-Out of Sale</li>
                <li>• Right to Correct</li>
                <li>• Right to Non-Discrimination</li>
              </ul>
            </div>
          </div>

          <div class="bg-primary dark:bg-white text-white dark:text-gray-900 p-6 mt-6">
            <h4 class="uppercase tracking-wide mb-2">How to Exercise Your Rights</h4>
            <p class="text-sm opacity-90">
              Email: <a href="mailto:privacy@frameworksupply.co" class="underline">privacy@frameworksupply.co</a><br>
              Response time: <strong>45 days</strong>
            </p>
          </div>
        </section>

        {{-- Section 9 --}}
        <section id="retention" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">9</span>
            Data Retention Periods
          </h2>

          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b-2 border-primary dark:border-white">
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Data Type</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Retention Period</th>
                </tr>
              </thead>
              <tbody class="text-secondary dark:text-gray-400">
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3">Account Information</td>
                  <td class="py-3">Until deletion or 5 years after last activity</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3">Transaction & Order Data</td>
                  <td class="py-3">7 years</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3">Payment Information</td>
                  <td class="py-3">Deleted after transaction completion</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3">Marketing Preferences</td>
                  <td class="py-3">Until opt-out</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3">Cookies & Analytics</td>
                  <td class="py-3">Up to 2 years</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3">Support Tickets & Chat</td>
                  <td class="py-3">3 years</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3">User-Generated Content</td>
                  <td class="py-3">Until deleted</td>
                </tr>
                <tr>
                  <td class="py-3">Fraud/Security Logs</td>
                  <td class="py-3">2 years</td>
                </tr>
              </tbody>
            </table>
          </div>

          <p class="text-secondary dark:text-gray-400 mt-6 text-sm">
            Personal data is removed from active systems within 30 days of account deletion request, subject to legal and operational exceptions.
          </p>
        </section>

        {{-- Section 10 --}}
        <section id="children" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">10</span>
            Children's Privacy
          </h2>

          <div class="prose-content">
            <p>We do not knowingly collect information from children under 13. If discovered, we will obtain parental consent, restrict data use, or delete the account.</p>
            <p class="mt-4">For users aged 13–18, we apply age-appropriate protections including limited tracking and restricted marketing communications.</p>
          </div>
        </section>

        {{-- Section 11 --}}
        <section id="changes" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">11</span>
            Changes to This Policy
          </h2>

          <div class="prose-content">
            <p>We may update this Privacy Policy from time to time. Updates will be communicated via:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Email notifications</li>
              <li>Website notices</li>
              <li>Dashboard alerts</li>
              <li>Affirmative consent where required by law</li>
            </ul>
          </div>
        </section>

        {{-- Section 12 --}}
        <section id="contact" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">12</span>
            Contact Information
          </h2>

          <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
            <div class="grid md:grid-cols-2 gap-6">
              <div>
                <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Privacy Inquiries</h4>
                <p class="text-secondary dark:text-gray-400 text-sm">
                  <strong>Email:</strong> privacy@frameworksupply.co
                </p>
              </div>
              <div>
                <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Mailing Address</h4>
                <p class="text-secondary dark:text-gray-400 text-sm">
                  FRAMEWORK SUPPLY CO.<br>
                  Privacy & Data Protection Department
                </p>
              </div>
            </div>
          </div>
        </section>

        {{-- Security Certifications --}}
        <section class="mb-8">
          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4">Security Certifications</h3>
          <div class="flex flex-wrap gap-4">
            @foreach(['PCI-DSS Level 1', 'ISO/IEC 27001', 'SOC 2 Type II', 'GDPR Compliance'] as $cert)
              <span class="bg-primary dark:bg-white text-white dark:text-gray-900 px-4 py-2 text-sm uppercase tracking-wide">
                {{ $cert }}
              </span>
            @endforeach
          </div>
        </section>

        {{-- Final Acknowledgment --}}
        <div class="border-t-2 border-primary dark:border-white pt-8 mt-8">
          <p class="text-secondary dark:text-gray-400 text-sm">
            By using FRAMEWORK SUPPLY CO., you acknowledge that you have read, understood, and agree to this Privacy Policy.
          </p>
          <div class="mt-4 text-sm text-secondary dark:text-gray-400">
            <p><strong>Last Updated:</strong> January 19, 2026</p>
            <p><strong>Policy Version:</strong> 2.0</p>
            <p><strong>Next Review:</strong> January 19, 2027</p>
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
  
  .privacy-content h2 {
    scroll-margin-top: 8rem;
  }
  
  .privacy-content ul li,
  .privacy-content .text-secondary,
  .privacy-content .dark\:text-gray-400 {
    text-align: justify;
  }
  
  .privacy-content table td {
    text-align: left;
  }
  
  /* Smooth scrolling */
  html {
    scroll-behavior: smooth;
  }
</style>
@endsection
