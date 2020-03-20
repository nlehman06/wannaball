<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.0.1/dist/alpine.js" defer></script>
</head>
<body class="antialiased bg-gray-100">

<div>
    <nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="/">
                            <img class="h-8 w-8" src="/img/logos/basketball.svg" alt=""/>
                        </a>
                    </div>
                    @auth
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline">
                                <a href="{{ route('home') }}"
                                   class="px-3 py-2 rounded-md text-sm font-medium @if(request()->is('home')) text-white bg-gray-900 @else text-gray-300 hover:text-white hover:bg-gray-700 @endif focus:outline-none focus:text-white focus:bg-gray-700">Dashboard</a>
                                <a href="{{ route('league.index') }}"
                                   class="ml-4 px-3 py-2 rounded-md text-sm font-medium @if(request()->is('league/*')) text-white bg-gray-900 @else text-gray-300 hover:text-white hover:bg-gray-700 @endif focus:outline-none focus:text-white focus:bg-gray-700">Leagues</a>
                                <a href="#"
                                   class="ml-4 px-3 py-2 rounded-md text-sm font-medium @if(request()->is('meet/*')) text-white bg-gray-900 @else text-gray-300 hover:text-white hover:bg-gray-700 @endif focus:outline-none focus:text-white focus:bg-gray-700">Meets</a>
                                <a href="#"
                                   class="ml-4 px-3 py-2 rounded-md text-sm font-medium @if(request()->is('stats')) text-white bg-gray-900 @else text-gray-300 hover:text-white hover:bg-gray-700 @endif focus:outline-none focus:text-white focus:bg-gray-700">Stats</a>
                            </div>
                        </div>
                    @endauth
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        @guest
                            <a class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                               href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="ml-4 px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                                   href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <button
                                class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                            </button>
                            <div @click.away="open = false" class="ml-3 relative" x-data="{ open: false }">
                                <div>
                                    <button @click="open = !open"
                                            class="max-w-xs flex items-center text-sm rounded-full text-white focus:outline-none focus:shadow-solid">
                                        <img class="h-8 w-8 rounded-full"
                                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                             alt=""/>
                                    </button>
                                </div>
                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                                    <div class="py-1 rounded-md bg-white shadow-xs">
                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your
                                            Profile</a>
                                        <a href="#"
                                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                        <a
                                            href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        >Sign out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              class="hidden">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <button @click="open = !open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden">
            @guest
                <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                   href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                       href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @else
                <div class="px-2 pt-2 pb-3 sm:px-3">
                    <a href="{{ route('home') }}"
                       class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Dashboard</a>
                    <a href="{{ route('league.index') }}"
                       class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Leagues</a>
                    <a href="#"
                       class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Meets</a>
                    <a href="#"
                       class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Stats</a>
                </div>
                <div class="pt-4 pb-3 border-t border-gray-700">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full"
                                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                 alt=""/>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}</div>
                            <div
                                class="mt-1 text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 px-2">
                        <a href="#"
                           class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Your
                            Profile</a>
                        <a href="#"
                           class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700">Settings</a>
                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"
                        >Sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </nav>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
             role="alert">
            {{ session('status') }}
        </div>
    @endif
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
