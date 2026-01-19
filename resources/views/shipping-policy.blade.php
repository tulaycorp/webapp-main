@extends('layouts.app')

@section('title', 'FRAMEWORK Supply Co. - Shipping Policy')

@section('meta')
<meta name="description" content="Shipping & Delivery Policy for FRAMEWORK Supply Co. - Learn about our shipping methods, timeframes, and delivery procedures.">
@endsection

@section('content')
<div class="pt-32">
  {{-- Shipping Policy Hero Section --}}
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
          Shipping &<br/>
          <span class="block dark:text-stroke-white" 
                style="-webkit-text-stroke: 1px currentColor; -webkit-text-fill-color: transparent;">
            Delivery
          </span>
        </h1>

        <p class="text-secondary dark:text-gray-400 text-lg">
          Last Updated: January 19, 2026 | Version 2.0
        </p>
      </div>

      {{-- Quick Navigation --}}
      <div data-animate="fade-in" data-delay="200" class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 mb-12 text-center">
        <h3 class="text-primary dark:text-white uppercase tracking-wider mb-4 font-semibold flex items-center justify-center gap-2">
          <i data-lucide="list" class="w-5 h-5"></i>
          Quick Navigation
        </h3>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 text-sm max-w-5xl mx-auto text-center">
          <a href="#overview" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1">1. Policy Overview & Scope</a>
          <a href="#destinations" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1">2. Shipping Destinations</a>
          <a href="#methods" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1">3. Shipping Methods</a>
          <a href="#processing" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1">4. Order Processing</a>
          <a href="#tracking" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1">5. Tracking & Delivery</a>
          <a href="#international" class="text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors py-1">6. International Shipping</a>
        </div>
      </div>

      {{-- Shipping Policy Content --}}
      <div data-animate="fade-in" data-delay="300" class="shipping-content bg-white dark:bg-gray-800 border border-border dark:border-gray-700 p-8 lg:p-16">
        
        {{-- Section 1 --}}
        <section id="overview" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">1</span>
            Policy Overview & Scope
          </h2>
          
          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">1.1 Introduction</h3>
          <div class="prose-content">
            <p>Welcome to the <strong>FRAMEWORK SUPPLY CO.</strong> Shipping & Delivery Policy ("Shipping Policy"). This comprehensive document outlines all terms, conditions, procedures, timeframes, costs, restrictions, and obligations related to the shipment and delivery of products purchased through our e-commerce platform.</p>
            <p>FRAMEWORK SUPPLY CO. specializes in exclusive, limited-edition streetwear designs with production capped at <strong>500 units per design</strong>, ensuring each piece maintains its collectible value and exclusivity. Due to the premium nature of our products and limited inventory, we have implemented rigorous shipping standards to ensure your items arrive safely and promptly.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">1.2 Policy Scope</h3>
          <div class="prose-content">
            <p>This Shipping Policy governs:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>All domestic shipments within the United Kingdom</li>
              <li>International shipments to eligible countries and territories</li>
              <li>Standard, expedited, and overnight shipping services</li>
              <li>Free Shipping program eligibility and restrictions</li>
              <li>Processing timeframes and order fulfillment procedures</li>
              <li>Carrier selection and delivery methods</li>
              <li>Package tracking and delivery confirmation</li>
              <li>Customs, duties, and international shipping compliance</li>
            </ul>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">1.3 Integration with Other Policies</h3>
          <div class="prose-content">
            <p>This Shipping Policy is supplementary to and should be read in conjunction with:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Terms of Service</li>
              <li>Privacy Policy</li>
              <li>Return & Refund Policy</li>
              <li>Product Care & Warranty Information</li>
            </ul>
          </div>
        </section>

        {{-- Section 2 --}}
        <section id="destinations" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">2</span>
            Shipping Destinations & Geographic Coverage
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">2.1 Domestic Shipping (United Kingdom)</h3>
          <div class="prose-content">
            <p>FRAMEWORK SUPPLY CO. ships to all addresses within the fifty (50) United Kingdom, including:</p>
          </div>

          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3 flex items-center gap-2">
                <i data-lucide="map-pin" class="w-5 h-5"></i>
                Continental US
              </h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• All 48 contiguous states</li>
                <li>• Standard, expedited, overnight options</li>
                <li>• Eligible for Free Shipping ($150+)</li>
                <li>• Residential and commercial addresses</li>
                <li>• P.O. Box delivery available</li>
                <li>• Military addresses (APO/FPO/DPO)</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3 flex items-center gap-2">
                <i data-lucide="plane" class="w-5 h-5"></i>
                Non-Contiguous States
              </h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Alaska (AK)</li>
                <li>• Hawaii (HI)</li>
                <li>• Extended delivery timeframes</li>
                <li>• Additional surcharges may apply</li>
                <li>• Limited expedited options</li>
                <li>• Free Shipping exclusions apply</li>
              </ul>
            </div>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">2.2 International Shipping</h3>
          <div class="prose-content">
            <p>We offer international shipping to select countries and regions:</p>
          </div>

          <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
            @foreach([
              'Canada', 'United Kingdom', 'Australia', 'Japan',
              'Germany', 'France', 'Netherlands', 'Belgium',
              'Switzerland', 'Austria', 'Denmark', 'Sweden',
              'Norway', 'Ireland', 'New Zealand', 'Singapore'
            ] as $country)
              <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-3 text-center">
                <p class="text-primary dark:text-white text-sm">{{ $country }}</p>
              </div>
            @endforeach
          </div>

          <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 p-4 mt-6">
            <p class="text-yellow-800 dark:text-yellow-200 text-sm">
              <strong>Note:</strong> We do not ship to countries subject to U.S. trade embargoes, sanctions, or export control restrictions.
            </p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">2.3 Address Requirements</h3>
          <div class="prose-content">
            <p>All shipping addresses must include:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Full recipient name (first and last)</li>
              <li>Street address with apartment/suite number if applicable</li>
              <li>City or locality</li>
              <li>State/Province/Region</li>
              <li>Postal/ZIP code</li>
              <li>Country</li>
              <li>Phone number (required for international shipments)</li>
            </ul>
          </div>
        </section>

        {{-- Section 3 --}}
        <section id="methods" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">3</span>
            Shipping Methods & Service Levels
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">3.1 Standard Domestic Shipping</h3>
          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Service Details</h4>
              <ul class="text-secondary dark:text-gray-400 text-sm space-y-1">
                <li>• Carriers: USPS, UPS, FedEx</li>
                <li>• Processing: 1-3 business days</li>
                <li>• Delivery: 5-7 business days</li>
                <li>• Total: 6-10 business days</li>
                <li>• Full tracking provided</li>
                <li>• Insurance up to $100</li>
              </ul>
            </div>

            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Shipping Rates</h4>
              <ul class="text-secondary dark:text-gray-400 text-sm space-y-1">
                <li>• $0 - $49.99: <strong class="text-primary dark:text-white">$6.95</strong></li>
                <li>• $50 - $99.99: <strong class="text-primary dark:text-white">$8.95</strong></li>
                <li>• $100 - $149.99: <strong class="text-primary dark:text-white">$10.95</strong></li>
                <li>• $150+: <strong class="text-primary dark:text-white">FREE</strong></li>
              </ul>
            </div>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">3.2 Expedited Domestic Shipping</h3>
          <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 mt-6">
            <div class="grid md:grid-cols-3 gap-6">
              <div>
                <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2 text-sm">Carriers</h4>
                <p class="text-secondary dark:text-gray-400 text-sm">UPS, FedEx</p>
              </div>
              <div>
                <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2 text-sm">Timeframe</h4>
                <p class="text-secondary dark:text-gray-400 text-sm">3-5 business days total</p>
              </div>
              <div>
                <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2 text-sm">Cost</h4>
                <p class="text-secondary dark:text-gray-400 text-sm">$19.95 flat rate</p>
              </div>
            </div>
            <p class="text-secondary dark:text-gray-400 text-sm mt-4">
              <strong class="text-primary dark:text-white">Requirements:</strong> Continental U.S. only, no P.O. Boxes, order cutoff 3:00 PM PT
            </p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">3.3 Overnight Domestic Shipping</h3>
          <div class="bg-primary dark:bg-white text-white dark:text-gray-900 p-6 mt-6">
            <div class="grid md:grid-cols-3 gap-6">
              <div>
                <h4 class="uppercase tracking-wide mb-2 text-sm">Processing</h4>
                <p class="text-sm opacity-90">Same business day</p>
              </div>
              <div>
                <h4 class="uppercase tracking-wide mb-2 text-sm">Delivery</h4>
                <p class="text-sm opacity-90">Next business day</p>
              </div>
              <div>
                <h4 class="uppercase tracking-wide mb-2 text-sm">Cost</h4>
                <p class="text-sm opacity-90">$34.95 flat rate</p>
              </div>
            </div>
            <p class="text-sm mt-4 opacity-90">
              <strong>Order by 12:00 PM PT</strong> (Monday-Friday) for next-day delivery. Continental U.S. only.
            </p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">3.4 International Shipping Rates</h3>
          <div class="overflow-x-auto mt-6">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b-2 border-primary dark:border-white">
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Region</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Delivery Time</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Standard</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Express</th>
                </tr>
              </thead>
              <tbody class="text-secondary dark:text-gray-400">
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Canada</td>
                  <td class="py-3">10-15 days</td>
                  <td class="py-3">$24.95</td>
                  <td class="py-3">$49.95</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">UK & EU</td>
                  <td class="py-3">12-18 days</td>
                  <td class="py-3">$29.95</td>
                  <td class="py-3">$59.95</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Australia & NZ</td>
                  <td class="py-3">15-21 days</td>
                  <td class="py-3">$34.95</td>
                  <td class="py-3">$69.95</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Asia (Tier 1)</td>
                  <td class="py-3">12-18 days</td>
                  <td class="py-3">$32.95</td>
                  <td class="py-3">$64.95</td>
                </tr>
                <tr>
                  <td class="py-3 font-medium text-primary dark:text-white">Other Countries</td>
                  <td class="py-3">15-25 days</td>
                  <td class="py-3">$39.95</td>
                  <td class="py-3">$79.95</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        {{-- Section 4 --}}
        <section id="processing" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">4</span>
            Order Processing & Fulfillment
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">4.1 Order Processing Timeframes</h3>
          <div class="overflow-x-auto mt-6">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b-2 border-primary dark:border-white">
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Service Level</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Order Cutoff</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Processing</th>
                </tr>
              </thead>
              <tbody class="text-secondary dark:text-gray-400">
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Standard</td>
                  <td class="py-3">11:59 PM PT</td>
                  <td class="py-3">1-3 business days</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Expedited</td>
                  <td class="py-3">3:00 PM PT</td>
                  <td class="py-3">1-2 business days</td>
                </tr>
                <tr>
                  <td class="py-3 font-medium text-primary dark:text-white">Overnight</td>
                  <td class="py-3">12:00 PM PT</td>
                  <td class="py-3">Same business day</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 p-4 mt-6">
            <p class="text-yellow-800 dark:text-yellow-200 text-sm">
              <strong>Non-Processing Days:</strong> Saturdays, Sundays, U.S. Federal Holidays, and company-designated closure days. Orders placed after cutoff times are processed on the next available business day.
            </p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">4.2 Order Verification & Fraud Prevention</h3>
          <div class="prose-content">
            <p>All orders undergo automated fraud detection screening including:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Address verification system (AVS) check</li>
              <li>Card verification value (CVV) validation</li>
              <li>Billing/shipping address cross-reference</li>
              <li>Purchase pattern analysis</li>
              <li>Geo-location verification</li>
            </ul>
            <p class="mt-4">Orders flagged for manual review may require additional verification documents. Verification requests are sent within 2 hours, and customer response is required within 24 hours.</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">4.3 Order Modification & Cancellation</h3>
          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Modification Window</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• 0-2 hours: Modifications possible</li>
                <li>• 2-24 hours: Address changes only</li>
                <li>• 24+ hours: No modifications</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Cancellation</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Before shipment: Full cancellation</li>
                <li>• After shipment: Return procedures apply</li>
                <li>• Contact: support@frameworksupply.co</li>
              </ul>
            </div>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">4.4 Packaging & Preparation</h3>
          <div class="prose-content">
            <p>All orders include:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Premium FRAMEWORK SUPPLY CO. branded packaging</li>
              <li>Protective wrapping and cushioning materials</li>
              <li>Tissue paper presentation for garments</li>
              <li>Product authentication card with unique serial number</li>
              <li>Care instruction card</li>
              <li>Brand stickers and promotional materials</li>
            </ul>
            <p class="mt-4"><strong>Premium Packaging (Orders $200+):</strong> Deluxe rigid gift box with magnetic closure, premium tissue paper and ribbon, luxury shopping bag, and exclusive thank you card.</p>
          </div>
        </section>

        {{-- Section 5 --}}
        <section id="tracking" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">5</span>
            Tracking, Delivery & Confirmation
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">5.1 Tracking Information</h3>
          <div class="grid md:grid-cols-3 gap-6 mt-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 text-center">
              <i data-lucide="mail" class="w-8 h-8 text-primary dark:text-white mx-auto mb-3"></i>
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Email Notification</h4>
              <p class="text-sm text-secondary dark:text-gray-400">Tracking link sent upon shipment</p>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 text-center">
              <i data-lucide="smartphone" class="w-8 h-8 text-primary dark:text-white mx-auto mb-3"></i>
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">SMS Updates</h4>
              <p class="text-sm text-secondary dark:text-gray-400">Real-time notifications (opt-in)</p>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6 text-center">
              <i data-lucide="monitor" class="w-8 h-8 text-primary dark:text-white mx-auto mb-3"></i>
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Dashboard</h4>
              <p class="text-sm text-secondary dark:text-gray-400">Real-time tracking updates</p>
            </div>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">5.2 Delivery Attempts & Procedures</h3>
          <div class="prose-content">
            <p><strong>Standard Delivery Procedures:</strong></p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Carrier attempts delivery to provided address</li>
              <li>Signature required for orders $300+ and all international shipments</li>
              <li>Delivery to doorstep if signature not required (carrier discretion)</li>
              <li>Delivery photo confirmation (when available from carrier)</li>
              <li>Safe place delivery (if specified and authorized)</li>
            </ul>
            
            <p class="mt-6"><strong>Delivery Attempt Failures:</strong></p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li><strong class="text-primary dark:text-white">First Attempt:</strong> Delivery notice left, package held at facility, second attempt scheduled</li>
              <li><strong class="text-primary dark:text-white">Second Attempt:</strong> Additional notice left, customer must arrange pickup or redelivery</li>
              <li><strong class="text-primary dark:text-white">Third Attempt:</strong> Package held for 5-14 days, return-to-sender if not claimed</li>
            </ul>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">5.3 Signature Requirements</h3>
          <div class="border-l-4 border-primary dark:border-white pl-6 mt-6">
            <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Mandatory Signatures</h4>
            <ul class="text-secondary dark:text-gray-400 text-sm space-y-1">
              <li>• All orders valued at $300 or more</li>
              <li>• All international shipments</li>
              <li>• All overnight shipping orders</li>
              <li>• Orders flagged for additional security</li>
              <li>• High-fraud risk destinations</li>
            </ul>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">5.4 Delivery Confirmation</h3>
          <div class="prose-content">
            <p>Confirmation provided via:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Email confirmation upon successful delivery</li>
              <li>Tracking system updated with delivery status</li>
              <li>SMS confirmation (if opted in)</li>
              <li>Delivery photo (when available from carrier)</li>
              <li>Signature record (for signature-required deliveries)</li>
            </ul>
          </div>
        </section>

        {{-- Section 6 --}}
        <section id="international" class="mb-12 scroll-mt-32">
          <h2 class="text-2xl lg:text-3xl text-primary dark:text-white uppercase tracking-tight font-impact mb-6 flex items-center gap-3">
            <span class="w-10 h-10 bg-primary dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-lg font-bold">6</span>
            International Shipping, Customs & Duties
          </h2>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">6.1 International Shipping Overview</h3>
          <div class="prose-content">
            <p>FRAMEWORK SUPPLY CO. offers international shipping to over 60 countries worldwide. International orders are subject to additional regulations, fees, and delivery timeframes compared to domestic shipments.</p>
          </div>

          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">FRAMEWORK Responsibilities</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Accurate customs documentation</li>
                <li>• Proper packaging and labeling</li>
                <li>• Tracking provision</li>
                <li>• Carrier coordination</li>
              </ul>
            </div>

            <div class="bg-background dark:bg-gray-700 border border-border dark:border-gray-600 p-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-3">Customer Responsibilities</h4>
              <ul class="text-sm text-secondary dark:text-gray-400 space-y-2">
                <li>• Payment of customs duties & taxes</li>
                <li>• Customs clearance coordination</li>
                <li>• Accurate address information</li>
                <li>• Timely package acceptance</li>
              </ul>
            </div>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">6.2 Customs Documentation</h3>
          <div class="prose-content">
            <p>All international shipments include:</p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li>Commercial invoice (3 copies minimum)</li>
              <li>Customs declaration form (CN22 or CN23)</li>
              <li>Harmonized System (HS) tariff codes</li>
              <li>Country of origin declaration</li>
              <li>Product description and composition</li>
              <li>Item value and currency</li>
            </ul>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">6.3 Customs Duties, Taxes & Fees</h3>
          <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-6 mt-6">
            <h4 class="text-red-800 dark:text-red-200 uppercase tracking-wide mb-3 font-bold">IMPORTANT: Customer Responsibility</h4>
            <p class="text-red-800 dark:text-red-200 text-sm">
              Customers are solely responsible for all customs duties, taxes, and fees imposed by the destination country. These charges are collected by the carrier or customs authority upon delivery or clearance.
            </p>
          </div>

          <div class="prose-content mt-6">
            <p><strong>Types of Charges:</strong></p>
            <ul class="list-disc pl-6 space-y-2 text-secondary dark:text-gray-400 mt-4">
              <li><strong class="text-primary dark:text-white">Customs Duties:</strong> Import tariffs based on product type and value</li>
              <li><strong class="text-primary dark:text-white">Value Added Tax (VAT):</strong> Applicable in EU, UK, and other jurisdictions</li>
              <li><strong class="text-primary dark:text-white">Goods and Services Tax (GST):</strong> Applicable in Canada, Australia, etc.</li>
              <li><strong class="text-primary dark:text-white">Brokerage Fees:</strong> Carrier fees for customs clearance services</li>
              <li><strong class="text-primary dark:text-white">Handling Fees:</strong> Additional carrier or customs processing fees</li>
            </ul>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">6.4 Duty-Free Thresholds</h3>
          <div class="overflow-x-auto mt-6">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b-2 border-primary dark:border-white">
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Country/Region</th>
                  <th class="text-left py-3 text-primary dark:text-white uppercase tracking-wide">Threshold</th>
                </tr>
              </thead>
              <tbody class="text-secondary dark:text-gray-400">
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Canada</td>
                  <td class="py-3">CAD $20</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">European Union</td>
                  <td class="py-3">€150</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">United Kingdom</td>
                  <td class="py-3">£135</td>
                </tr>
                <tr class="border-b border-border dark:border-gray-700">
                  <td class="py-3 font-medium text-primary dark:text-white">Australia</td>
                  <td class="py-3">AUD $1,000</td>
                </tr>
                <tr>
                  <td class="py-3 font-medium text-primary dark:text-white">United Kingdom</td>
                  <td class="py-3">USD $800</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="prose-content mt-6">
            <p>Orders below these thresholds may be exempt from duties (taxes may still apply).</p>
          </div>

          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4 mt-8">6.5 Customs Clearance Process</h3>
          <div class="grid md:grid-cols-2 gap-6 mt-6">
            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Clearance Timeline</h4>
              <ul class="text-secondary dark:text-gray-400 text-sm space-y-1">
                <li>• EU/UK: 1-5 business days</li>
                <li>• Canada: 1-3 business days</li>
                <li>• Australia: 2-5 business days</li>
                <li>• Asia: 2-7 business days</li>
                <li>• Other regions: 3-10 business days</li>
              </ul>
            </div>

            <div class="border-l-4 border-primary dark:border-white pl-6">
              <h4 class="text-primary dark:text-white uppercase tracking-wide mb-2">Clearance Delays</h4>
              <ul class="text-secondary dark:text-gray-400 text-sm space-y-1">
                <li>• Incomplete documentation</li>
                <li>• Random customs inspections</li>
                <li>• High volume periods</li>
                <li>• Disputed valuations</li>
                <li>• Unpaid duties or taxes</li>
              </ul>
            </div>
          </div>
        </section>

        {{-- Final Notes --}}
        <div class="border-t-2 border-primary dark:border-white pt-8 mt-8">
          <h3 class="text-xl text-primary dark:text-white uppercase tracking-wide mb-4">Need Assistance?</h3>
          <div class="bg-primary dark:bg-white text-white dark:text-gray-900 p-6">
            <p class="mb-2">For shipping inquiries or support:</p>
            <p class="text-sm opacity-90">
              <strong>Email:</strong> support@frameworksupply.co<br>
              <strong>Live Chat:</strong> 24/7 availability<br>
              <strong>Phone:</strong> Available 24/7
            </p>
          </div>

          <div class="mt-6 text-sm text-secondary dark:text-gray-400">
            <p><strong>Last Updated:</strong> January 19, 2026</p>
            <p><strong>Policy Version:</strong> 2.0</p>
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
  
  .shipping-content h2 {
    scroll-margin-top: 8rem;
  }
  
  .shipping-content ul li,
  .shipping-content .text-secondary,
  .shipping-content .dark\:text-gray-400 {
    text-align: justify;
  }
  
  .shipping-content table td {
    text-align: left;
  }
  
  /* Smooth scrolling */
  html {
    scroll-behavior: smooth;
  }
</style>
@endsection
