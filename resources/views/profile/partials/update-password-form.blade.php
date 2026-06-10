<section>
    <header>
        <h2 class="text-xl font-serif font-bold text-amber-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-2 text-sm text-amber-700">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-amber-900 font-medium" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="library-input mt-2" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-amber-900 font-medium" />
            <x-text-input id="update_password_password" name="password" type="password" class="library-input mt-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-amber-900 font-medium" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="library-input mt-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-3 pt-3">
            <button type="submit" class="library-btn-primary">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >✓ {{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>