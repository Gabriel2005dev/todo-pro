<x-app-layout>

    <div class="w-full max-w-[1400px] space-y-2 py-4 px-8 rounded-xl">

        {{-- ALERTA SUCCESS --}}
        @if (session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                class="fixed top-4 right-4 z-50 max-w-sm rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 shadow-lg"
            >
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERTA ERROR --}}
        @if ($errors->any())
            <div class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-700 shadow-sm">
                <p class="font-semibold">Corrija os campos abaixo:</p>

                <ul class="mt-2 list-inside list-disc text-xs">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- CARD PRINCIPAL --}}
        <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 border border-gray-300 ring-gray-100">

            {{-- HEADER --}}
            <div
                class="flex flex-col rounded-t-xl gap-4 border-b border-gray-300 bg-white/80 p-4 backdrop-blur-xl lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-red-700">
                        Administração
                    </p>

                    <h1 class="mt-1 text-2xl font-bold text-gray-900">
                        Usuários
                    </h1>

                    <p class="mt-1 text-sm text-gray-500">
                        Gerencie contas, permissões e usuários do sistema.
                    </p>

                </div>

             

            </div>

            {{-- TABELA --}}
            <div class="overflow-x-auto">

                <table class="min-w-full table-fixed divide-y divide-gray-300">

                    {{-- HEADER --}}
                    <thead>

                        <tr>

                            <th
                                class="w-[30%] px-4 py-3 text-center text-sm font-semibold uppercase tracking-wider text-gray-500">
                                Usuário
                            </th>

                            <th
                                class="w-[15%] px-4 py-3 text-center text-sm font-semibold uppercase tracking-wider text-gray-500">
                                Perfil
                            </th>

                            <th
                                class="w-[15%] px-4 py-3 text-center text-sm font-semibold uppercase tracking-wider text-gray-500">
                                Tarefas
                            </th>

                            <th
                                class="w-[20%] px-4 py-3 text-center text-sm font-semibold uppercase tracking-wider text-gray-500">
                                Criado em
                            </th>

                            <th
                                class="w-[20%] px-4 py-3 text-center text-sm font-semibold uppercase tracking-wider text-gray-500">
                                Ações
                            </th>

                        </tr>

                    </thead>

                    {{-- BODY --}}
                    <tbody class="divide-y divide-gray-300">

                        @forelse ($users as $user)

                            <tr
                                class="transition hover:bg-red-50/50"
                            >

                                {{-- USUÁRIO --}}
                                <td class="px-5 py-4">

                                    <div class="flex flex-col">

                                        <span class="font-semibold text-gray-900">
                                            {{ $user->name }}
                                        </span>

                                        <span class="text-xs text-gray-500">
                                            {{ $user->email }}
                                        </span>

                                    </div>

                                </td>

                                {{-- PERFIL --}}
                                <td class="px-4 py-4 text-center">

                                    @if ($user->is_admin)

                                        <span
                                            class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                            Admin
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                            Usuário
                                        </span>

                                    @endif

                                </td>

                                {{-- TAREFAS --}}
                                <td class="px-4 py-4 text-center">

                                    <span
                                        class="inline-flex items-center justify-center rounded-lg bg-gray-100 px-3 py-1 text-sm font-semibold text-gray-700">
                                        {{ $user->tasks_count }}
                                    </span>

                                </td>

                                {{-- DATA --}}
                                <td class="px-4 py-4 text-center text-sm text-gray-600">

                                    {{ $user->created_at?->format('d/m/Y H:i') }}

                                </td>

                                {{-- AÇÕES --}}
                                <td class="px-4 py-4">

                                    <div class="flex justify-center items-center gap-4">

                                        {{-- EDITAR --}}
                                        <a
                                            href="{{ route('admin.users.edit', $user) }}"
                                        >
                                            <x-lucide-square-pen
                                                class="h-5 w-5 cursor-pointer text-gray-500 transition hover:text-gray-900"
                                            />
                                        </a>

                                        {{-- EXCLUIR --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            onsubmit="return confirm('Excluir este usuário?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit">

                                                <x-lucide-trash-2
                                                    class="h-5 w-5 cursor-pointer text-rose-500 transition hover:text-rose-700"
                                                />

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-4 py-10 text-center text-sm text-gray-500"
                                >
                                    Nenhum usuário cadastrado.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- PAGINAÇÃO --}}
            <div class="border-t border-gray-300 px-6 py-4">

                {{ $users->links() }}

            </div>

        </div>

    </div>

</x-app-layout>