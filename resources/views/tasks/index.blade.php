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


            {{-- TABELA --}}
                  <div class="overflow-visible rounded-xl bg-white shadow-sm ring-1 ring-gray-100 border border-gray-300 dark:bg-gray-900 dark:ring-gray-900 dark:border-gray-800">
          

                {{-- TOPO --}}
                  <div class="flex flex-col rounded-t-xl gap-4 border-b border-gray-300  p-4 backdrop-blur-xl  dark:bg-gray-900 lg:flex-row lg:items-center lg:justify-between dark:border-gray-800">

             
                    
  <form method="GET" action="{{ route('tasks.index') }}" class="ml-auto flex flex-wrap items-center gap-3 text-gray-500">
                        <div class="relative">
                            <x-lucide-search class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500" />

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Pesquisar tarefa..."
                                class="w-72 rounded-lg border border-gray-300 bg-white py-2.5 pl-12 pr-4 text-sm text-gray-700 focus:border-red-700 focus:outline-none focus:ring-0.5 focus:ring-red-700 dark:bg-gray-900 dark:border-gray-800 dark:text-white "
                            >
                        </div>

                        <div class="flex items-center gap-2">

  {{-- STATUS --}}
<div
    x-data="{ open: false }"
    class="relative"
>
  <button
    type="button"
    @click="open = !open"
    @click.outside="open = false"
    class="relative flex h-10 w-10 items-center justify-center rounded-md transition-all duration-200 dark:bg-gray-900 dark:text-gray-500 dark:hover:bg-gray-800
    {{ request()->filled('status')
        ? 'bg-red-50 text-red-700'
        : 'bg-white text-gray-600 hover:bg-slate-100'
    }}"
    title="Filtrar status"
>
    <x-lucide-filter class="h-5 w-5" />

    @if(request()->filled('status'))
        <span class="absolute right-1.5 top-1.5 flex h-2.5 w-2.5">
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
            <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-red-600"></span>
        </span>
    @endif
</button>

    <div
    x-show="open"
    x-transition
    class="absolute right-0 z-50 mt-2 w-48 overflow-hidden rounded-xl border border-gray-200 bg-white py-1 shadow-xl"
    style="display:none;"
>
    <a
        href="{{ route('tasks.index', array_merge(request()->query(), ['status' => 'a_fazer'])) }}"
        class="block w-full px-4 py-2.5 text-left text-sm transition
        {{ request('status') === 'a_fazer'
            ? 'bg-red-50 font-medium text-red-700'
            : 'hover:bg-gray-50 text-gray-700' }}"
    >
        Pendentes
    </a>

    <a
        href="{{ route('tasks.index', array_merge(request()->query(), ['status' => 'fazendo'])) }}"
        class="block w-full px-4 py-2.5 text-left text-sm transition
        {{ request('status') === 'fazendo'
            ? 'bg-red-50 font-medium text-red-700'
            : 'hover:bg-gray-50 text-gray-700' }}"
    >
        Fazendo
    </a>

    <a
        href="{{ route('tasks.index', array_merge(request()->query(), ['status' => 'concluida'])) }}"
        class="block w-full px-4 py-2.5 text-left text-sm transition
        {{ request('status') === 'concluida'
            ? 'bg-red-50 font-medium text-red-700'
            : 'hover:bg-gray-50 text-gray-700' }}"
    >
        Concluídas
    </a>
</div>
</div>

    {{-- ORDENAÇÃO --}}
<div
    x-data="{ open: false }"
    class="relative"
>
<button
    type="button"
    @click="open = !open"
    @click.outside="open = false"
    class="relative flex h-10 w-10 items-center justify-center rounded-md transition-all duration-200
     dark:bg-gray-900 dark:text-gray-500 dark:hover:bg-gray-800
    {{ request('sort') === 'old'
    ? 'bg-red-50 text-red-700'
    : 'bg-white text-gray-600 hover:bg-slate-100'
    }}"
    title="Ordenar"
>
    <x-lucide-arrow-up-down class="h-5 w-5" />

  @if(request()->has('sort'))
    <span class="absolute right-1.5 top-1.5 flex h-2.5 w-2.5">
        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-red-600"></span>
    </span>
@endif
</button>

<div
    x-show="open"
    x-transition
    class="absolute right-0 z-50 mt-2 w-48 overflow-hidden rounded-xl border border-gray-200 bg-white py-1 shadow-xl"
    style="display:none;"
>
    <a
        href="{{ route('tasks.index', array_merge(request()->query(), ['sort' => 'recent'])) }}"
        class="block w-full px-4 py-2.5 text-left text-sm transition
        {{ request('sort', 'recent') === 'recent'
            ? 'bg-red-50 font-medium text-red-700'
            : 'hover:bg-gray-50 text-gray-700' }}"
    >
        Mais recentes
    </a>

    <a
        href="{{ route('tasks.index', array_merge(request()->query(), ['sort' => 'old'])) }}"
        class="block w-full px-4 py-2.5 text-left text-sm transition
        {{ request('sort') === 'old'
            ? 'bg-red-50 font-medium text-red-700'
            : 'hover:bg-gray-50 text-gray-700' }}"
    >
        Mais antigas
    </a>
</div>

</div>

</div>
@if(request()->hasAny(['search', 'status', 'sort']))
    <a
        href="{{ route('tasks.index') }}"
        class="flex h-10 w-10 items-center justify-center rounded-md border  bg-red-700 text-white transition-all hover:bg-white hover:text-red-700"
        title="Limpar filtros"
    >
        <x-lucide-x class="h-6 w-6" />
    </a>
@endif

                        <button
                            type="button"
                            @click="openCreateModal()"
                            class="ml-2 inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:bg-red-600"
                        >
                            Nova Tarefa
                            <x-lucide-plus class="h-4 w-4" />
                        </button>
                    </form></tr>
                 

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
    class="transition hover:bg-red-50/50 dark:hover:bg-red-900/10"
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
                                {{ \Illuminate\Support\Str::limit(strip_tags($task->description ?? ''), 120) ?: 'Sem descrição' }}
                        </p>

                    </div>

                </div>

            </td>

         
            {{-- STATUS PIPELINE INLINE --}}
<td class="px-0 py-0 text-center">
    <div class="flex flex-col items-center gap-1">

        <div
            role="radiogroup"
            aria-label="Fluxo de status"
            class="flex items-center justify-center"
        >

            {{-- A FAZER --}}
            <button
                type="button"
                role="radio"
                aria-label="Pendente"
                :aria-checked="statusToStep(statusPreview[{{ $task->id }}] ?? '{{ $task->status }}') === 1"
                :disabled="loadingTaskId === {{ $task->id }}"
                @click="setStatus({{ $task->id }}, '{{ $task->status }}', 'a_fazer')"
                class="flex h-7 w-7 items-center justify-center rounded-full border-2  transition disabled:opacity-50"
                :class="statusToStep(statusPreview[{{ $task->id }}] ?? '{{ $task->status }}') === 1
                    ? 'border-amber-500 bg-amber-500 text-white shadow-lg shadow-amber-500/30 dark:text-gray-900'
                    : 'border-slate-300 text-slate-400 dark:border-gray-500'"
            >

                <x-lucide-x class="h-3.5 w-3.5" />

            </button>

            {{-- LINHA --}}
            <span class="mx-1 h-0.5 w-6 rounded bg-slate-300 dark:bg-gray-500"></span>

            {{-- FAZENDO --}}
            <button
                type="button"
                role="radio"
                aria-label="Em andamento"
                :aria-checked="statusToStep(statusPreview[{{ $task->id }}] ?? '{{ $task->status }}') === 2"
                :disabled="loadingTaskId === {{ $task->id }}"
                @click="setStatus({{ $task->id }}, '{{ $task->status }}', 'fazendo')"
                class="flex h-7 w-7 items-center justify-center rounded-full border-2 transition disabled:opacity-50"
                :class="statusToStep(statusPreview[{{ $task->id }}] ?? '{{ $task->status }}') === 2
                    ? 'border-violet-500 bg-violet-500 text-white shadow-lg shadow-violet-500/30 dark:text-gray-900'
                    : 'border-slate-300 text-slate-400 dark:border-gray-500'"
            >

                <x-lucide-arrow-right class="h-3.5 w-3.5" />

            </button>

            {{-- LINHA --}}
            <span class="mx-1 h-0.5 w-6 rounded bg-slate-300 dark:bg-gray-500"></span>

            {{-- CONCLUÍDA --}}
            <button
                type="button"
                role="radio"
                aria-label="Concluída"
                :aria-checked="statusToStep(statusPreview[{{ $task->id }}] ?? '{{ $task->status }}') === 3"
                :disabled="loadingTaskId === {{ $task->id }}"
                @click="setStatus({{ $task->id }}, '{{ $task->status }}', 'concluida')"
                class="flex h-7 w-7 items-center justify-center rounded-full border-2 transition disabled:opacity-50"
                :class="statusToStep(statusPreview[{{ $task->id }}] ?? '{{ $task->status }}') === 3
                    ? 'border-emerald-500 bg-emerald-500 text-white shadow-lg shadow-emerald-500/30 dark:text-gray-900'
                    : 'border-slate-300 text-slate-400 dark:border-gray-500'"
            >

                <x-lucide-check class="h-3.5 w-3.5" />

            </button>

        </div>

    </div>
</td>
      

            {{-- PRIORIDADE INLINE --}}
            <td class="px-4 py-4 text-center">
                <div
                    role="radiogroup"
                    aria-label="Prioridade"
                    class="mx-auto flex w-max items-center justify-center gap-1"
                >
                    {{-- 1 estrela = baixa --}}
                    <button
                        type="button"
                        role="radio"
                        aria-label="Baixa"
                        :aria-checked="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') === 1"
                        :disabled="loadingTaskId === {{ $task->id }}"
                        @click="setPriority({{ $task->id }}, '{{ $task->priority }}', 1)"
                        class="rounded-md p-0.5 "
                    >
                        <x-lucide-star
                            class="h-6 w-6"
                            x-bind:class="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') >= 1 ? 'text-amber-500' : 'text-amber-300'"
                            x-bind:fill="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') >= 1 ? 'currentColor' : 'none'"
                            stroke-width="1.75"
                        />
                    </button>

                    {{-- 2 estrelas = média --}}
                    <button
                        type="button"
                        role="radio"
                        aria-label="Média"
                        :aria-checked="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') === 2"
                        :disabled="loadingTaskId === {{ $task->id }}"
                        @click="setPriority({{ $task->id }}, '{{ $task->priority }}', 2)"
                        class="rounded-md p-0.5 "
                    >
                        <x-lucide-star
                            class="h-6 w-6"
                            x-bind:class="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') >= 2 ? 'text-amber-500' : 'text-amber-300'"
                            x-bind:fill="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') >= 2 ? 'currentColor' : 'none'"
                            stroke-width="1.75"
                        />
                    </button>

                    {{-- 3 estrelas = alta --}}
                    <button
                        type="button"
                        role="radio"
                        aria-label="Alta"
                        :aria-checked="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') === 3"
                        :disabled="loadingTaskId === {{ $task->id }}"
                        @click="setPriority({{ $task->id }}, '{{ $task->priority }}', 3)"
                        class="rounded-md p-0.5 "
                    >
                        <x-lucide-star
                            class="h-6 w-6"
                            x-bind:class="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') >= 3 ? 'text-amber-500' : 'text-amber-300'"
                            x-bind:fill="priorityToNumber(priorityPreview[{{ $task->id }}] ?? '{{ $task->priority }}') >= 3 ? 'currentColor' : 'none'"
                            stroke-width="1.75"
                        />
                    </button>
                </div>
            </td>

            {{-- DATA --}}
          <td class="px-4 py-4 text-center">

          <style>
    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        position: absolute;
        right: 0;
        width: 40px;
        height: 100%;
        cursor: pointer;
    }
</style>

<div class="relative w-fit">

    <input
        type="date"
        value="{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '' }}"
        @change="updateField({{ $task->id }}, 'deadline', $event.target.value)"
        :disabled="loadingTaskId === {{ $task->id }}"
        class="
            rounded
            border
            border-gray-300
            bg-white
            px-3
            py-2
            pr-5
            text-sm
            focus:ring-0
            dark:bg-gray-900
            dark:text-white
            dark:border-gray-500
        "
    >

    {{-- ÍCONE PERSONALIZADO --}}
    <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
        <x-lucide-calendar class="w-4 h-4 dark:text-white" />
    </div>

</div>

 

</td>

            {{-- AÇÕES --}}
            <td class="text-center">

                <div class="flex justify-center items-center gap-4 whitespace-nowrap">


                    {{-- EDITAR COMPLETO --}}
                     <button
                        type="button"
                        aria-label="Editar tarefa {{ $task->title }}"
                        @click="openEditModal({{ Js::from($task) }})"
                       class="flex items-center"
                       title="Editar texto da tarefa"
                    >
                        <x-lucide-message-square-text
                            class="h-5 w-5 text-gray-500 hover:text-gray-900 cursor-pointer transition"
                        />
                    </button>
                    
                    {{-- EXCLUIR TASK --}}
<button
    @click="deleteTask({{ $task->id }})"
    class="flex items-center"
    type="button"
    aria-label="Excluir tarefa {{ $task->title }}"
    title="Excluir tarefa"

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

    @if ($tasks->hasPages())
        <div class="border-t border-gray-200 p-4">
            {{ $tasks->links() }}
        </div>
    @endif

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
            tasksData: {},


            isCreateOpen: false,
            isEditOpen: false,
        

            loadingTaskId: null,
            deletingTaskId: null,
            priorityPreview: {},
            statusPreview: {},

            form: {},
            formAction: '',
            formMethod: 'POST',

         

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

                    if (data.success) {
                        this.updateLocalTask(taskId, field, value);
}

                    if (!data.success) {
                        console.error(data.message);
                    }

                    return data;

                } catch (error) {

                    console.error(error);

                    return { success: false };

                } finally {

                    setTimeout(() => {
                        this.loadingTaskId = null;
                    }, 300);
                }
            },

            // =========================
            // PRIORIDADE (Stars)
            // =========================
            priorityToNumber(priority) {
                return priority === 'baixa'
                    ? 1
                    : priority === 'media'
                    ? 2
                    : priority === 'alta'
                    ? 3
                    : 0;
            },

            async setPriority(taskId, serverPriority, level) {
                const nextPriority = level === 1
                    ? 'baixa'
                    : level === 2
                    ? 'media'
                    : 'alta';

                // Atualiza UI imediatamente (sem reload)
                this.priorityPreview[taskId] = nextPriority;

                const res = await this.updateField(taskId, 'priority', nextPriority);
                if (!res?.success) {
                    // Reverte se houver erro
                    this.priorityPreview[taskId] = serverPriority;
                }
            },

            // =========================
            // STATUS PIPELINE
            // =========================
            statusToStep(status) {
                return status === 'a_fazer'
                    ? 1
                    : status === 'fazendo'
                    ? 2
                    : status === 'concluida'
                    ? 3
                    : 1;
            },


            async setStatus(taskId, serverStatus, nextStatus) {
                this.statusPreview[taskId] = nextStatus;
                const res = await this.updateField(taskId, 'status', nextStatus);
                if (!res?.success) {
                    this.statusPreview[taskId] = serverStatus;
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

            updateLocalTask(taskId, field, value) {

                if (!this.tasksData[taskId]) {
                    this.tasksData[taskId] = {};
                }

                this.tasksData[taskId][field] = value;
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
            },

            // =========================
            // MODAL EDITAR
            // =========================
            openEditModal(task) {

                 console.log('DEADLINE:', task.deadline);

                this.formAction = `/tasks/${task.id}`;
                this.formMethod = 'PUT';

                const localTask = this.tasksData[task.id] ?? {};

                this.form = {
                    title: localTask.title ?? task.title ?? '',
                    description: localTask.description ?? task.description ?? '',
                    status: localTask.status ?? task.status ?? 'a_fazer',
                    priority: localTask.priority ?? task.priority ?? 'media',
                    deadline: localTask.deadline
                        ?? (task.deadline ? task.deadline.split('T')[0] : '')
                };

                

                this.isEditOpen = true;
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
             blockImagePaste(event) {
                const items = event.clipboardData?.items ?? [];

                 for (const item of items) {
                    if (item.type.startsWith('image/')) {
                        event.preventDefault();
                        alert('Envie imagens como anexos; colagem direta não é permitida.');
                        return;
                    }
                }
            }
        }
    }
</script>
</x-app-layout>