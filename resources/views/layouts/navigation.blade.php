<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 navbar-custom">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <img src="{{ asset('parking.png') }}" alt="Logo" class="h-10 w-auto mr-2">
                        <span class="text-xl font-semibold text-primary">Parking</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="/mon-espace" :active="request()->is('mon-espace')" class="flex items-center">
                        <i class="fas fa-home mr-2"></i>
                        {{ __('Mon Espace') }}
                    </x-nav-link>

                    @can('creerUser', Auth::user())
                        <x-nav-link href="/places" :active="request()->is('places*')" class="flex items-center">
                            <i class="fas fa-parking mr-2"></i>
                            {{ __('Places') }}
                        </x-nav-link>

                        <x-nav-link href="/admin/" :active="request()->is('admin*')" class="flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            {{ __('Utilisateurs') }}
                        </x-nav-link>
                        
                        <x-nav-link href="/reservation/" :active="request()->is('reservation*')" class="flex items-center">
                            <i class="fas fa-list-alt mr-2"></i>
                            {{ __('Liste d\'attente') }}
                        </x-nav-link>

                        <x-nav-link href="/reservationprise/" :active="request()->is('reservationprise*')" class="flex items-center">
                            <i class="fas fa-calendar-check mr-2"></i>
                            {{ __('Réservations actives') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-gray-400 mr-2 text-lg"></i>
                                <span>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                            <i class="fas fa-user-cog mr-2"></i>
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                {{ __('Déconnexion') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/mon-espace" :active="request()->is('mon-espace')" class="flex items-center">
                <i class="fas fa-home mr-2"></i>
                {{ __('Mon Espace') }}
            </x-responsive-nav-link>

            @can('creerUser', Auth::user())
                <x-responsive-nav-link href="/places" :active="request()->is('places*')" class="flex items-center">
                    <i class="fas fa-parking mr-2"></i>
                    {{ __('Places') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="/admin/" :active="request()->is('admin*')" class="flex items-center">
                    <i class="fas fa-users mr-2"></i>
                    {{ __('Utilisateurs') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="/reservation/" :active="request()->is('reservation*')" class="flex items-center">
                    <i class="fas fa-list-alt mr-2"></i>
                    {{ __('Liste d\'attente') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link href="/reservationprise/" :active="request()->is('reservationprise*')" class="flex items-center">
                    <i class="fas fa-calendar-check mr-2"></i>
                    {{ __('Réservations actives') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center">
                    <i class="fas fa-user-cog mr-2"></i>
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        {{ __('Déconnexion') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
