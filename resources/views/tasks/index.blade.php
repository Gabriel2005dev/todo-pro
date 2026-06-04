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
            <div class="overflow-visible rounded-xl bg-white shadow-sm ring-1 border border-gray-300 ring-gray-100 dark:bg-gray-900 dark:ring-gray-800">

                {{-- TOPO --}}
                <div class="flex flex-col rounded-t-xl gap-4 border-b border-gray-300 bg-white/80 p-4 backdrop-blur-xl dark:border-gray-800 dark:bg-[#18181b]/80 lg:flex-row lg:items-center lg:justify-between">

             
                    
  <form method="GET" action="{{ route('tasks.index') }}" class="ml-auto flex flex-wrap items-center gap-3 text-gray-500">
                        <div class="relative">
                            <x-lucide-search class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-500" />

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Pesquisar tarefa..."
                                class="w-72 rounded-lg border border-gray-300 bg-white py-2.5 pl-12 pr-4 text-sm text-gray-700 focus:border-red-700 focus:outline-none focus:ring-0.5 focus:ring-red-700"
                            >
                        </div>

                        <select
                            name="status"
                            class="rounded-lg border border-gray-300 bg-white py-2.5 text-sm text-gray-700 focus:border-red-700 focus:ring-0.5 focus:ring-red-700"
                            aria-label="Filtrar por status"
                        >
                            <option value="">Todos os status</option>
                            <option value="a_fazer" @selected(request('status') === 'a_fazer')>Pendentes</option>
                            <option value="fazendo" @selected(request('status') === 'fazendo')>Fazendo</option>
                            <option value="concluida" @selected(request('status') === 'concluida')>Concluídas</option>
                        </select>

                        <select
                            name="sort"
                            class="rounded-lg border border-gray-300 bg-white py-2.5 text-sm text-gray-700 focus:border-red-700 focus:ring-0.5 focus:ring-red-700"
                            aria-label="Ordenar tarefas"
                        >
                            <option value="recent" @selected(request('sort', 'recent') === 'recent')>Mais recentes</option>
                            <option value="old" @selected(request('sort') === 'old')>Mais antigas</option>
                        </select>

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded bg-gray-800 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:bg-gray-700"
                        >
                            Aplicar
                        </button>

                        @if(request()->hasAny(['search', 'status', 'sort']))
                            <a href="{{ route('tasks.index') }}" class="text-sm font-semibold text-rose-600 hover:text-rose-700">
                                Limpar
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
                class="flex h-7 w-7 items-center justify-center rounded-full border-2 transition disabled:opacity-50"
                :class="statusToStep(statusPreview[{{ $task->id }}] ?? '{{ $task->status }}') === 1
                    ? 'border-amber-500 bg-amber-500 text-white shadow-lg shadow-amber-500/30'
                    : 'border-slate-300 bg-white text-slate-400'"
            >

                <x-lucide-x class="h-3.5 w-3.5" />

            </button>

            {{-- LINHA --}}
            <span class="mx-1 h-0.5 w-6 rounded bg-slate-300"></span>

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
                    ? 'border-violet-500 bg-violet-500 text-white shadow-lg shadow-violet-500/30'
                    : 'border-slate-300 bg-white text-slate-400'"
            >

                <x-lucide-arrow-right class="h-3.5 w-3.5" />

            </button>

            {{-- LINHA --}}
            <span class="mx-1 h-0.5 w-6 rounded bg-slate-300"></span>

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
                    ? 'border-emerald-500 bg-emerald-500 text-white shadow-lg shadow-emerald-500/30'
                    : 'border-slate-300 bg-white text-slate-400'"
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

    <input
        type="date"
        value="{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '' }}"
        @change="updateField({{ $task->id }}, 'deadline', $event.target.value)"
        :disabled="loadingTaskId === {{ $task->id }}"
        class="
            rounded-lg
            border
            border-gray-300
            bg-white
            px-2
            py-1
            text-sm
            focus:border-violet-500
            focus:ring-0
        "
    >

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