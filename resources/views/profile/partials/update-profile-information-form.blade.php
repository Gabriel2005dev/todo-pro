<section>
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Atualize as informações do seu perfil e endereço de e-mail da sua conta.") }}
        </p>
    </header>

    <!-- VERIFICAÇÃO -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- NAME -->
        <div class="space-y-1.5">
            <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                Nome
            </label>

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-user class="w-5 h-5" />
                </span>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="mt-1 block w-full pl-12 rounded-lg border-gray-300 dark:border-gray-700 
                           dark:bg-gray-900 dark:text-white
                           focus:ring-red-700 focus:border-red-700"
                />
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- EMAIL -->
        <div class="space-y-1.5">
            <label for="email" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                E-mail
            </label>

            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                    <x-lucide-mail class="w-5 h-5" />
                </span>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    class="mt-1 block w-full pl-12 rounded-lg border-gray-300 dark:border-gray-700 
                           dark:bg-gray-900 dark:text-white
                           focus:ring-red-700 focus:border-red-700"
                />
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 space-y-2">

                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        Seu endereço de e-mail não foi verificado.
                    </p>

                    <!-- REENVIAR -->
                    <button
                        form="send-verification"
                        class="inline-flex items-center gap-2 text-sm font-medium text-red-700 hover:text-red-600 underline"
                    >
                        <x-lucide-mail class="w-4 h-4" />
                        Reenviar e-mail de verificação
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-sm font-medium text-green-600 dark:text-green-400">
                            Um novo link foi enviado para seu e-mail.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-4 pt-2">

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded bg-gray-950 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-gray-800 transition"
            >
                <x-lucide-save class="w-4 h-4" />
                Salvar Dados
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >
                    Salvo.
                </p>
            @endif

        </div>
    </form>
</section>