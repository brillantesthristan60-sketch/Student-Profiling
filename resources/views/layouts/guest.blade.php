<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                font-family: 'Instrument Sans', sans-serif;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-container {
                width: min(90vw, 400px);
                margin: 0 auto;
            }

            .modern-card {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                border-radius: 16px;
                padding: 2rem;
            }

            .modern-input {
                border: 1px solid #e0e0e0;
                background: #f9f9f9;
                border-radius: 8px;
                transition: all 0.3s ease;
                padding: 0.75rem 1rem;
                width: 100%;
                font-size: 0.875rem;
                font-weight: 500;
            }

            .modern-input:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                background: #ffffff;
            }

            .modern-button {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: #ffffff;
                border: none;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
                padding: 0.75rem 1rem;
                width: 100%;
                font-size: 0.875rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.05em;
            }

            .modern-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            }

            .switch-link {
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
            }

            .switch-link:hover {
                text-decoration: underline;
            }

            .tab-title {
                font-size: 1.5rem;
                font-weight: 700;
                text-align: center;
                margin-bottom: 2rem;
                color: #333;
            }

            .form-label {
                display: block;
                text-xs;
                font-weight: 600;
                uppercase;
                tracking-wider;
                text-gray-700;
                margin-bottom: 0.5rem;
            }

            @media (max-width: 640px) {
                .modern-card {
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body class="antialiased selection:bg-yellow-300 selection:text-black">
        <div class="login-container">
            <div class="modern-card">
                <div class="text-center mb-6">
                    <h2 class="tab-title">{{ $title ?? 'Login' }}</h2>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
