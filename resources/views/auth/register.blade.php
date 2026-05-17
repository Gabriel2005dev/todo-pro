<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Título -->
        <div class="text-center">

            <h1 class="text-2xl font-extrabold text-purple-700 dark:text-purple-400">
                Crie sua Conta
            </h1>

            <p class="text-gray-600 dark:text-gray-300 text-lg">
                Organize suas tarefas de forma moderna e eficiente
            </p>

        </div>
        

        <!-- Nome -->
        <div>

            <x-input-label for="name"
                :value="__('Nome completo')" />

            <div class="relative">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-purple-700 dark:text-purple-400">

                    <!-- Heroicon User -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-5 w-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                </span>

                <x-text-input
                    id="name"
                    class="block mt-1 w-full pl-12"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name" />

            </div>

            <x-input-error :messages="$errors->get('name')" class="mt-2" />

        </div>

        <!-- Email -->
        <div class="mt-4">

            <x-input-label for="email"
                :value="__('Email')" />

            <div class="relative">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-purple-700 dark:text-purple-400">

                    <!-- Heroicon Envelope -->
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
                    class="block mt-1 w-full pl-12"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="username" />

            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>

        <!-- Senha -->
<div class="mt-4">

    <x-input-label for="password" :value="__('Senha')" />

    <div class="relative">

        <!-- Ícone da esquerda -->
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-purple-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-5">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0 1 19.5 12.75v6A2.25 2.25 0 0 1 17.25 21h-10.5A2.25 2.25 0 0 1 4.5 18.75v-6A2.25 2.25 0 0 1 6.75 10.5Z" />
            </svg>

        </span>

        <!-- Input -->
        <x-text-input id="password"
            class="block mt-1 w-full pl-12 pr-12"
            type="password"
            name="password"
            required
            autocomplete="new-password" />

        <!-- Botão olho -->
        <!-- Botão olho -->
<button type="button"
    onclick="togglePassword()"
    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">

    <!-- Olho aberto -->
    <svg id="eye-open"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-5 hidden">

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
        

        <!-- Confirmar Senha -->
        <div class="mt-4">

            <x-input-label for="password_confirmation"
                :value="__('Confirmar senha')" />

            <div class="relative">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-purple-700 dark:text-purple-400">

                    <!-- Heroicon Shield Check -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="size-6"
                        >
                        <path d="M4.5 12.75 L10.5 18.75 L19.5 5.25" />
                    </svg>

                </span>

                <x-text-input
                    id="password_confirmation"
                    class="block mt-1 w-full pl-12"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password" />

            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        </div>

        <!-- Botões -->
        <div class="flex items-center justify-between mt-6">

            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-purple-700 dark:hover:text-purple-400 transition"
                href="{{ route('login') }}">

                Já possui conta?
            </a>

            <x-primary-button class="ms-4">
                {{ __('Cadastrar') }}
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