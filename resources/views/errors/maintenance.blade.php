<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance | FRAMEWORK Supply Co.</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom Theme Configuration from app.css */
        :root {
            --font-sans: 'Inter', ui-sans-serif, system-ui, sans-serif;
            --font-impact: Impact, 'Arial Black', sans-serif;
            --color-primary: #111827; 
            --color-secondary: #64748b;
            --color-background: #f8fafc;
        }

        .font-sans { font-family: var(--font-sans); }
        .font-impact { font-family: var(--font-impact); }
        
        .animate-pulse-slow { animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        
        @keyframes slide-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-slide-up {
            animation: slide-up 0.8s ease-out forwards;
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#111827',
                        secondary: '#64748b',
                        background: '#f8fafc',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        impact: ['Impact', 'Arial Black', 'sans-serif'],
                    },
                    letterSpacing: {
                        'ultra': '0.3em',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background text-primary flex items-center justify-center h-screen w-screen overflow-hidden p-6 font-sans antialiased selection:bg-primary selection:text-white">
    <div class="max-w-2xl w-full translate-y-0 opacity-100 transition-all duration-700 animate-slide-up flex flex-col justify-center h-full max-h-[800px]">
        
        {{-- Brand Header --}}
        <div class="text-center mb-8 border-b border-primary/10 pb-6 shrink-0">
            <div class="inline-flex flex-col leading-none mb-1">
                <span class="text-4xl sm:text-5xl tracking-[-0.05em] uppercase font-impact text-primary">FRAMEWORK</span>
                <span class="text-[10px] sm:text-xs tracking-ultra text-secondary uppercase text-right font-medium mt-1">Supply Co.</span>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="text-center space-y-6 grow flex flex-col justify-center">
            <div class="relative inline-block shrink-0">
                <div class="absolute inset-0 bg-gray-200 blur-xl opacity-50 rounded-full animate-pulse-slow"></div>
                <div class="relative w-16 h-16 border-2 border-primary flex items-center justify-center mx-auto bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                    </svg>
                </div>
            </div>

            <div>
                <h1 class="text-5xl sm:text-7xl font-impact uppercase tracking-[-0.02em] mb-2 text-primary">
                    System<br/><span style="-webkit-text-stroke: 1px currentColor; -webkit-text-fill-color: transparent;">Upgrade</span>
                </h1>
                
                <div class="flex items-center justify-center gap-3 text-xs sm:text-sm font-medium uppercase tracking-widest text-secondary mt-4">
                    <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                    <span>Calibration in Progress</span>
                    <span class="w-1.5 h-1.5 bg-primary rounded-full animate-pulse"></span>
                </div>
            </div>
            
            <p class="text-base sm:text-lg text-secondary max-w-md mx-auto leading-relaxed">
                Our digital artisans are currently enhancing the infrastructure. <br class="hidden sm:block"/>
                Preparing the storefront for the next improved experience.
            </p>
            
            <div class="pt-6">
                <div class="inline-flex items-center gap-4 sm:gap-6 border-t border-b border-primary py-2 px-6 uppercase text-[10px] sm:text-xs font-bold tracking-widest text-primary">
                    <span>Est. 2024</span>
                    <span class="w-1 h-1 bg-primary rounded-full"></span>
                    <span>Exclusive</span>
                    <span class="w-1 h-1 bg-primary rounded-full"></span>
                    <span>Quality</span>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-8 text-[10px] sm:text-xs text-secondary uppercase tracking-wider shrink-0">
            &copy; {{ date('Y') }} Framework Supply Co. All Rights Reserved.
        </div>
    </div>
</body>
</html>
