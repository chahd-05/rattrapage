<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800">📚 BiblioLite</h1>
        <p class="text-gray-500 text-sm mt-1">Login to your library account</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl"
                type="email" name="email"
                :value="old('email')" required autofocus />
        </div>

        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full rounded-xl"
                type="password" name="password" required />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" class="rounded">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-blue-600 hover:underline" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 transition">
            Login
        </button>

    </form>

</x-guest-layout>