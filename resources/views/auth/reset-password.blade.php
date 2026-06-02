<x-guest-layout>

    <form method="POST"
          action="{{ route('password.store') }}"
          class="flex flex-col gap-4">
        @csrf

        <!-- Token -->
        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
        >

        <!-- Cabeçalho -->
        <div class="flex flex-col items-center gap-3 mb-4 text-center">

            <div class="flex items-center justify-center w-16 h-16 rounded-full bg-red-50 dark:bg-red-900/20">
                <x-lucide-key-round class="w-8 h-8 text-red-700" />
            </div>

            <h1 class="text-2xl font-black tracking-tight text-red-700">
                Redefinir Senha
            </h1>

            <div class="w-20 h-1 rounded-full bg-red-700"></div>

            <p class="max-w-sm text-sm md:text-base leading-relaxed text-gray-600 dark:text-gray-300">
                Crie uma nova senha para recuperar o acesso à sua conta com segurança.
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
                    :value="old('email', $request->email)"
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

        <!-- Nova Senha -->
        <div class="space-y-1.5">

            <x-input-label
                for="password"
                :value="__('Nova Senha')"
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
                    autocomplete="new-password"
                    class="block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                />

            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        <!-- Confirmar Senha -->
        <div class="space-y-1.5">

            <x-input-label
                for="password_confirmation"
                :value="__('Confirmar Senha')"
            />

            <div class="relative">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-shield-check class="w-5 h-5" />
                </span>

                <x-text-input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                />

            </div>

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>

        <!-- Informação -->
        <div
            class="flex items-start gap-3 rounded-lg border border-red-100 bg-red-50 px-4 py-3 text-sm text-gray-700 dark:border-red-900/30 dark:bg-red-950/20 dark:text-gray-300"
        >
            <x-lucide-info class="w-5 h-5 text-red-700 mt-0.5 shrink-0" />

            <span>
                Utilize uma senha forte contendo letras, números e caracteres especiais para aumentar a segurança da sua conta.
            </span>
        </div>

        <!-- Botão -->
        <div class="flex justify-end pt-2">

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-600 transition"
            >
                <x-lucide-refresh-cw class="w-4 h-4" />
                Redefinir Senha
            </button>

        </div>

    </form>

</x-guest-layout>