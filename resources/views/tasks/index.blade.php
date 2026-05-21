<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Dashboard de Tarefas</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Gerencie tudo em uma única página.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8" x-data="taskDashboard({{ Js::from($tasks) }})">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-700 shadow-sm">
                    <p class="font-semibold">Corrija os campos abaixo:</p>
                    <ul class="mt-2 list-inside list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                    <p class="text-sm text-gray-500">Total</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                </div>
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                    <p class="text-sm text-gray-500">Concluídas</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-600">{{ $stats['completed'] }}</p>
                </div>
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                    <p class="text-sm text-gray-500">Pendentes</p>
                    <p class="mt-2 text-3xl font-bold text-amber-600">{{ $stats['pending'] }}</p>
                </div>
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                    <p class="text-sm text-gray-500">Em andamento</p>
                    <p class="mt-2 text-3xl font-bold text-violet-600">{{ $stats['doing'] }}</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                        <thead class="bg-gray-50 dark:bg-gray-800/60">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tarefa</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Prioridade</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Data</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Ações</th>
                            </tr>
                        </thead>


                        <div class="flex justify-end bg-white/80 p-4 shadow-sm backdrop-blur-xl dark:border-violet-900/40 dark:bg-[#18181b]/80">

    <div class="flex items-center gap-5 text-gray-500">

        {{-- PESQUISA --}}
        <div
            class="cursor-pointer transition-all duration-200 hover:scale-110 hover:text-violet-600"
        >
            <x-lucide-search class="h-5 w-5" />
        </div>

        {{-- FILTRO --}}
        <div
            class="cursor-pointer transition-all duration-200 hover:scale-110 hover:text-violet-600"
        >
            <x-lucide-filter class="h-5 w-5" />
        </div>

        {{-- ORDENAR --}}
        <div
            class="cursor-pointer transition-all duration-200 hover:scale-110 hover:text-violet-600"
        >
            <x-lucide-arrow-up-down class="h-5 w-5" />
        </div>

        {{-- NOVA TASK --}}
        <button
            @click="openCreateModal()"
            class="ml-2 inline-flex items-center gap-2 rounded-lg bg-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-violet-500/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-violet-700 hover:shadow-violet-500/30 active:scale-95"
        >
           
            Nova Tarefa
            <x-lucide-plus class="h-4 w-4" />
        </button>

    </div>

</div>

           

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse ($tasks as $task)
                                <tr class="transition hover:bg-violet-50/50 dark:hover:bg-violet-900/10">
                                    <td class="px-4 py-4">
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $task->title }}</p>
                                        <p class="mt-1 line-clamp-1 text-sm text-gray-500">{{ $task->description ?: 'Sem descrição' }}</p>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold"
                                            :class="statusClass('{{ $task->status }}')">
                                            <span x-text="statusLabel('{{ $task->status }}')"></span>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold"
                                            :class="priorityClass('{{ $task->priority }}')">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') : 'Sem prazo' }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex justify-end gap-2">
                                            <button @click="openViewModal({{ Js::from($task) }})" class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:bg-gray-100">Ver</button>
                                            <button @click="openEditModal({{ Js::from($task) }})" class="rounded-lg border border-violet-200 px-3 py-1.5 text-xs font-semibold text-violet-700 transition hover:bg-violet-100">Editar</button>
                                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" onsubmit="return confirm('Tem certeza que deseja excluir esta tarefa?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-semibold text-rose-700 transition hover:bg-rose-100">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-10 text-center text-sm text-gray-500">Nenhuma tarefa cadastrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <button
            @click="openCreateModal()"
            class="fixed bottom-6 right-6 z-30 inline-flex h-14 w-14 items-center justify-center rounded-full bg-violet-600 text-2xl font-bold text-white shadow-xl transition hover:bg-violet-700 sm:hidden"
            aria-label="Adicionar nova tarefa"
        >
            +
        </button>

        @include('tasks.partials.form')
    </div>

    <script>
        function taskDashboard() {
            return {
                isCreateOpen: false,
                isEditOpen: false,
                isViewOpen: false,
                selectedTask: null,
                formAction: '{{ route('tasks.store') }}',
                formMethod: 'POST',
                form: { title: '', description: '', status: 'a_fazer', priority: 'media', deadline: '' },
                openCreateModal() {
                    this.formAction = '{{ route('tasks.store') }}';
                    this.formMethod = 'POST';
                    this.form = { title: '', description: '', status: 'a_fazer', priority: 'media', deadline: '' };
                    this.isCreateOpen = true;
                },
                openEditModal(task) {
                    this.formAction = `/tasks/${task.id}`;
                    this.formMethod = 'PUT';
                    this.form = {
                        title: task.title ?? '',
                        description: task.description ?? '',
                        status: task.status ?? 'a_fazer',
                        priority: task.priority ?? 'media',
                        deadline: task.deadline ?? ''
                    };
                    this.isEditOpen = true;
                },
                openViewModal(task) {
                    this.selectedTask = task;
                    this.isViewOpen = true;
                },
                statusLabel(status) {
                    return { a_fazer: 'Pendente', fazendo: 'Em andamento', concluida: 'Concluída' }[status] ?? status;
                },
                statusClass(status) {
                    return {
                        a_fazer: 'bg-amber-100 text-amber-700',
                        fazendo: 'bg-violet-100 text-violet-700',
                        concluida: 'bg-emerald-100 text-emerald-700'
                    }[status] ?? 'bg-gray-100 text-gray-700';
                },
                priorityClass(priority) {
                    return {
                        baixa: 'bg-sky-100 text-sky-700',
                        media: 'bg-orange-100 text-orange-700',
                        alta: 'bg-rose-100 text-rose-700'
                    }[priority] ?? 'bg-gray-100 text-gray-700';
                }
            }
        }
    </script>
</x-app-layout>