<x-guest-layout>

    <div class="mb-8 text-center">
        <h1 class="text-4xl font-serif font-bold text-amber-900">📚 BiblioLite</h1>
        <p class="text-amber-700 text-sm mt-2 font-medium">Welcome to Your Library</p>
        <p class="text-gray-600 text-xs mt-1">Sign in to access your library account</p>
    </div>

    <!-- Display validation errors if any -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Field -->
        <div>
            <x-input-label for="email" value="Email Address" class="text-amber-900 font-medium" />
            <x-text-input id="email" class="library-input mt-2"
                type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password Field -->
        <div>
            <x-input-label for="password" value="Password" class="text-amber-900 font-medium" />
            <x-text-input id="password" class="library-input mt-2"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-amber-300 text-amber-700 focus:ring-amber-500">
                <span class="text-sm text-gray-700">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-amber-700 hover:text-amber-900 text-sm font-medium transition" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button class="w-full library-btn-primary rounded-lg py-2.5 font-medium shadow-md hover:shadow-lg transition-all">
            Sign In
        </button>

    </form>

    <!-- Registration Link -->
    <div class="mt-6 text-center border-t border-amber-100 pt-6">
        <p class="text-gray-700 text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-amber-700 hover:text-amber-900 font-semibold transition">
                Create one
            </a>
        </p>
    </div>

</x-guest-layout>