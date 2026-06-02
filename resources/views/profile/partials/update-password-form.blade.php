<section>
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            {{ __('Atualizar Senha') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Garanta que sua conta esteja usando uma senha longa e aleatória para maior segurança.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Senha Atual -->
        <div class="space-y-1.5">
            <x-input-label
                for="update_password_current_password"
                :value="__('Senha atual')"
            />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-lock-keyhole class="w-5 h-5" />
                </span>

                <x-text-input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    autocomplete="current-password"
                    class="mt-1 block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                />
            </div>

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />
        </div>

        <!-- Nova Senha -->
        <div class="space-y-1.5">
            <x-input-label
                for="update_password_password"
                :value="__('Nova senha')"
            />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-key-round class="w-5 h-5" />
                </span>

                <x-text-input
                    id="update_password_password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    class="mt-1 block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                />
            </div>

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Confirmar Senha -->
        <div class="space-y-1.5">
            <x-input-label
                for="update_password_password_confirmation"
                :value="__('Confirmar senha')"
            />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-shield-check class="w-5 h-5" />
                </span>

                <x-text-input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    class="mt-1 block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                />
            </div>

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        <!-- Ações -->
        <div class="flex items-center gap-4 pt-2">
            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded bg-gray-950 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-gray-800 transition"
            >
                <x-lucide-key-round class="w-4 h-4" />
                {{ __('Salvar senha') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >
                    {{ __('Salvo.') }}
                </p>
            @endif
        </div>
    </form>
</section>