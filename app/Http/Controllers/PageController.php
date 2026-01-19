<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Home page.
     */
    public function home(): View
    {
        return view('pages.home');
    }

    /**
     * About page.
     */
    public function about(): View
    {
        return view('pages.about');
    }

    /**
     * Contact page.
     */
    public function contact(): View
    {
        return view('pages.contact');
    }
    /**
     * Cart page.
     */
    public function cart(): View
    {
        return view('pages.cart');
    }

    /**
     * Privacy Policy page.
     */
    public function privacyPolicy(): View
    {
        return view('privacy-policy');
    }

    /**
     * Terms of Service page.
     */
    public function termsOfService(): View
    {
        return view('terms-of-service');
    }

    /**
     * Shipping Policy page.
     */
    public function shippingPolicy(): View
    {
        return view('shipping-policy');
    }
}
