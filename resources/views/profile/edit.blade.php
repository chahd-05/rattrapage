<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-serif font-bold text-amber-900">
            ⚙️ Profile Settings
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-amber-50 to-white min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-8 bg-white shadow rounded-lg border-l-4 border-amber-600">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white shadow rounded-lg border-l-4 border-blue-600">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white shadow rounded-lg border-l-4 border-red-600">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
