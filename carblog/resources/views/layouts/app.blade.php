<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DriveMNL') }} - @yield('title', 'Automotive Excellence')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: calc(1.2em * 2);
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: calc(1.2em * 3);
        }
        

    </style>
</head>
<body class="min-h-screen bg-gray-900">
    @include('components.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('components.footer')
    
    <script>
        // Initialize Lucide icons with retry mechanism
        function initializeIcons() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            } else {
                // Retry after a short delay if lucide isn't loaded yet
                setTimeout(initializeIcons, 100);
            }
        }
        
        // Initialize icons when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeIcons();
            
            // Mobile menu toggle
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (menuButton && mobileMenu) {
                menuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    
                    // Update the icon
                    const icon = menuButton.querySelector('svg');
                    if (icon) {
                        if (mobileMenu.classList.contains('hidden')) {
                            icon.setAttribute('data-lucide', 'menu');
                        } else {
                            icon.setAttribute('data-lucide', 'x');
                        }
                        // Reinitialize the icon
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }
                });
            }
        });
        
        // Also initialize icons immediately if lucide is already loaded
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>
</html> 