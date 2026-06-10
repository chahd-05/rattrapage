<section class="space-y-6">
    <header>
        <h2 class="text-xl font-serif font-bold text-red-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-2 text-sm text-red-700">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition"
    >{{ __('Delete Account') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-serif font-bold text-red-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-2 text-sm text-red-700">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="text-amber-900 font-medium" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="library-input mt-2"
                    placeholder="{{ __('Enter your password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="library-btn-secondary"
                >
                    {{ __('Cancel') }}
                </button>

                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition"
                >
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
