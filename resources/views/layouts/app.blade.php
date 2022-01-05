
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <style>[x-cloak] { display: none !important; }</style>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div 
            x-data="{ menuOpen: false }" 
            class="flex min-h-screen custom-scrollbar"
        >
            <!-- start::Black overlay -->
            <div :class="menuOpen ? 'block' : 'hidden'" @click="menuOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>
            <!-- end::Black overlay -->

            <aside 
                :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" 
                class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 bg-secondary overflow-y-auto lg:translate-x-0 lg:inset-0 custom-scrollbar"
            >
                <!-- start::Logo -->
                <div class="flex items-center justify-center bg-black bg-opacity-30 h-16">
                    <h1 class="text-gray-100 text-lg font-bold uppercase tracking-widest">
                        Template
                    </h1>
                </div>
                <!-- end::Logo -->

                <!-- start::Navigation -->
                <nav class="py-10 custom-scrollbar">
                    <!-- start::Menu link -->
                    <a 
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('dashboard') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                        :class="{{ Route::is('dashboard') }} ? 'bg-black bg-opacity-30' : ''"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span 
                            class="ml-3 transition duration-200" 
                            :class="linkHover ? 'text-gray-100' : ''"
                        >
                            {{ __('Dashboard') }}
                        </span>
                    </a>
                    <!-- end::Menu link -->

                    <p class="text-xs text-gray-600 mt-10 mb-2 px-6 uppercase">Apps</p>

                    <!-- start::Menu link -->
                    <a 
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('buildings.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                        :class="{{ Request::segment(1) === 'buildings' }} ? 'bg-black bg-opacity-30' : ''"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        <span 
                            class="ml-3 transition duration-200" 
                            :class="linkHover ? 'text-gray-100' : ''"
                        >
                            {{ __('Buildings') }}
                        </span>
                    </a>
                    <!-- end::Menu link -->

                    <!-- start::Menu link -->
                    <a 
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('apartments.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                        :class="{{ Request::segment(1) === 'apartments' }} ? 'bg-black bg-opacity-30' : ''"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        <span 
                            class="ml-3 transition duration-200" 
                            :class="linkHover ? 'text-gray-100' : ''"
                        >
                            {{ __('Apartments') }}
                        </span>
                    </a>
                    <!-- end::Menu link -->

                    <!-- start::Menu link -->
                    <a 
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="{{ route('apartments.index') }}"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                        :class="{{ Request::segment(1) === 'apartments' }} ? 'bg-black bg-opacity-30' : ''"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        <span 
                            class="ml-3 transition duration-200" 
                            :class="linkHover ? 'text-gray-100' : ''"
                        >
                            {{ __('Issues') }}
                        </span>
                    </a>
                    <!-- end::Menu link -->
                </nav>
                <!-- end::Navigation -->
            </aside>

            <div class="lg:pl-64 w-full flex flex-col">
                <!-- start::Topbar -->
                <div class="flex flex-col">
                    <header class="flex justify-between items-center h-16 py-4 px-6 bg-white">
                        <!-- start::Mobile menu button -->
                        <div class="flex items-center">
                            <button 
                                @click="menuOpen = true" 
                                class="text-gray-500 hover:text-primary focus:outline-none lg:hidden transition duration-200"
                            >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            </button>
                        </div>
                        <!-- end::Mobile menu button -->

                        <!-- start::Right side top menu -->
                        <div class="flex items-center">
                            <!-- start::Profile -->
                            <div 
                                x-data="{ linkActive: false }"
                                class="relative"                      
                            >
                                <!-- start::Main link -->
                                <div 
                                    @click="linkActive = !linkActive"
                                    class="cursor-pointer"
                                >
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ Auth::user()->name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </div>
                                <!-- end::Main link -->
                                
                                <!-- start::Submenu -->
                                <div 
                                    x-show="linkActive"
                                    @click.away="linkActive = false"
                                    x-cloak
                                    class="absolute right-0 w-40 top-11"
                                >
                                    <!-- start::Submenu content -->
                                    <div class="bg-white rounded">
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="{{ route('profile.show') }}"
                                            class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >{{ __('Profile') }}</p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- end::Submenu link -->
                                        
                                        <hr>

                                        <!-- start::Submenu link -->
                                        <form
                                            method="POST"
                                            action="{{ route('logout') }}"
                                            x-data="{ linkHover: false }"
                                            class="flex items-center justify-between hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            @csrf

                                            <button 
                                                type="submit"
                                                class="flex items-center w-full py-2 px-3"
                                            >
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                                <span 
                                                    
                                                    class="text-sm ml-3 text-gray-600 font-bold capitalize"
                                                    :class=" linkHover ? 'text-primary' : ''"
                                                >
                                                    {{ __('Log out') }}
                                            </span>
                                            </button>
                                        </form>
                                        <!-- end::Submenu link -->
                                    </div>
                                    <!-- end::Submenu content -->
                                </div>
                                <!-- end::Submenu -->
                            </div>
                            <!-- end::Profile -->
                        </div>
                        <!-- end::Right side top menu -->
                    </header>
                </div>
                <!-- end::Topbar -->

                <!-- start:Page content -->
                <main class="h-full bg-gray-200 p-8">
                    {{ $slot }}
                </main>
                <!-- end:Page content -->
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
