<!DOCTYPE html>
<html lang="en" class="{{ isset($_COOKIE['header_visited']) ? 'no-header-anim' : '' }}">
<head>
    <title>@yield('title', 'FRAMEWORK Supply Co. - Premium Streetwear')</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Apply theme immediately to prevent flash
        (function() {
            try {
                const theme = localStorage.getItem('eshop-theme') || 'light';
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            } catch {}
        })();

        // Set visited cookie for next request logic
        (function() {
            if (!document.cookie.split('; ').find(row => row.startsWith('header_visited='))) {
                document.cookie = "header_visited=true; path=/; max-age=31536000"; // 1 year
            }
        })();

        // Route Protection Logic (Client-side)
        (function() {
            const protectedRoutes = ['/checkout', '/orders'];
            const currentPath = window.location.pathname;
            
            // Check if current path matches any protected route
            if (protectedRoutes.some(route => currentPath.startsWith(route))) {
                try {
                    const user = localStorage.getItem('eshop_user');
                    if (!user || !JSON.parse(user).session_token) {
                        // User not logged in, redirect to home
                        window.location.href = '/';
                    }
                } catch (e) {
                    // Start fresh if storage is corrupted
                    localStorage.removeItem('eshop_user');
                    window.location.href = '/';
                }
            }
        })();

    </script>
    @stack('head')
</head>
<body class="bg-background dark:bg-gray-900 min-h-screen text-primary dark:text-white transition-colors duration-300">
    @include('components.navbar')
    @include('components.modal-template')

    <div id="page-content" class="page-transition">
        @yield('content')
    </div>

    @if(!request()->routeIs('checkout') && !request()->routeIs('account') && !request()->routeIs('orders'))
        @include('components.footer')
    @endif


    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
