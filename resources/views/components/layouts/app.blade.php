<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php
        $appMenu = new App\Livewire\Backend\Share\Header();
    @endphp
    @foreach ($appMenu->menu as $item)
        @if ($item['routeName'] == Route::currentRouteName())
            @php
                $title = $item['title'] . ' - ' . config('app.name', '鬼谷系統管理');
            @endphp
        @endif
    @endforeach
    <title>{{ $title ?? config('app.name', '鬼谷系統管理') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/tinymce/tinymce.min.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        /* width and height of the scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background-color: #888888;
        }

        /* background color of the scrollbar */
        .dark ::-webkit-scrollbar-track {
            background-color: #000000;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #333333;
        }

        /* color of the scrollbar thumb */
        .dark ::-webkit-scrollbar-thumb {
            background-color: #333333;
        }

        /* color of the scrollbar thumb on hover */
        ::-webkit-scrollbar-thumb:hover {
            background-color: #222222;
            transition: all 1s ease-in-out;
        }
    </style>
</head>

<body class="font-sans antialiased" x-data x-cloak>
    <x-GDcms.banner />


    <div class="bg-zinc-100 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-300">
        <!-- Page Content -->
        <main class="min-h-screen">
            {{ $slot }}
        </main>
    </div>

    <div class="flex p-4 bg-white dark:bg-black">
        <div class="mx-auto max-w-7xl">
            <div class="flex justify-center space-x-6">
                <x-GDcms.copyright />
            </div>
        </div>
        <x-GDcms.theme-toggle />
    </div>

    @stack('modals')
    @stack('scripts')
    @livewireScripts
</body>

</html>
