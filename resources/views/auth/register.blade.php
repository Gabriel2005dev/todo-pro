<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf


        <div class="text-center mb-8">

            <h1 class="text-3xl font-extrabold text-purple-700">
                Crie sua Conta
            </h1>

            <p class="text-gray-600 dark:text-gray-300 text-lg mt-3">
                Organize suas tarefas de forma moderna e eficiente
            </p>

        </div>


    

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome completo')" />
            <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-purple-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </span>
                <x-text-input id="name" class="block mt-1 w-full pl-12" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />

    <div class="relative">

        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-purple-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-5">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5H4.5A2.25 2.25 0 0 0 2.25 6.75m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0l-7.5-4.615A2.25 2.25 0 0 1 2.25 6.993V6.75" />
            </svg>

        </span>

        <x-text-input id="email"
            class="block mt-1 w-full pl-12"
            type="email"
            name="email"
            :value="old('email')"
            required
            autocomplete="username" />

    </div>

    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">

    <x-input-label for="password" :value="__('Senha')" />

    <div class="relative">

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

        <x-text-input id="password"
            class="block mt-1 w-full pl-12"
            type="password"
            name="password"
            required
            autocomplete="new-password" />

    </div>

    <x-input-error :messages="$errors->get('password')" class="mt-2" />

</div>

<!-- Confirm Password -->
<div class="mt-4">

    <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />

    <div class="relative">

        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-purple-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-5">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12.75 11.25 15 15 9.75m6 2.25a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>

        </span>

        <x-text-input id="password_confirmation"
            class="block mt-1 w-full pl-12"
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password" />

    </div>

    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

</div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
