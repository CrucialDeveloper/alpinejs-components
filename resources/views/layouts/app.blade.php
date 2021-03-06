<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token"
        content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"
        defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}"
        rel="stylesheet">
    @livewireStyles
    @stack('head')
</head>

<body class="h-screen antialiased leading-none text-gray-900 bg-gray-100">
    <div id="app"
        class="h-full">
        <nav class="sticky top-0 z-50 py-4 bg-blue-700 shadow">
            <div class="container px-6 mx-auto md:px-0">
                <div class="flex items-center justify-center">
                    <div class="mr-6">
                        <a href="{{ url('/') }}"
                            class="text-lg font-semibold text-gray-100 no-underline">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="flex items-center justify-end flex-1 text-right">
                        @guest
                        <a class="p-3 text-sm text-white no-underline hover:underline"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                        <a class="p-3 text-sm text-white no-underline hover:underline"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                        @else
                        <span
                            class="flex items-center justify-center w-8 h-8 text-sm text-white bg-gray-900 rounded-full">{{ auth()->user()->first_name[0] }}{{auth()->user()->last_name[0]}}</span>

                        <a href="{{ route('logout') }}"
                            class="p-3 text-sm text-white no-underline hover:underline"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form"
                            action="{{ route('logout') }}"
                            method="POST"
                            class="hidden">
                            {{ csrf_field() }}
                        </form>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>