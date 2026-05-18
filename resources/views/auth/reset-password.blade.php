<x-guest-layout>
    <form method="POST"
          action="{{ route('password.store') }}"
          class="flex flex-col gap-3">
        @csrf

        <!-- Token de redefinição -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Título -->
        <div class="flex flex-col items-center gap-3 mb-6 text-center">
            <h1 class="text-2xl font-black tracking-tight
                       text-indigo-700 dark:text-indigo-400
                       leading-tight">
                Redefinir Senha
            </h1>

            <!-- Linha decorativa -->
            <div class="w-20 h-1 rounded-full
                        bg-gradient-to-r from-indigo-600 to-purple-500">
            </div>

            <!-- Descrição -->
            <p class="max-w-sm text-gray-600 dark:text-gray-300
                      text-sm md:text-base leading-relaxed">
                Crie uma nova senha para voltar a organizar suas tarefas com
                praticidade e segurança.
            </p>
        </div>

        <!-- Email -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email')" />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-indigo-700 dark:text-purple-400">
                    <!-- Ícone Email -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="h-5 w-5">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5H4.5A2.25 2.25 0 0 0 2.25 6.75m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615A2.25 2.25 0 0 1 2.25 6.993V6.75" />
                    </svg>
                </span>

                <x-text-input
                    id="email"
                    class="block w-full pl-12"
                    type="email"
                    name="email"
                    :value="old('email', $request->email)"
                    required
                    autofocus
                    autocomplete="username" />
            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div class="space-y-1.5">
            <x-input-label for="password" :value="__('Senha')" />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-indigo-700 dark:text-purple-400">
                    <!-- Ícone Senha -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="h-5 w-5">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21h-10.5A2.25 2.25 0 0 1 4.5 18.75v-6A2.25 2.25 0 0 1 6.75 10.5Z" />
                    </svg>
                </span>

                <x-text-input
                    id="password"
                    class="block w-full pl-12"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password" />
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Senha -->
        <div class="space-y-1.5">
            <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-indigo-700 dark:text-purple-400">
                    <!-- Ícone Confirmação -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.5"
                         stroke-linecap="round"
                         stroke-linejoin="round"
                         class="h-5 w-5">
                        <path d="M4.5 12.75 L10.5 18.75 L19.5 5.25" />
                    </svg>
                </span>

                <x-text-input
                    id="password_confirmation"
                    class="block w-full pl-12"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password" />
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botão -->
        <div class="flex justify-end pt-3">
            <x-primary-button>
                {{ __('Redefinir senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>