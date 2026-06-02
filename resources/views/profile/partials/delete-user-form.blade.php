<section class="space-y-6">

    <header>
        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            {{ __('Excluir Conta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão removidos permanentemente. Antes de excluir sua conta, faça o download de qualquer dado ou informação que deseja manter.') }}
        </p>
    </header>

    <!-- BOTÃO -->
    <button
        type="button"
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-600 transition"
    >
        <x-lucide-trash-2 class="w-4 h-4" />
        {{ __('Excluir Conta') }}
    </button>

    <!-- MODAL -->
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >

        <form method="post"
              action="{{ route('profile.destroy') }}"
              class="p-6">

            @csrf
            @method('delete')

            <div class="flex items-center gap-2">
                <x-lucide-triangle-alert class="w-5 h-5 text-red-600" />

                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ __('Tem certeza de que deseja excluir sua conta?') }}
                </h2>
            </div>

            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão removidos permanentemente. Digite sua senha para confirmar esta ação.') }}
            </p>

            <!-- SENHA -->
            <div class="mt-6 space-y-1.5">

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
                        autocomplete="current-password"
                        placeholder="Digite sua senha"
                        class="block w-full pl-12 focus:ring-red-700 focus:border-red-700"
                    />

                </div>

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>

            <!-- AÇÕES -->
            <div class="mt-6 flex justify-end gap-3">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center gap-2 rounded bg-gray-950 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-gray-800 transition"
                >
                    <x-lucide-x class="w-4 h-4" />
                    {{ __('Cancelar') }}
                </button>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-600 transition"
                >
                    <x-lucide-trash-2 class="w-4 h-4" />
                    {{ __('Excluir Conta') }}
                </button>

            </div>

        </form>

    </x-modal>

</section>