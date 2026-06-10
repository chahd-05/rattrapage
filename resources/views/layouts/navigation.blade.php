<nav x-data="{ open: false }" class="bg-amber-50 border-b-2 border-amber-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT SIDE --}}
            <div class="flex">

                {{-- BRAND --}}
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-serif font-bold text-amber-900 hover:text-amber-700 transition">
                        📚 BiblioLite
                    </a>
                </div>

                {{-- NAV LINKS --}}
                <div class="hidden sm:flex sm:ml-12 space-x-8">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-amber-900 hover:text-amber-700">
                        Dashboard
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link href="/admin" :active="request()->is('admin')" class="text-amber-900 hover:text-amber-700">
                            Admin Panel
                        </x-nav-link>

                        <x-nav-link href="/books" :active="request()->is('books*')" class="text-amber-900 hover:text-amber-700">
                            📖 Books
                        </x-nav-link>

                        <x-nav-link href="/reservations" :active="request()->is('reservations*')" class="text-amber-900 hover:text-amber-700">
                            Reservations
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role === 'user')
                        <x-nav-link href="/dashboard" :active="request()->is('dashboard')" class="text-amber-900 hover:text-amber-700">
                            Catalogue
                        </x-nav-link>

                        <x-nav-link href="/my-loans" :active="request()->is('my-loans')" class="text-amber-900 hover:text-amber-700">
                            My Loans
                        </x-nav-link>
                    @endif

                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="hidden sm:flex sm:items-center sm:space-x-4">

                <span class="text-sm font-medium text-amber-900">
                    👤 {{ Auth::user()->name }}
                </span>

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="flex items-center text-sm text-amber-700 hover:text-amber-900 font-medium transition">
                            ⋮ Menu
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')" class="text-amber-900 hover:bg-amber-50">
                            ⚙️ Profile Settings
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="text-amber-900 hover:bg-amber-50"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Log Out
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- MOBILE --}}
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="text-amber-900 text-2xl hover:text-amber-700 transition">
                    ☰
                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden px-4 pb-3 space-y-2 bg-amber-100 border-t-2 border-amber-200">

        <x-responsive-nav-link :href="route('dashboard')" class="text-amber-900 hover:bg-amber-200">
            Dashboard
        </x-responsive-nav-link>

        @if(Auth::user()->role === 'admin')
            <x-responsive-nav-link href="/admin" class="text-amber-900 hover:bg-amber-200">
                Admin Panel
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/books" class="text-amber-900 hover:bg-amber-200">
                📖 Books
            </x-responsive-nav-link>

            <x-responsive-nav-link href="/reservations" class="text-amber-900 hover:bg-amber-200">
                Reservations
            </x-responsive-nav-link>
        @endif

        @if(Auth::user()->role === 'user')
            <x-responsive-nav-link href="/my-loans" class="text-amber-900 hover:bg-amber-200">
                My Loans
            </x-responsive-nav-link>
        @endif

        <x-responsive-nav-link :href="route('profile.edit')" class="text-amber-900 hover:bg-amber-200">
            Profile
        </x-responsive-nav-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-responsive-nav-link :href="route('logout')" class="text-amber-900 hover:bg-amber-200"
                onclick="event.preventDefault(); this.closest('form').submit();">
                Log Out
            </x-responsive-nav-link>
        </form>

    </div>
</nav>