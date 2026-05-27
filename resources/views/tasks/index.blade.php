<x-app-layout>
    <div class="" x-data="taskDashboard()">
        <div class="w-full max-w-[1400px] space-y-2 py-4 px-8 rounded-xl">

            {{-- ALERTAS --}}
            
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

            {{-- CARDS NEUMORFISMO --}}
<div class="grid grid-cols-1 gap-2 sm:grid-cols-2 xl:grid-cols-4">

    {{-- TOTAL --}}
    <div
        class="group relative overflow-hidden rounded-xl border border-gray-300  bg-white p-4 transition-all duration-300
        dark:bg-[#1a1a1a]"
    >

        <div
            class="absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
            style="
                background: linear-gradient(
                    135deg,
                    rgba(255,255,255,0.35),
                    transparent
                );
            "
        ></div>

        <div class="relative flex items-start justify-between">

            <div>
                <p class="text-xs font-medium tracking-wide text-gray-500 dark:text-gray-400">
                    Total
                </p>

                <h3 class="mt-4 text-4xl font-black tracking-tight text-gray-900 dark:text-white">
                    {{ $stats['total'] }}
                </h3>
            </div>

            <div
                class="flex h-16 w-16 items-center justify-center rounded-xl bg-white
                dark:bg-[#1f1f1f]"
             
            >
                <x-lucide-layout-dashboard class="h-8 w-8 text-slate-700 dark:text-slate-300" />
            </div>

        </div>

        <div class="mt-6 flex items-center gap-2">
            <div class="h-2 w-2 rounded-full bg-slate-500"></div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                Todas as tarefas
            </span>
        </div>
    </div>

    {{-- CONCLUÍDAS --}}
    <div
        class="group relative overflow-hidden rounded-xl border border-gray-300 bg-white p-4 transition-all duration-300
        dark:bg-[#1a1a1a]"
    >

        <div class="relative flex items-start justify-between">

            <div>
                <p class="text-xs font-medium tracking-wide text-gray-500 dark:text-gray-400">
                    Concluídas
                </p>

                <h3 class="mt-4 text-4xl font-black tracking-tight text-emerald-600">
                    {{ $stats['completed'] }}
                </h3>
            </div>

            <div
                class="flex h-16 w-16 items-center justify-center rounded-xl bg-white
                dark:bg-[#1f1f1f]"
           
            >
                <x-lucide-check-check class="h-8 w-8 text-emerald-500" />
            </div>

        </div>

        <div class="mt-6 flex items-center gap-2">
            <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                Finalizadas com sucesso
            </span>
        </div>
    </div>

    {{-- PENDENTES --}}
    <div
        class="group relative overflow-hidden rounded-xl bg-white border border-gray-300  p-4 transition-all duration-300
        dark:bg-[#1a1a1a]"
    
    >

        <div class="relative flex items-start justify-between">

            <div>
                <p class="text-xs font-medium tracking-wide text-gray-500 dark:text-gray-400">
                    Pendentes
                </p>

                <h3 class="mt-4 text-4xl font-black tracking-tight text-amber-500">
                    {{ $stats['pending'] }}
                </h3>
            </div>

            <div
                class="flex h-16 w-16 items-center justify-center rounded-xl bg-[#f3f4f6]
                dark:bg-[#1f1f1f]"
               
            >
                <x-lucide-clock-3 class="h-8 w-8 text-amber-500" />
            </div>

        </div>

        <div class="mt-6 flex items-center gap-2">
            <div class="h-2 w-2 rounded-full bg-amber-500"></div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                Aguardando ação
            </span>
        </div>
    </div>

    {{-- EM ANDAMENTO --}}
    <div
        class="group relative overflow-hidden rounded-xl bg-white border border-gray-300 p-4 transition-all duration-300
        dark:bg-[#1a1a1a]"
      
    >

        <div class="relative flex items-start justify-between">

            <div>
                <p class="text-xs font-medium tracking-wide text-gray-500 dark:text-gray-400">
                    Em andamento
                </p>

                <h3 class="mt-4 text-4xl font-black tracking-tight text-violet-500">
                    {{ $stats['doing'] }}
                </h3>
            </div>

            <div
                class="flex h-16 w-16 items-center justify-center rounded-xl bg-[#f3f4f6]
                dark:bg-[#1f1f1f]"
           
            >
                <x-lucide-loader-circle class="h-8 w-8 text-violet-500 animate-spin" />
            </div>

        </div>

        <div class="mt-6 flex items-center gap-2">
            <div class="h-2 w-2 rounded-full bg-violet-500"></div>
            <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                Tarefas em progresso
            </span>
        </div>
    </div>

</div>

            {{-- TABELA --}}
            <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 border border-gray-300 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">

                {{-- TOPO --}}
                <div class="flex flex-col gap-4 border-b border-gray-300 bg-white/80 p-4 backdrop-blur-xl dark:border-gray-800 dark:bg-[#18181b]/80 lg:flex-row lg:items-center lg:justify-between">

                    {{-- TABS --}}
                    <div
                        class="
                        flex
                        items-center
                        gap-1
                        rounded-2xl
                        border
                        border-gray-300
                        bg-indigo-50
                        p-1
                        dark:border-gray-800
                        dark:bg-[#111827]
                    
                    ">


                        @php
                            $tabs = [
                                'todas' => ['Todas', $stats['total']],
                                'a_fazer' => ['Pendente', $stats['pending']],
                                'fazendo' => ['Em andamento', $stats['doing']],
                                'concluida' => ['Concluída', $stats['completed']],
                            ];
                        @endphp

                        @foreach ($tabs as $key => $tab)

                            <button
                                @click="filter='{{ $key }}'"

                                :class="
                                    filter === '{{ $key }}'
                                    ? 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 shadow-sm'
                                    : 'text-gray-500 hover:text-violet-600 dark:text-gray-400 dark:hover:text-violet-400'
                                "

                                class="
                                inline-flex
                                items-center
                                gap-2
                                rounded-xl
                                px-5
                                py-1
                                text-sm
                                font-medium
                            
                            ">

                                {{ $tab[0] }}

                                <span
                                    class="
                                    rounded-full
                                    font-semibold
                                    text-gray-900
                                ">
                                    {{ $tab[1] }}
                                </span>

                            </button>

                        @endforeach

                    </div>

                    {{-- AÇÕES --}}
                    <div class="flex items-center gap-5 text-gray-500">

                        {{-- PESQUISA --}}
                        <div class="cursor-pointer transition-all duration-200 hover:scale-110 hover:text-violet-600">
                            <x-lucide-search class="h-5 w-5" />
                        </div>

                        {{-- FILTRO --}}
                        <div class="cursor-pointer transition-all duration-200 hover:scale-110 hover:text-violet-600">
                            <x-lucide-filter class="h-5 w-5" />
                        </div>

                        {{-- ORDENAR --}}
                        <div class="cursor-pointer transition-all duration-200 hover:scale-110 hover:text-violet-600">
                            <x-lucide-arrow-up-down class="h-5 w-5" />
                        </div>

                        {{-- NOVA TASK --}}
                        <button
                            @click="openCreateModal()"
                            class="
                            ml-2
                            inline-flex
                            items-center
                            gap-2
                            rounded
                            bg-red-700
                            px-4
                            py-2
                            text-sm
                            font-semibold
                            text-white
                            shadow-lg
                          
                        
                       
                        ">
                            Nova Tarefa
                            <x-lucide-plus class="h-4 w-4" />
                        </button>

                    </div>

                </div>

               {{-- TABELA --}}
<div class="overflow-x-auto">

    <table class="min-w-full  table-fixed divide-y divide-gray-300  dark:divide-gray-800">

        {{-- HEADER --}}
        <thead class="dark:bg-gray-800/60 items-center text-center">

            <tr>

                <th class="text-center w-[20%] px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider text-gray-500">
                    Tarefa
                </th>

                <th class="text-center w-[20%] px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider text-gray-500">
                    Status
                </th>

                <th class="text-center w-[20%] px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider text-gray-500">
                    Prioridade
                </th>

                <th class="text-center w-[20%] px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider text-gray-500">
                    Data
                </th>

                <th class="text-center w-[20%] px-4 py-3 text-left text-sm font-semibold uppercase tracking-wider text-gray-500">
                    Ações
                </th>

            </tr>

        </thead>

        {{-- BODY --}}
        <tbody class="divide-y divide-gray-300 dark:divide-gray-800">

    @forelse ($tasks as $task)

       <tr
    id="task-row-{{ $task->id }}"
    x-show="filter === 'todas' || filter === '{{ $task->status }}'"
    class="transition hover:bg-violet-50/50 dark:hover:bg-violet-900/10"
>

            {{-- TAREFA --}}
            <td class="px-5 py-3">

                <div class="flex items-start gap-3">

                    {{-- CHECKBOX --}}

                   

                    {{-- TITULO INLINE --}}
                    <div class="w-full max-w-[240px] overflow-hidden">

                     {{-- INPUT TITULO --}}
<input
    type="text"
    value="{{ $task->title }}"
    @blur="updateField({{ $task->id }}, 'title', $event.target.value)"
    :disabled="loadingTaskId === {{ $task->id }}"
    class="w-full truncate border-0 bg-transparent p-0 text-sm font-semibold text-gray-900 outline-none focus:ring-0 dark:text-gray-100 disabled:opacity-50"
/>

                        <p class="mt-1 truncate text-xs text-gray-500">
                            {!! strip_tags($task->description) ?: 'Sem descrição' !!}
                        </p>

                    </div>

                </div>

            </td>

            {{-- STATUS INLINE --}}
            <td class="px-4 py-4 text-center">
{{-- STATUS INLINE --}}
<select
    @change="updateField({{ $task->id }}, 'status', $event.target.value)"
    :disabled="loadingTaskId === {{ $task->id }}"
    class="rounded-full border-0 px-3 py-1 text-xs font-semibold outline-none ring-0 disabled:opacity-50
    {{ $task->status === 'a_fazer' ? 'bg-amber-100 text-amber-700' : '' }}
    {{ $task->status === 'fazendo' ? 'bg-violet-100 text-violet-700' : '' }}
    {{ $task->status === 'concluida' ? 'bg-emerald-100 text-emerald-700' : '' }}"
>

    <option value="a_fazer" {{ $task->status === 'a_fazer' ? 'selected' : '' }}>
        Pendente
    </option>

    <option value="fazendo" {{ $task->status === 'fazendo' ? 'selected' : '' }}>
        Em andamento
    </option>

    <option value="concluida" {{ $task->status === 'concluida' ? 'selected' : '' }}>
        Concluída
    </option>

</select>
            

            </td>

            {{-- PRIORIDADE INLINE --}}
            <td class="px-4 py-4 text-center">

               {{-- PRIORIDADE INLINE --}}
<select
    @change="updateField({{ $task->id }}, 'priority', $event.target.value)"
    :disabled="loadingTaskId === {{ $task->id }}"
    class="rounded-full border-0 px-3 py-1 text-xs font-semibold outline-none ring-0 disabled:opacity-50
    {{ $task->priority === 'baixa' ? 'bg-sky-100 text-sky-700' : '' }}
    {{ $task->priority === 'media' ? 'bg-orange-100 text-orange-700' : '' }}
    {{ $task->priority === 'alta' ? 'bg-rose-100 text-rose-700' : '' }}"
>

    <option value="baixa" {{ $task->priority === 'baixa' ? 'selected' : '' }}>
        Baixa
    </option>

    <option value="media" {{ $task->priority === 'media' ? 'selected' : '' }}>
        Média
    </option>

    <option value="alta" {{ $task->priority === 'alta' ? 'selected' : '' }}>
        Alta
    </option>

</select>
            </td>

            {{-- DATA --}}
            <td class="px-4 py-4 text-center text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">

                {{ $task->deadline
                    ? \Carbon\Carbon::parse($task->deadline)->format('d/m/Y')
                    : 'Sem prazo'
                }}

            </td>

            {{-- AÇÕES --}}
            <td class="text-center">

                <div class="flex justify-center items-center gap-4 whitespace-nowrap">

                    {{-- VER --}}
                    <x-lucide-eye
                        @click="openViewModal({{ Js::from($task) }})"
                        class="h-5 w-5 text-gray-500 hover:text-gray-800 cursor-pointer transition"
                    />

                    {{-- EDITAR COMPLETO --}}
                    <x-lucide-pencil
                        @click="openEditModal({{ Js::from($task) }})"
                        class="h-5 w-5 text-violet-500 hover:text-violet-700 cursor-pointer transition"
                    />

                    {{-- EXCLUIR --}}
                    {{-- EXCLUIR TASK --}}
<button
    @click="deleteTask({{ $task->id }})"
    class="flex items-center"
    type="button"
>

    {{-- LOADING --}}
    <template x-if="deletingTaskId === {{ $task->id }}">
        <x-lucide-loader-circle
            class="h-5 w-5 animate-spin text-rose-500"
        />
    </template>

    {{-- LIXEIRA --}}
    <template x-if="deletingTaskId !== {{ $task->id }}">
        <x-lucide-trash-2
            class="h-5 w-5 text-rose-500 hover:text-rose-700 cursor-pointer transition"
        />
    </template>

</button>
                   
                </div>

            </td>

        </tr>

    @empty

        <tr>
            <td colspan="5" class="px-4 py-10 text-center text-sm text-gray-500">
                Nenhuma tarefa cadastrada.
            </td>
        </tr>

    @endforelse

</tbody>

    </table>

</div>

            </div>

        </div>

        {{-- FAB MOBILE --}}
        <button
            @click="openCreateModal()"
            class="
            fixed
            bottom-6
            right-6
            z-30
            inline-flex
            h-14
            w-14
            items-center
            justify-center
            rounded-full
            bg-violet-600
            text-2xl
            font-bold
            text-white
            shadow-xl
            transition
            hover:bg-violet-700
            sm:hidden
        "
            aria-label="Adicionar nova tarefa"
        >
            +
        </button>

        @include('tasks.partials.form')

    </div>

    <script>
    function taskDashboard() {
        return {

            filter: 'todas',

            isCreateOpen: false,
            isEditOpen: false,
            isViewOpen: false,

            selectedTask: null,

            loadingTaskId: null,
            deletingTaskId: null,

            form: {},
            formAction: '',
            formMethod: 'POST',

            // =========================
            // TOGGLE CONCLUÍDA
            // =========================
            async toggleComplete(taskId) {

                this.loadingTaskId = taskId;

                try {

                    const response = await fetch(`/tasks/${taskId}/toggle`, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),

                            'Accept': 'application/json',
                        }
                    });

                    const data = await response.json();

                    if (data.success) {

                        const row = document.querySelector(`#task-row-${taskId}`);

                        if (row) {
                            row.classList.add('opacity-50');
                        }

                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    }

                } catch (error) {

                    console.error(error);

                } finally {

                    this.loadingTaskId = null;
                }
            },

            // =========================
            // UPDATE INLINE
            // =========================
            async updateField(taskId, field, value) {

                this.loadingTaskId = taskId;

                try {

                    const response = await fetch(`/tasks/${taskId}/inline-update`, {

                        method: 'PATCH',

                        headers: {
                            'Content-Type': 'application/json',

                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),

                            'Accept': 'application/json',
                        },

                        body: JSON.stringify({
                            field,
                            value
                        })

                    });

                    const data = await response.json();

                    if (!data.success) {
                        console.error(data.message);
                    }

                } catch (error) {

                    console.error(error);

                } finally {

                    setTimeout(() => {
                        this.loadingTaskId = null;
                    }, 300);
                }
            },

            // =========================
            // EXCLUIR TASK
            // =========================
            async deleteTask(taskId) {

                if (!confirm('Tem certeza que deseja excluir esta tarefa?')) {
                    return;
                }

                this.deletingTaskId = taskId;

                try {

                    const response = await fetch(`/tasks/${taskId}`, {

                        method: 'DELETE',

                        headers: {

                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),

                            'Accept': 'application/json',
                        }

                    });

                    if (response.ok) {

                        const row = document.querySelector(`#task-row-${taskId}`);

                        if (row) {

                            row.style.transition = 'all .3s ease';

                            row.style.opacity = '0';
                            row.style.transform = 'translateX(40px)';

                            setTimeout(() => {
                                row.remove();
                            }, 300);
                        }
                    }

                } catch (error) {

                    console.error(error);

                } finally {

                    this.deletingTaskId = null;
                }
            },

            // =========================
            // MODAL CRIAR
            // =========================
            openCreateModal() {

                this.formAction = '{{ route('tasks.store') }}';
                this.formMethod = 'POST';

                this.form = {
                    title: '',
                    description: '',
                    status: 'a_fazer',
                    priority: 'media',
                    deadline: ''
                };

                this.isCreateOpen = true;

                this.$nextTick(() => {
                    const editor = document.getElementById('editor');

                    if (editor) {
                        editor.innerHTML = '';
                    }
                });
            },

            // =========================
            // MODAL EDITAR
            // =========================
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

                this.$nextTick(() => {
                    const editor = document.getElementById('editor');

                    if (editor) {
                        editor.innerHTML = task.description ?? '';
                    }
                });
            },

            // =========================
            // MODAL VISUALIZAR
            // =========================
            openViewModal(task) {

                this.selectedTask = task;
                this.isViewOpen = true;
            },

            // =========================
            // FECHAR MODAL
            // =========================
            closeModal() {

                this.isCreateOpen = false;
                this.isEditOpen = false;
            },

            // =========================
            // EDITOR
            // =========================
            initEditor() {

                this.$watch('form.description', (value) => {

                    const editor = document.getElementById('editor');

                    if (editor && editor.innerHTML !== value) {
                        editor.innerHTML = value || '';
                    }
                });
            },

            format(command) {

                document.execCommand(command, false, null);

                this.syncEditor();
            },

            syncEditor() {

                const editor = document.getElementById('editor');

                this.form.description = editor.innerHTML;
            },

            // =========================
            // STATUS LABEL
            // =========================
            statusLabel(status) {

                return {
                    a_fazer: 'Pendente',
                    fazendo: 'Em andamento',
                    concluida: 'Concluída'
                }[status] ?? status;
            },

            // =========================
            // STATUS CLASS
            // =========================
            statusClass(status) {

                return {
                    a_fazer: 'bg-amber-100 text-amber-700',
                    fazendo: 'bg-violet-100 text-violet-700',
                    concluida: 'bg-emerald-100 text-emerald-700'
                }[status] ?? 'bg-gray-100 text-gray-700';
            },

            // =========================
            // PRIORIDADE CLASS
            // =========================
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