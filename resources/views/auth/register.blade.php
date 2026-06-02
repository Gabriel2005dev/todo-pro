<x-guest-layout>
    <form method="POST"
      action="{{ route('register') }}"
      class="flex flex-col gap-3">
        @csrf

        <!-- Título -->
        <div class="flex flex-col items-center gap-3 mb-6">
            <p class="max-w-sm text-gray-600 dark:text-gray-300 
                text-sm md:text-base leading-relaxed">
                Para começar a organizar suas tarefas,
                <span class="font-black text-red-700">crie sua conta</span>
                em poucos passos.
            </p>
        </div>

        <!-- Nome -->
        <div class="space-y-1.5">
            <x-input-label for="name" :value="__('Nome completo')" />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-user class="h-5 w-5" />
                </span>

                <x-text-input
                    id="name"
                    class="block w-full pl-12 focus:ring-red-700 focus:border-red-700"
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
                    autocomplete="new-password" />

                <button type="button"
                    onclick="togglePassword()"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 transition hover:text-red-700"
                    aria-label="Mostrar ou ocultar senha">

                    <x-lucide-eye id="eye-open" class="h-5 w-5 hidden" />
                    <x-lucide-eye-off id="eye-closed" class="h-5 w-5" />
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Senha -->
        <div class="space-y-1.5">
            <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-shield-check class="h-5 w-5" />
                </span>

                <x-text-input
                    id="password_confirmation"
                    class="block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"/>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Botões -->
        <div class="flex items-center justify-between gap-4 pt-2">
            <a class="text-sm text-gray-600 transition hover:text-red-700 dark:text-gray-400"
                href="{{ route('login') }}">
                Já possui conta?
            </a>

            <button type="submit"
                class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-600 transition">
                
               
                Cadastrar
                 <x-lucide-user-plus class="h-4 w-4" />
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