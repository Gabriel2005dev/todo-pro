<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST"
          action="{{ route('login') }}"
          class="flex flex-col gap-3">
        @csrf

        <!-- Título -->
        <div class="flex flex-col gap-3 mb-6">
            <p class="max-w-sm text-gray-600 dark:text-gray-300 
                text-sm md:text-base leading-relaxed">

                <span class="font-black text-red-700">Entre na sua conta</span>
                e continue suas tarefas.
            </p>
        </div>

        <!-- Email -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email')" />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-mail class="h-5 w-5" />
                </span>

                <x-text-input
                    id="email"
                    class="block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                    type="email"
                    name="email"
                    :value="old('email')"
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
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-lock class="h-5 w-5" />
                </span>

                <x-text-input
                    id="password"
                    class="block w-full pl-12 pr-12 focus:ring-red-700 focus:border-red-700"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password" />

                <!-- Toggle password -->
                <button type="button"
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 transition hover:text-red-700">

                    <x-lucide-eye id="eye-open" class="h-5 w-5 hidden" />
                    <x-lucide-eye-off id="eye-closed" class="h-5 w-5" />
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Lembrar + Esqueci senha -->
        <div class="flex items-center justify-between pt-1">

            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">

                <input id="remember_me"
                       type="checkbox"
                       class="rounded border-gray-300 text-red-700 shadow-sm
                              focus:ring-red-700 dark:bg-gray-900"
                       name="remember">

                <span class="text-sm text-gray-600 dark:text-gray-400">
                    Lembrar de mim
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-red-700 dark:text-gray-400"
                   href="{{ route('password.request') }}">
                    Esqueceu a senha?
                </a>
            @endif
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-between gap-4 pt-3">

            <a class="text-sm text-gray-600 hover:text-red-700 dark:text-gray-400"
               href="{{ route('register') }}">
                Criar conta
            </a>

            <button type="submit"
                class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-600 transition">

                <x-lucide-log-in class="h-4 w-4" />
                Entrar
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