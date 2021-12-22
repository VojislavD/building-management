
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
                        href="./index.html"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span 
                            class="ml-3 transition duration-200" 
                            :class="linkHover ? 'text-gray-100' : ''"
                        >
                            Dashboard
                        </span>
                    </a>
                    <!-- end::Menu link -->

                    <p class="text-xs text-gray-600 mt-10 mb-2 px-6 uppercase">Apps</p>

                    <!-- start::Menu link -->
                    <div
                        x-data="{ linkHover: false, linkActive: false }"
                    >
                        <div 
                            @mouseover = "linkHover = true"
                            @mouseleave = "linkHover = false"
                            @click = "linkActive = !linkActive"
                            class="flex items-center justify-between text-gray-400 hover:text-gray-100 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                            :class=" linkActive ? 'bg-black bg-opacity-30 text-gray-100' : ''"
                        >
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class=" linkHover || linkActive ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="ml-3">Invoice (soon)</span>
                            </div>
                            <svg class="w-3 h-3 transition duration-300" :class="linkActive ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                        <!-- start::Submenu -->
                        <ul
                            x-show="linkActive"
                            class="text-gray-400"
                        >
                            <!-- start::Submenu link -->
                            <li class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                                <a 
                                    href="#"
                                    class="flex items-center"
                                >
                                    <span class="mr-2 text-sm">&bull;</span>
                                    <span class="overflow-ellipsis">Link 1</span>
                                </a>
                            </li>
                            <!-- end::Submenu link -->

                            <!-- start::Submenu link -->
                            <li class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                                <a 
                                    href="#"
                                    class="flex items-center"
                                >
                                    <span class="mr-2 text-sm">&bull;</span>
                                    <span class="overflow-ellipsis">Link 1</span>
                                </a>
                            </li>
                            <!-- end::Submenu link -->

                            <!-- start::Submenu link -->
                            <li class="pl-10 pr-6 py-2 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200 hover:text-gray-100">
                                <a 
                                    href="#"
                                    class="flex items-center"
                                >
                                    <span class="mr-2 text-sm">&bull;</span>
                                    <span class="overflow-ellipsis">Link 1</span>
                                </a>
                            </li>
                            <!-- end::Submenu link -->
                        </ul>
                        <!-- end::Submenu -->
                    </div>
                    <!-- end::Menu link -->

                    <!-- start::Menu link -->
                    <a 
                        x-data="{ linkHover: false }"
                        @mouseover = "linkHover = true"
                        @mouseleave = "linkHover = false"
                        href="#"
                        class="flex items-center text-gray-400 px-6 py-3 cursor-pointer hover:bg-black hover:bg-opacity-30 transition duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition duration-200" :class="linkHover ? 'text-gray-100' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span 
                            class="ml-3 transition duration-200" 
                            :class="linkHover ? 'text-gray-100' : ''"
                        >
                            Calendar (soon)
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
                            <!-- start::Search input -->
                            <form class="relative">
                                <input 
                                    type="text" 
                                    placeholder="Search..."
                                    class="w-48 lg:w-72 bg-gray-200 text-sm py-2 pl-4 rounded-lg focus:ring-0 focus:outline-none"
                                >
                                <button class="absolute right-2 top-2.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </button>
                            </form>
                            <!-- end::Search input -->

                            <!-- start::Notifications -->
                            <div 
                            x-data="{ linkActive: false }"
                                class="relative mx-6"
                            >
                                <!-- start::Main link -->
                                <div 
                                    @click="linkActive = !linkActive"
                                    class="cursor-pointer flex"
                                >
                                    <svg class="w-6 h-6 cursor-pointer hover:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                                    <sub>
                                        <span class="bg-red-600 text-gray-100 px-1.5 py-0.5 rounded-full -ml-1 animate-pulse">
                                            4
                                        </span>
                                    </sub>
                                </div>
                                <!-- end::Main link -->
                                
                                <!-- start::Submenu -->
                                <div 
                                    x-show="linkActive"
                                    @click.away="linkActive = false"
                                    x-cloak
                                    class="absolute right-0 w-96 top-11"
                                >
                                    <!-- start::Submenu content -->
                                    <div class="bg-white rounded max-h-96 overflow-y-scroll custom-scrollbar">
                                        <!-- start::Submenu header -->
                                        <div class="flex items-center justify-between px-4 py-2">
                                            <span class="font-bold">Notifications</span>
                                            <span class="text-xs px-1.5 py-0.5 bg-red-600 text-gray-100 rounded">
                                                4 new
                                            </span>
                                        </div>
                                        <hr>
                                        <!-- end::Submenu header -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Order Completed</p>
                                                    <p class="text-xs">Your order is completed</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold">
                                                5 min ago
                                            </span>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <img 
                                                    src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAAyADIDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD7dsvD/nBS4UnH41qR+GYRlnIHGenP0rweH9tf4X2kQZ/E9kRjosyk/wA6h8TftxfDybwhrD6Jrdvf6ulnLJbWkUg3SSKhIH5j9K8WOMSWif3M6/qrk7afecd+0p+2Tovwa1aXRdC05fEGpQHbcyNLshhb+5kAlmHfGAPzFeLWv/BSiay8VR2mt+F7L+zJCvy28jrNHnH8ZypPPoPwrm/Afw2fUtLl8ceOfs8cVy7SWz37KiHJzuUMeh9TyepNO+I3wt8N+MfD9zPaRWc3mx7kurMqcEDqGXrTo432jO2pl6hHR6n3P4J8UeHvip4TtvEGgzC5sLjIO4bXicfeRx2YZ/qMgg1X1zw1DIGJQYr4C/Zb/aKT4B2mtJqSz3+kTwRebbxDLJPG5TzACe69foPSvcrj/goR4B1BHKxXkbYz80LdfTgV1SrT+yrnmexhF2k0j1V/CcG9v3Xf0FFeCH9vLwexJ8i4Gef9WaKy9tV/lZfsqP8AMj897O8KsBng177+ytpcFx4wl1K+uoLK0t7eXfdXJxGm5di556Fm5zx68E185QKd2Tzz0r6D+GdjDpPwb8S3N4fKfVYhZxLn+Etwf++mH5/SrzKSWHce+n3k5XT/ANqjJfZ1+4+2/wBoDwJZ+PPCNhbaVr0ulWEFunlR28myPGwYPHUY56183+P/AIY3vwv+DcE2ias899ql4We8hYqfL2knHqeMbq9I+FeqXHxY+DvhCe0liF7Z20drfQ3ALqRAPLJKggkNtB4PevCvjh4wv7PUpRfadBafZw6x+WssCLxjiNshicDnNeFgnKL9k18L1PscTGEqbq3smjxdriWGEQTzMxl3mVtxJJwWOTXOtdIryLANqjr6mtPT7gardWyyYSSZ/L3N6ujDP8quWHg650+8maaNXi2kZbp9a+lUlFa7nw9WLlK62OUa6+Y/u+9FdN5c68CO3I9cdaKfOuxhys5zw9pt3rmpQWVhZz6hezHbFb26GR3PoFHJr6M1T4X+MrzQfCfhmKwW3OoFJYplmSQSv+9bZ8hOGX7O3HbbzWjpeh2fwf0BxZLEdY8I+ILG/wBTv4VxJeWE8KAMG67A0j4Xp3NdL4U8THwR4k0rTbiQ/Z/DPjNbvfy2zT50lcPx2H2lyT2ANdFTBxxCi5PbU0o4p4WUuVb6E/wJuB4b+EtjNbT4fy5N7AkMjEkkH0INfPXxBuNa+JXjJIdR1Oa4tYpGLSTHIjiHJPvxmvUmgfw6t/bWrSf2Tq1zdzabcL/qrmAzFo5F7jKSRnBAPNcX8RdCl0vQRJYxM3mj/S2/iC/4Z5NeF7B4atK27Ppo1VicPG+y3XoeT6pcLHeSy2ZKxw3CtEf90HBr0zUrqT7KrTbSkirIjL/ErKCP0Iryy9Agt4rc/wCtb52B6g+n9fxrv/CPnSeEY7VGE8d5JlWkYloZIQw2D0DeauPevS9kpwXkeE52k13Mz7Oi8edjHbNFUGtyzE7j+dFRy+ZhzPse4a+7SSXAZiwm+F6PLk53soG0t6kYGM9MVoaeS3xe0HJz5un2Ykz/AB50+9zn16D8qKK96nscNTcztJUSeB/hi7gO4sL1QzckAXTADPoBxXUMimWMbR0Pb2oorwcZ/FXyPpcv/wB3fzPj7VGLaheknJ85ufxaut+E/wC88VW8TfNEbiHKHleZEzx+A/Kiiu+OyPIluyzffLe3AHAEjYH4miiiuYk//9k="
                                                    class="w-8 rounded-full"
                                                >
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Maria sent you a message</p>
                                                    <p class="text-xs">Hey there, how are you do...</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold">
                                                30 min ago
                                            </span>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Order Completed</p>
                                                    <p class="text-xs">Your order is completed</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold">
                                                54 min ago
                                            </span>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <img 
                                                    src="data:image/jpeg;base64,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"
                                                    class="w-8 rounded-full"
                                                >
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Maria sent you a message</p>
                                                    <p class="text-xs">Hey there, how are you do...</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold">
                                                1 hour ago
                                            </span>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Order Completed</p>
                                                    <p class="text-xs">Your order is completed</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold">
                                                15 hours ago
                                            </span>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <img 
                                                    src="data:image/jpeg;base64,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"
                                                    class="w-8 rounded-full"
                                                >
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Maria sent you a message</p>
                                                    <p class="text-xs">Hey there, how are you do...</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold">
                                                12 day ago
                                            </span>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-8 h-8 bg-primary bg-opacity-20 text-primary px-1.5 py-0.5 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Order Completed</p>
                                                    <p class="text-xs">Your order is completed</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold">
                                                3 months ago
                                            </span>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-4 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <img 
                                                    src="data:image/jpeg;base64,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"
                                                    class="w-8 rounded-full"
                                                >
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Maria sent you a message</p>
                                                    <p class="text-xs">Hey there, how are you do...</p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold">
                                                10 months ago
                                            </span>
                                        </a>
                                        <!-- end::Submenu link -->
                                    </div>
                                    <!-- end::Submenu content -->
                                </div>
                                <!-- end::Submenu -->
                            </div>
                            <!-- end::Notifications -->

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
                                    <img 
                                        src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAAyADIDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD7dsvD/nBS4UnH41qR+GYRlnIHGenP0rweH9tf4X2kQZ/E9kRjosyk/wA6h8TftxfDybwhrD6Jrdvf6ulnLJbWkUg3SSKhIH5j9K8WOMSWif3M6/qrk7afecd+0p+2Tovwa1aXRdC05fEGpQHbcyNLshhb+5kAlmHfGAPzFeLWv/BSiay8VR2mt+F7L+zJCvy28jrNHnH8ZypPPoPwrm/Afw2fUtLl8ceOfs8cVy7SWz37KiHJzuUMeh9TyepNO+I3wt8N+MfD9zPaRWc3mx7kurMqcEDqGXrTo432jO2pl6hHR6n3P4J8UeHvip4TtvEGgzC5sLjIO4bXicfeRx2YZ/qMgg1X1zw1DIGJQYr4C/Zb/aKT4B2mtJqSz3+kTwRebbxDLJPG5TzACe69foPSvcrj/goR4B1BHKxXkbYz80LdfTgV1SrT+yrnmexhF2k0j1V/CcG9v3Xf0FFeCH9vLwexJ8i4Gef9WaKy9tV/lZfsqP8AMj897O8KsBng177+ytpcFx4wl1K+uoLK0t7eXfdXJxGm5di556Fm5zx68E185QKd2Tzz0r6D+GdjDpPwb8S3N4fKfVYhZxLn+Etwf++mH5/SrzKSWHce+n3k5XT/ANqjJfZ1+4+2/wBoDwJZ+PPCNhbaVr0ulWEFunlR28myPGwYPHUY56183+P/AIY3vwv+DcE2ias899ql4We8hYqfL2knHqeMbq9I+FeqXHxY+DvhCe0liF7Z20drfQ3ALqRAPLJKggkNtB4PevCvjh4wv7PUpRfadBafZw6x+WssCLxjiNshicDnNeFgnKL9k18L1PscTGEqbq3smjxdriWGEQTzMxl3mVtxJJwWOTXOtdIryLANqjr6mtPT7gardWyyYSSZ/L3N6ujDP8quWHg650+8maaNXi2kZbp9a+lUlFa7nw9WLlK62OUa6+Y/u+9FdN5c68CO3I9cdaKfOuxhys5zw9pt3rmpQWVhZz6hezHbFb26GR3PoFHJr6M1T4X+MrzQfCfhmKwW3OoFJYplmSQSv+9bZ8hOGX7O3HbbzWjpeh2fwf0BxZLEdY8I+ILG/wBTv4VxJeWE8KAMG67A0j4Xp3NdL4U8THwR4k0rTbiQ/Z/DPjNbvfy2zT50lcPx2H2lyT2ANdFTBxxCi5PbU0o4p4WUuVb6E/wJuB4b+EtjNbT4fy5N7AkMjEkkH0INfPXxBuNa+JXjJIdR1Oa4tYpGLSTHIjiHJPvxmvUmgfw6t/bWrSf2Tq1zdzabcL/qrmAzFo5F7jKSRnBAPNcX8RdCl0vQRJYxM3mj/S2/iC/4Z5NeF7B4atK27Ppo1VicPG+y3XoeT6pcLHeSy2ZKxw3CtEf90HBr0zUrqT7KrTbSkirIjL/ErKCP0Iryy9Agt4rc/wCtb52B6g+n9fxrv/CPnSeEY7VGE8d5JlWkYloZIQw2D0DeauPevS9kpwXkeE52k13Mz7Oi8edjHbNFUGtyzE7j+dFRy+ZhzPse4a+7SSXAZiwm+F6PLk53soG0t6kYGM9MVoaeS3xe0HJz5un2Ykz/AB50+9zn16D8qKK96nscNTcztJUSeB/hi7gO4sL1QzckAXTADPoBxXUMimWMbR0Pb2oorwcZ/FXyPpcv/wB3fzPj7VGLaheknJ85ufxaut+E/wC88VW8TfNEbiHKHleZEzx+A/Kiiu+OyPIluyzffLe3AHAEjYH4miiiuYk//9k="
                                        class="w-10 rounded-full"
                                    >
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
                                            href="#"
                                            class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Profile</p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >
                                                        Inbox
                                                        <span class="bg-red-600 text-gray-100 text-xs px-1.5 py-0.5 ml-2 rounded">15</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- end::Submenu link -->
                                        <!-- start::Submenu link -->
                                        <a 
                                            x-data="{ linkHover: false }"
                                            href="#"
                                            class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                <div class="text-sm ml-3">
                                                    <p 
                                                        class="text-gray-600 font-bold capitalize"
                                                        :class=" linkHover ? 'text-primary' : ''"
                                                    >Settings</p>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- end::Submenu link -->
                                        
                                        <hr>

                                        <!-- start::Submenu link -->
                                        <form
                                            method=""
                                            action=""
                                            x-data="{ linkHover: false }"
                                            class="flex items-center justify-between py-2 px-3 hover:bg-gray-100 bg-opacity-20"
                                            @mouseover="linkHover = true"
                                            @mouseleave="linkHover = false"
                                        >
                                            <div class="flex items-center">
                                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                                <button 
                                                    class="text-sm ml-3 text-gray-600 font-bold capitalize"
                                                    :class=" linkHover ? 'text-primary' : ''"
                                                >
                                                    Log out
                                                </button>
                                            </div>
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
