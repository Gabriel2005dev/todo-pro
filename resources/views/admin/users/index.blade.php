<x-app-layout>
    <div x-data="userDashboard()" class="w-full max-w-[1400px] space-y-2 py-4 px-8 rounded-xl">

        {{-- ALERT SUCCESS --}}
        @if (session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="fixed top-4 right-4 z-50 max-w-sm rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 shadow-lg"
            >
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
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

        {{-- CARD --}}
        <div class="overflow-hidden rounded-xl bg-white shadow-sm border border-gray-300">

            {{-- HEADER --}}
            <div class="flex flex-col gap-2 border-b border-gray-300 p-4 lg:flex-row lg:justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase text-red-700">
                        Administração de usuários
                    </p>
                    <p class="text-sm text-gray-500">
                        Gerencie contas do sistema
                    </p>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table class="min-w-full table-fixed divide-y divide-gray-300">

                    <thead>
                        <tr class="text-center text-xs uppercase text-gray-500">

                            <th class="w-[30%] p-3">Usuário</th>
                            <th class="w-[15%] p-3">Perfil</th>
                            <th class="w-[15%] p-3">Tarefas</th>
                            <th class="w-[20%] p-3">Criado</th>
                            <th class="w-[20%] p-3">Ações</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($users as $user)
                            <tr class="border-t hover:bg-red-50/40">

                                {{-- USER --}}
                                <td class="p-4">
                                    <div class="flex items-center gap-3">

                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                                 class="w-10 h-10 rounded-full object-cover border">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                <x-lucide-user-round class="w-5 h-5 text-gray-500"/>
                                            </div>
                                        @endif

                                        <div>
                                            <p class="font-semibold">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        </div>

                                    </div>
                                </td>

                        
                                {{-- ROLE --}}
<td class="text-center">
    <div class="flex justify-center">

        <div
            class="flex h-9 w-9 items-center justify-center rounded-full border-2
            {{ $user->is_admin
                ? 'bg-red-700 text-white border-red-700'
                : 'bg-blue-700 text-white border-blue-700' }}"
            title="{{ $user->is_admin ? 'Administrador' : 'Usuário' }}"
        >
            @if($user->is_admin)
                <x-lucide-shield class="h-5 w-5" />
            @else
                <x-lucide-user class="h-5 w-5" />
            @endif
        </div>

    </div>
</td>


                                {{-- TASKS --}}
                                <td class="text-center">
                                    <span class="px-3 py-1 bg-gray-100 rounded-lg text-sm">
                                        {{ $user->tasks_count }}
                                    </span>
                                </td>

                                {{-- DATE --}}
                                <td class="text-center text-sm text-gray-500">
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                </td>

                                {{-- ACTIONS --}}
                               <td class="text-center">
    <div class="flex items-center justify-center gap-4">

        {{-- EDIT --}}
        <button
            type="button"
            @click="openEditModal({{ Js::from($user) }})"
            class="flex items-center justify-center"
        >
            <x-lucide-pencil class="w-5 h-5 text-gray-500 hover:text-gray-900"/>
        </button>

        {{-- DELETE --}}
        <form
            method="POST"
            action="{{ route('admin.users.destroy', $user) }}"
            onsubmit="return confirm('Excluir usuário?')"
            class="flex items-center justify-center"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="flex items-center justify-center"
            >
                <x-lucide-trash-2 class="w-5 h-5 text-rose-500 hover:text-rose-700"/>
            </button>
        </form>

    </div>
</td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>

        {{-- MODAL --}}
        @include('admin.users.partials.form')

    </div>

    {{-- SCRIPT --}}
    <script>
        function userDashboard() {
            return {

                isEditOpen: false,

                form: {
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    is_admin: 0,
                },

                openEditModal(user) {
                    this.form = {
                        id: user.id,
                        name: user.name,
                        email: user.email,
                        password: '',
                        password_confirmation: '',
                        is_admin: user.is_admin ? 1 : 0, 
                    };

                    this.isEditOpen = true;
                },

                closeModal() {
                    this.isEditOpen = false;
                }

            }
        }
    </script>

</x-app-layout>