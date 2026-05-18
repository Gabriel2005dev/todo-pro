<x-guest-layout>
    <div class="flex flex-col gap-3">
        <!-- Título -->
        <div class="flex flex-col items-center gap-3 mb-6 text-center">
            <h1 class="text-2xl font-black tracking-tight
                       text-indigo-700 dark:text-indigo-400
                       leading-tight">
                Verifique seu Email
            </h1>

            <!-- Linha decorativa -->
            <div class="w-20 h-1 rounded-full
                        bg-gradient-to-r from-indigo-600 to-purple-500">
            </div>

            <!-- Descrição -->
            <p class="max-w-sm text-gray-600 dark:text-gray-300
                      text-sm md:text-base leading-relaxed">
                Enviamos um link de verificação para seu email. Clique nele para
                ativar sua conta e começar a usar o Todo Pro.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
                Um novo link de verificação foi enviado para o email informado no cadastro.
            </div>
        @endif

        <div class="rounded-md border border-indigo-100 bg-indigo-50/70 px-4 py-3 text-sm text-gray-600 dark:border-indigo-900/60 dark:bg-gray-900/50 dark:text-gray-300">
            Não recebeu o email? Solicite um novo link ou saia para entrar com outra conta.
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-between gap-4 pt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="text-sm text-gray-600 transition hover:text-indigo-700 dark:text-gray-400 dark:hover:text-purple-400">
                    Sair
                </button>
            </form>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <x-primary-button>
                    {{ __('Reenviar email') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>