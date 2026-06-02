<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST"
          action="{{ route('password.email') }}"
          class="flex flex-col gap-4">
        @csrf

        <!-- Cabeçalho -->
        <div class="flex flex-col items-center gap-3 mb-4 text-center">

            

            <p class="max-w-sm text-sm md:text-base leading-relaxed text-gray-600 dark:text-gray-300">
                Informe o email cadastrado e enviaremos um link para redefinir sua senha e recuperar o acesso à sua conta.
            </p>

        </div>

        <!-- Email -->
        <div class="space-y-1.5">

            <x-input-label
                for="email"
                :value="__('Email')"
            />

            <div class="relative">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-mail class="w-5 h-5" />
                </span>

                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    class="block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                />

            </div>

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>

        <!-- Informação -->
        <div
            class="flex items-start gap-3 rounded-lg border border-red-100 bg-red-50 px-4 py-3 text-sm text-gray-700 dark:border-red-900/30 dark:bg-red-950/20 dark:text-gray-300"
        >
            <x-lucide-info class="w-5 h-5 text-red-700 mt-0.5 shrink-0" />

            <span>
                Verifique também sua caixa de spam ou lixo eletrônico caso o email não apareça na caixa de entrada.
            </span>
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-between gap-4 pt-2">

            <a
                href="{{ route('login') }}"
                class="inline-flex items-center gap-2 rounded bg-gray-950 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-gray-800 transition"
            >
                <x-lucide-arrow-left class="w-4 h-4" />
                Voltar
            </a>

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-600 transition"
            >
                <x-lucide-send class="w-4 h-4" />
                Enviar Link
            </button>

        </div>

    </form>

</x-guest-layout>