<!DOCTYPE html>
<html lang="en" class="{{ isset($_COOKIE['header_visited']) ? 'no-header-anim' : '' }}">
<head>
    <title>@yield('title', 'FRAMEWORK Supply Co. - Premium Streetwear')</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    
    <!-- Dynamic Favicon -->
    <link id="favicon-light" rel="icon" type="image/png" href="{{ asset('favicon-light.png') }}" media="(prefers-color-scheme: light)">
    <link id="favicon-dark" rel="icon" type="image/png" href="{{ asset('favicon-dark.png') }}" media="(prefers-color-scheme: dark)">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        /* NProgress custom styling to match site design */
        #nprogress .bar {
            background: #111827 !important; /* primary color */
            height: 3px !important;
            z-index: 99999 !important;
        }
        
        #nprogress .peg {
            box-shadow: 0 0 10px #111827, 0 0 5px #111827 !important;
        }
        
        /* Dark mode support */
        .dark #nprogress .bar {
            background: #ffffff !important;
        }
        
        .dark #nprogress .peg {
            box-shadow: 0 0 10px #ffffff, 0 0 5px #ffffff !important;
        }
    </style>
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

        // Dynamic Favicon Switcher
        (function() {
            function updateFavicon(isDark) {
                const faviconLight = document.getElementById('favicon-light');
                const faviconDark = document.getElementById('favicon-dark');
                
                if (faviconLight && faviconDark) {
                    if (isDark) {
                        faviconLight.remove();
                        if (!document.getElementById('favicon-active')) {
                            const newFavicon = document.createElement('link');
                            newFavicon.id = 'favicon-active';
                            newFavicon.rel = 'icon';
                            newFavicon.type = 'image/png';
                            newFavicon.href = faviconDark.href;
                            document.head.appendChild(newFavicon);
                        }
                    } else {
                        const activeFavicon = document.getElementById('favicon-active');
                        if (activeFavicon) activeFavicon.remove();
                    }
                }
            }

            // Check system preference on load
            const theme = localStorage.getItem('eshop-theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            updateFavicon(theme === 'dark' || (!theme && prefersDark));

            // Listen for system preference changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                const currentTheme = localStorage.getItem('eshop-theme');
                if (!currentTheme) {
                    updateFavicon(e.matches);
                }
            });

            // Listen for theme storage changes (manual theme toggle)
            window.addEventListener('storage', function(e) {
                if (e.key === 'eshop-theme') {
                    updateFavicon(e.newValue === 'dark');
                }
            });

            // Listen for theme changes in the same window
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.attributeName === 'class') {
                        const isDark = document.documentElement.classList.contains('dark');
                        updateFavicon(isDark);
                    }
                });
            });
            observer.observe(document.documentElement, { attributes: true });
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
