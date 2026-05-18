<x-guest-layout>
    <!-- Status da sessão -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST"
          action="{{ route('password.email') }}"
          class="flex flex-col gap-3">
        @csrf

        <!-- Título -->
        <div class="flex flex-col items-center gap-3 mb-6 text-center">
            <h1 class="text-2xl font-black tracking-tight
                       text-indigo-700 dark:text-indigo-400
                       leading-tight">
                Recuperar Senha
            </h1>

            <!-- Linha decorativa -->
            <div class="w-20 h-1 rounded-full
                        bg-gradient-to-r from-indigo-600 to-purple-500">
            </div>

            <!-- Descrição -->
            <p class="max-w-sm text-gray-600 dark:text-gray-300
                      text-sm md:text-base leading-relaxed">
                Informe seu email e enviaremos um link para redefinir sua senha
                com segurança.
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
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username" />
            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-between gap-4 pt-3">
            <a class="text-sm text-gray-600 transition hover:text-indigo-700 dark:text-gray-400 dark:hover:text-purple-400"
               href="{{ route('login') }}">
                Voltar ao login
            </a>

            <x-primary-button>
                {{ __('Enviar link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>