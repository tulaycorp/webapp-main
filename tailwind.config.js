import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#111827',
                    light: '#1e293b',
                },
                secondary: {
                    DEFAULT: '#64748b',
                    light: '#94a3b8',
                },
                background: {
                    DEFAULT: '#f8fafc',
                    dark: '#1a1a1a',
                },
                border: {
                    DEFAULT: '#e5e7eb',
                    dark: '#404040',
                }
            },
            fontFamily: {
                'impact': ['Impact', 'sans-serif'],
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            letterSpacing: {
                'tighter': '-0.05em',
                'wider': '0.05em',
                'widest': '0.2em',
                'ultra': '0.3em',
            },
            animation: {
                'fade-in': 'fadeIn 0.3s ease-out forwards',
                'slide-up': 'slideUp 0.6s ease-out forwards',
                'pulse-slow': 'pulse 2s ease-in-out infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': {
                        opacity: '0',
                        transform: 'translateY(20px)'
                    },
                    '100%': {
                        opacity: '1',
                        transform: 'translateY(0)'
                    },
                }
            },
            backdropBlur: {
                'lg': '16px',
            }
        },
    },
    plugins: [],
};
