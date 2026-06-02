<x-guest-layout>

    <form method="POST"
          action="{{ route('password.confirm') }}"
          class="flex flex-col gap-4">
        @csrf

        <!-- Cabeçalho -->
        <div class="flex flex-col items-center gap-3 mb-4 text-center">

            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-red-50 dark:bg-red-900/20">
                <x-lucide-shield-check class="w-8 h-8 text-red-700" />
            </div>

            <h1 class="text-2xl font-black tracking-tight text-red-700">
                Confirmar Senha
            </h1>

            <div class="w-20 h-1 rounded-full bg-red-700"></div>

            <p class="max-w-sm text-sm md:text-base leading-relaxed text-gray-600 dark:text-gray-300">
                Esta é uma área protegida. Confirme sua senha para continuar e garantir a segurança da sua conta.
            </p>

        </div>

        <!-- Senha -->
        <div class="space-y-1.5">

            <x-input-label
                for="password"
                :value="__('Senha')"
            />

            <div class="relative">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-lock-keyhole class="w-5 h-5" />
                </span>

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    class="block w-full pl-12 pr-12 focus:ring-red-700 focus:border-red-700"
                />

                <!-- Mostrar senha -->
                <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 transition hover:text-red-700"
                >
                    <x-lucide-eye
                        id="eye-open"
                        class="w-5 h-5 hidden"
                    />

                    <x-lucide-eye-off
                        id="eye-closed"
                        class="w-5 h-5"
                    />
                </button>

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        <!-- Informação -->
        <div
            class="flex items-start gap-3 rounded-lg border border-red-100 bg-red-50 px-4 py-3 text-sm text-gray-700 dark:border-red-900/30 dark:bg-red-950/20 dark:text-gray-300"
        >
            <x-lucide-info class="w-5 h-5 text-red-700 mt-0.5 shrink-0" />

            <span>
                Sua senha é necessária para confirmar sua identidade antes de acessar esta área protegida.
            </span>
        </div>

        <!-- Botão -->
        <div class="flex justify-end pt-2">

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-600 transition"
            >
                <x-lucide-shield-check class="w-4 h-4" />
                Confirmar
            </button>

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