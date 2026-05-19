<x-guest-layout>
    <form method="POST"
          action="{{ route('password.confirm') }}"
          class="flex flex-col gap-3">
        @csrf

        <!-- Título -->
        <div class="flex flex-col items-center gap-3 mb-6 text-center">
            <!-- Descrição -->
            <p class="max-w-sm text-gray-600 dark:text-gray-300
                      text-sm md:text-base leading-relaxed">
                Esta é uma área segura. Confirme sua senha para continuar
                protegendo sua conta.
            </p>
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
                    class="block w-full pl-12 pr-12"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password" />

                <!-- Mostrar senha -->
                <button type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 transition hover:text-indigo-700 dark:text-gray-400 dark:hover:text-purple-400">
                    <!-- Olho aberto -->
                    <svg id="eye-open"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="h-5 w-5 hidden">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178Z" />
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <!-- Olho fechado -->
                    <svg id="eye-closed"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         class="h-5 w-5">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Botão -->
        <div class="flex justify-end pt-3">
            <x-primary-button>
                {{ __('Confirmar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        } else {
            passwordInput.type = 'password';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        }
    }
</script>