@csrf

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <x-input-label for="name" value="Nome" />
        <x-text-input
            id="name"
            name="name"
            type="text"
            class="mt-1 block w-full"
            :value="old('name', $user->name ?? '')"
            required
            autofocus
        />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" value="E-mail" />
        <x-text-input
            id="email"
            name="email"
            type="email"
            class="mt-1 block w-full"
            :value="old('email', $user->email ?? '')"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div>
        <x-input-label for="password" :value="isset($user) ? 'Nova senha (opcional)' : 'Senha'" />
        <x-text-input
            id="password"
            name="password"
            type="password"
            class="mt-1 block w-full"
            :required="! isset($user)"
            autocomplete="new-password"
        />
        <x-input-error class="mt-2" :messages="$errors->get('password')" />
    </div>

    <div>
        <x-input-label for="password_confirmation" value="Confirmar senha" />
        <x-text-input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            :required="! isset($user)"
            autocomplete="new-password"
        />
    </div>
</div>

<div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4">
    <input type="hidden" name="is_admin" value="0">

    <label for="is_admin" class="flex items-start gap-3">
        <input
            id="is_admin"
            name="is_admin"
            type="checkbox"
            value="1"
            @checked(old('is_admin', $user->is_admin ?? false))
            class="mt-1 rounded border-gray-300 text-red-700 shadow-sm focus:ring-red-700"
        >

        <span>
            <span class="block font-semibold text-amber-900">Administrador</span>
            <span class="mt-1 block text-sm text-amber-800">
                Administradores podem acessar apenas o CRUD de usuários; tarefas continuam restritas ao dono de cada tarefa.
            </span>
        </span>
    </label>
    <x-input-error class="mt-2" :messages="$errors->get('is_admin')" />
</div>

<div class="mt-6 flex items-center justify-end gap-3">
    <a
        href="{{ route('admin.users.index') }}"
        class="rounded-md border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-100"
    >
        Cancelar
    </a>

    <x-primary-button>
        {{ $buttonText }}
    </x-primary-button>
</div>