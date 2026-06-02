<x-guest-layout>
    <div class="flex flex-col gap-4">

        <!-- Cabeçalho -->
        <div class="flex flex-col items-center gap-3 mb-4 text-center">

            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-red-50 dark:bg-red-900/20">
                <x-lucide-mail-check class="w-8 h-8 text-red-700" />
            </div>

            <h1 class="text-2xl font-black tracking-tight text-red-700">
                Verifique seu Email
            </h1>

            <div class="w-20 h-1 rounded-full bg-red-700"></div>

            <p class="max-w-sm text-sm md:text-base leading-relaxed text-gray-600 dark:text-gray-300">
                Enviamos um link de verificação para seu endereço de e-mail.
                Clique no link recebido para ativar sua conta e começar a usar o sistema.
            </p>

        </div>

        <!-- Sucesso -->
        @if (session('status') === 'verification-link-sent')
            <div
                class="flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-700 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300"
            >
                <x-lucide-badge-check class="w-5 h-5" />

                Um novo link de verificação foi enviado para o email informado no cadastro.
            </div>
        @endif

        <!-- Informação -->
        <div
            class="flex items-start gap-3 rounded-lg border border-red-100 bg-red-50 px-4 py-3 text-sm text-gray-700 dark:border-red-900/30 dark:bg-red-950/20 dark:text-gray-300"
        >
            <x-lucide-info class="w-5 h-5 text-red-700 mt-0.5 shrink-0" />

            <span>
                Não recebeu o email? Solicite um novo link de verificação ou saia para acessar outra conta.
            </span>
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-between gap-4 pt-2">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded bg-gray-950 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-gray-800 transition"
                >
                    <x-lucide-log-out class="w-4 h-4" />
                    Sair
                </button>
            </form>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-600 transition"
                >
                    <x-lucide-send class="w-4 h-4" />
                    Reenviar Email
                </button>
            </form>

        </div>

    </div>
</x-guest-layout>