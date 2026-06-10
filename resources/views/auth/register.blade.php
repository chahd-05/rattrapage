<x-guest-layout>

    <div class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800">📚 BiblioLite</h1>
        <p class="text-gray-500 text-sm mt-1">Create your library account</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" class="block mt-1 w-full rounded-xl"
                type="text" name="name"
                :value="old('name')" required autofocus />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl"
                type="email" name="email"
                :value="old('email')" required />
        </div>

        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full rounded-xl"
                type="password" name="password" required />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl"
                type="password" name="password_confirmation" required />
        </div>

        <button class="w-full bg-green-600 text-white py-2 rounded-xl hover:bg-green-700 transition">
            Register
        </button>

        <div class="text-center text-sm mt-3">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                Already have an account?
            </a>
        </div>

    </form>

</x-guest-layout>