<section>
    <header>
        <h2 class="text-gray-900 fs-3 font-weight-bold">
            {{ __('Mettre à jour le mot de passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester en sécurité.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-2">
            <x-input-label for="current_password" :value="__('Mot de passe actuel :')" style="margin-right: 56px"  />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full p-1" style="border-radius: 10px" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mb-2">
            <x-input-label for="password" :value="__('Nouveau mot de passe :')" style="margin-right: 36px" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full p-1" style="border-radius: 10px" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe :')" style="margin-right: 10px"/>
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full p-1" style="border-radius: 10px" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-3 mt-3">
            <x-primary-button style="background-color: rgb(82, 77, 233)!important;">{{ __('Sauvegarder') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
