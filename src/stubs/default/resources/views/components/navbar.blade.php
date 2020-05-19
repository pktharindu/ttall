<nav class="bg-white shadow-md sticky top-0" x-data="{ profileOpen: false, menuOpen:false }">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button @click="menuOpen = !menuOpen"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
                    aria-label="Main menu" aria-expanded="false">
                    <!-- Icon when menu is closed. -->
                    <svg :class="{ 'hidden': menuOpen, 'block': !menuOpen }" class="h-6 w-6" stroke="currentColor"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open. -->
                    <svg x-cloak :class="{ 'block': menuOpen, 'hidden': !menuOpen }" class="h-6 w-6"
                        stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0">
                    <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <a href="/"
                            class="flex font-bold hover:text-gray-700 items-center md:text-2xl text-gray-800 text-xl">
                            <x-logo class="h-8 lg:mr-3 mx-auto text-indigo-600 w-auto" />
                            <span class="hidden lg:block">{{ config('app.name') }}</span>
                        </a>
                    </div>
                </div>
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex">
                        <a href="#"
                            class="px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-600 bg-gray-100 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">{{ __('Dashboard') }}</a>
                        <a href="#"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-600 hover:bg-gray-100 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">{{ __('Team') }}</a>
                        <a href="#"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-600 hover:bg-gray-100 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">{{ __('Projects') }}</a>
                        <a href="#"
                            class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-600 hover:bg-gray-100 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out">{{ __('Calendar') }}</a>
                    </div>
                </div>
            </div>

            @if (Route::has('login'))
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                @auth
                <!-- Profile dropdown -->
                <div class="ml-3 relative">
                    <div>
                        <button @click="profileOpen = true"
                            class="flex text-sm border-2 border-gray-200 rounded-full focus:outline-none focus:border-gray-600 transition duration-150 ease-in-out"
                            id="user-menu" aria-label="User menu" aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full"
                                src="https://images.unsplash.com/photo-1477118476589-bff2c5c4cfbb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="" />
                        </button>
                    </div>

                    <div x-show="profileOpen" x-cloak @click.away="profileOpen = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                        <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                            aria-labelledby="user-menu">
                            <a href="#"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">{{ __('Profile') }}</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">{{ __('Settings') }}</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">{{ __('Sign Out') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>

                @else
                <div class="flex items-center">
                    <a href="#"
                        class="px-3 py-2 rounded-md text-sm font-semibold leading-5 text-gray-500 hover:bg-gray-100 focus:outline-none focus:text-gray-600 focus:bg-gray-100 transition duration-150 ease-in-out">{{ __('Log In') }}</a>
                    <a href="#"
                        class="bg-gray-500 duration-150 ease-in-out focus:bg-gray-100 focus:outline-none focus:text-gray-600 font-semibold hover:bg-gray-600 leading-5 ml-4 px-3 py-2 rounded-md text-sm text-white transition">{{ __('Sign Up') }}</a>
                </div>
                @endauth
            </div>
            @endif

        </div>
    </div>

    <!-- Mobile menu -->
    <div x-cloak :class="{ 'block': menuOpen, 'hidden': !menuOpen }" @click.away="menuOpen = false" class="sm:hidden">
        <div class="px-2 pt-2 pb-3">
            <a href="#"
                class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">{{ __('Dashboard') }}</a>
            <a href="#"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">{{ __('Team') }}</a>
            <a href="#"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">{{ __('Projects') }}</a>
            <a href="#"
                class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">{{ __('Calendar') }}</a>
        </div>
    </div>
</nav>