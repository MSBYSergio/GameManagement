<nav x-data="{ open: false }" class="bg-[#121212]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-24">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('index') }}">
                    <img src="{{Storage::url('images/circle.png')}}" width="40" height="40" alt="Logo de GameZone">
                    <a class="text-white fw-bold ms-3"> GameZone </a>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="space-x-8 hidden sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link href="{{route('shop')}}" :active="request()->routeIs('shop')">
                    <i class="fa-solid fa-bag-shopping mr-2"></i>Tienda
                </x-nav-link>

                <x-nav-link href="{{route('library')}}" :active="request()->routeIs('library')">
                    <i class="fa-solid fa-gamepad mr-2"></i>Biblioteca
                </x-nav-link>

                <x-nav-link href="{{route('chatify')}}" :active="request()->routeIs('chatify')">
                    <i class="fa-solid fa-user mr-2"></i>Chat
                </x-nav-link>

                <x-nav-link href="{{route('tags.index')}}" :active="request()->routeIs('tags.*')">
                    <i class="fa-solid fa-tags mr-2"></i>Tags
                </x-nav-link>

                <x-nav-link href="{{route('contact')}}" :active="request()->routeIs('contact')">
                    <i class="fa-solid fa-id-card-clip mr-2"></i>Contacto
                </x-nav-link>

            </div>

            <div class="hidden sm:flex sm:items-center m-auto sm:ms-6">
                @auth
                <!-- Settings Dropdown -->
                <div class="d-flex items-center gap-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>

                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}
                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    <a href="{{ route('shopping-cart') }}" class="position-relative d-inline-block">
                        <i class="fa-solid fa-cart-shopping text-success fs-4"></i>

                    </a>

                </div>
                @endauth
                @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                    @else
                    <div class="flex gap-4">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-gray-300 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Log In
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Register
                        </a>
                        @endif
                    </div>
                    @endauth
                </nav>
                @endif
            </div>

            <!-- Hamburger -->
            <div class="flex items-center m-auto sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-dark text-white">
        <div class="py-3 space-y-2 px-4">
            <a href="{{route('shop')}}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('shop') ? 'text-blue-400 border-l-4 border-blue-400' : '' }}">Tienda</a>
            <a href="{{route('library')}}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('library') ? 'text-blue-400 border-l-4 border-blue-400' : 'text-gray-300' }}">Biblioteca</a>
            <a href="{{route('chatify')}}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('chatify') ? 'text-blue-400 border-l-4 border-blue-400' : 'text-gray-300' }}">Chat</a>
            <a href="{{route('tags.index')}}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('tags.index') ? 'text-blue-400 border-l-4 border-blue-400' : 'text-gray-300' }}">Tags</a>
            <a href="{{route('shopping-cart')}}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('shopping-cart') ? 'text-blue-400 border-l-4 border-blue-400' : 'text-gray-300' }}">Carrito</a>
        </div>

        @auth
        <div class="border-t border-gray-700 mt-3 py-4 px-4 space-y-3">
            <div class="flex items-center space-x-3">
                <img src="{{ Auth::user()->profile_photo_url }}" class="size-10 rounded-full object-cover">
                <div>
                    <div class="font-medium text-white">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <a href="{{ route('profile.show') }}" class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('profile.show') ? 'text-blue-400' : 'text-gray-300' }}">Perfil</a>

            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" class="block w-full text-left py-2 px-3 rounded hover:bg-gray-700 text-gray-300 hover:text-red-400">Cerrar Sesión</button>
            </form>
        </div>
        @endauth
    </div>

</nav>