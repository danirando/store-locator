<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mappa Store</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <div class="relative min-h-screen flex items-center justify-center">
            
            <!-- Auth Links -->
            <div class="absolute top-0 right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        Log in
                    </a>
                @endauth
            </div>

            <!-- Main Content -->
            <div class="w-full">
                <h1 class="text-4xl font-bold text-center text-gray-800 dark:text-white mb-8 pt-6">
                    Mappa Store
                </h1>
                
                <!-- Store Map Component (Public) -->
                <div class="w-full px-4">
                    <livewire:store-map />
                </div>
                
                @auth
                <!-- Import Form Component Integration -->
                <div class="mt-8">
                     <livewire:import-stores />
                </div>
                @endauth
            </div>
        </div>
    </body>
</html>
