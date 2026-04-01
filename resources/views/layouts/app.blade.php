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
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                background: #f5f7fa !important;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif !important;
                min-height: 100vh;
            }

            .app-wrapper {
                display: flex;
                min-height: 100vh;
                background: #f5f7fa;
            }

            .app-sidebar {
                width: 240px;
                background: linear-gradient(135deg, #5b5bee 0%, #b85dd5 100%);
                padding: 2rem 1.5rem;
                color: white;
                position: fixed;
                height: 100vh;
                overflow-y: auto;
                z-index: 1000;
            }

            .sidebar-brand {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-size: 0.75rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1px;
                margin-bottom: 3rem;
                color: rgba(255, 255, 255, 0.9);
            }

            .sidebar-brand span {
                font-size: 1.5rem;
            }

            .sidebar-menu {
                list-style: none;
            }

            .sidebar-menu-item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.875rem 1rem;
                border-radius: 8px;
                margin-bottom: 0.5rem;
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                font-size: 0.875rem;
                font-weight: 500;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
            }

            .sidebar-menu-item:hover,
            .sidebar-menu-item.active {
                background: rgba(255, 255, 255, 0.2);
                color: white;
            }

            .sidebar-menu-item span {
                font-size: 1.25rem;
            }

            .app-content {
                flex-grow: 1;
                margin-left: 240px;
                padding: 2rem;
            }

            .page-header {
                background: white;
                border-radius: 12px;
                padding: 1.5rem 2rem;
                margin-bottom: 2rem;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            }

            .page-header h1 {
                font-size: 2rem;
                font-weight: 700;
                color: #333;
            }

            .page-header p {
                font-size: 0.875rem;
                color: #999;
                margin-top: 0.25rem;
            }

            @media (max-width: 768px) {
                .app-sidebar {
                    width: 60px;
                    padding: 1rem 0.5rem;
                }

                .app-content {
                    margin-left: 60px;
                    padding: 1rem;
                }

                .sidebar-brand,
                .sidebar-menu-item:not(.icon-only) {
                    display: none;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="app-wrapper">
            <!-- Sidebar -->
            <div class="app-sidebar">
                <div class="sidebar-brand">
                    <span>🎓</span>
                    <span>CCS</span>
                </div>

                <ul class="sidebar-menu">
                    <li><a href="{{ route('dashboard') }}" class="sidebar-menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><span>🏠</span><span>Dashboard</span></a></li>
                    <li><a href="{{ route('students.index') }}" class="sidebar-menu-item {{ request()->routeIs('students.*') ? 'active' : '' }}"><span>👥</span><span>Students</span></a></li>
                    <li><a href="{{ route('queries.index') }}" class="sidebar-menu-item {{ request()->routeIs('queries.*') ? 'active' : '' }}"><span>🔍</span><span>Search</span></a></li>
                    <li><a href="{{ route('profile.edit') }}" class="sidebar-menu-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"><span>⚙️</span><span>Settings</span></a></li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="app-content">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
</html>
