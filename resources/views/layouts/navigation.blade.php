<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT SIDE --}}
            <div class="flex">

                {{-- BRAND --}}
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">
                        📚 BiblioLite
                    </a>
                </div>

                {{-- NAV LINKS --}}
                <div class="hidden sm:flex sm:ml-10 space-x-6">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link href="/admin" :active="request()->is('admin')">
                            Admin Panel
                        </x-nav-link>

                        <x-nav-link href="/books" :active="request()->is('books*')">
                            Books
                        </x-nav-link>

                        <x-nav-link href="/reservations" :active="request()->is('reservations*')">
                            Reservations
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role === 'user')
                        <x-nav-link href="/dashboard" :active="request()->is('dashboard')">
                            Catalogue
                        </x-nav-link>

                        <x-nav-link href="/my-loans" :active="request()->is('my-loans')">
                            My Loans
                        </x-nav-link>
                    @endif

                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="hidden sm:flex sm:items-center sm:space-x-4">

                <span class="text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                            ▼
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- MOBILE --}}
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="text-gray-500">
                    ☰
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden px-4 pb-3 space-y-2">

        <x-responsive-nav-link :href="route('dashboard')">
            Dashboard
        </x-responsive-nav-link>

        @if(Auth::user()->role === 'admin')
            <x-responsive-nav-link href="/admin">
                Admin Panel
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/books">
                Books
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/reservations">
                Reservations
            </x-responsive-nav-link>
        @endif

        @if(Auth::user()->role === 'user')
            <x-responsive-nav-link href="/my-loans">
                My Loans
            </x-responsive-nav-link>
        @endif

        <x-responsive-nav-link :href="route('profile.edit')">
            Profile
        </x-responsive-nav-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();">
                Log Out
            </x-responsive-nav-link>
        </form>

    </div>
</nav>