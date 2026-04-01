<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Welcome</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Instrument Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .welcome-container {
            text-align: center;
            color: white;
            max-width: 600px;
            padding: 2rem;
        }

        .welcome-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .welcome-subtitle {
            font-size: 1.25rem;
            font-weight: 500;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .welcome-button {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            border-radius: 8px;
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .welcome-button:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .brand-text {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.875rem;
            font-weight: 600;
            opacity: 0.7;
        }

        @media (max-width: 640px) {
            .welcome-title {
                font-size: 2rem;
            }
            .welcome-subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1 class="welcome-title">Welcome to CCS</h1>
        <p class="welcome-subtitle">Comprehensive Student Profiling System</p>
        <a href="{{ route('login') }}" class="welcome-button">Get Started</a>
    </div>
    <div class="brand-text">CCS Comprehensive Profiling</div>
</body>
</html>
