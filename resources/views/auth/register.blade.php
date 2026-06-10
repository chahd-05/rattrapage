<x-guest-layout>

    <div class="mb-8 text-center">
        <h1 class="text-4xl font-serif font-bold text-amber-900">📚 BiblioLite</h1>
        <p class="text-amber-700 text-sm mt-2 font-medium">Join Our Library</p>
        <p class="text-gray-600 text-xs mt-1">Create your account to start exploring</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name Field -->
        <div>
            <x-input-label for="name" value="Full Name" class="text-amber-900 font-medium" />
            <x-text-input id="name" class="library-input mt-2"
                type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Field -->
        <div>
            <x-input-label for="email" value="Email Address" class="text-amber-900 font-medium" />
            <x-text-input id="email" class="library-input mt-2"
                type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password Field -->
        <div>
            <x-input-label for="password" value="Password" class="text-amber-900 font-medium" />
            <x-text-input id="password" class="library-input mt-2"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password Field -->
        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" class="text-amber-900 font-medium" />
            <x-text-input id="password_confirmation" class="library-input mt-2"
                type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Register Button -->
        <button class="w-full library-btn-primary rounded-lg py-2.5 font-medium shadow-md hover:shadow-lg transition-all">
            Create Account
        </button>

    </form>

    <!-- Login Link -->
    <div class="mt-6 text-center border-t border-amber-100 pt-6">
        <p class="text-gray-700 text-sm">
            Already have an account?
            <a href="{{ route('login') }}" class="text-amber-700 hover:text-amber-900 font-semibold transition">
                Sign in
            </a>
        </p>
    </div>

</x-guest-layout>