<div>

    {{-- OVERLAY --}}
    <div x-show="isCreateOpen || isEditOpen"
        x-transition.opacity
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm">
    </div>

    {{-- MODAL --}}
    <div x-show="isCreateOpen || isEditOpen"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center p-6">

        <div
            class="relative w-full p-6  max-w-lg overflow-visible rounded-xl border border-white/10 bg-white shadow-2xl dark:border-gray-800 dark:bg-[#0f172a]">

            {{-- HEADER --}}
            <div
                class="flex items-center justify-between">

                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white"
                        x-text="isEditOpen ? 'Editar tarefa' : 'Nova tarefa'">
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Organize suas tarefas de forma profissional.
                    </p>
                </div>

                <button
                    type="button"
                    @click="closeModal()"
                    class="rounded-md text-gray-500 transition hover:bg-red-500/10 hover:text-red-500">

                    <x-lucide-x class="h-5 w-5" />
                </button>
            </div>

            {{-- FORM --}}
            <form :action="formAction" method="POST" class="space-y-6 ">

                @csrf

                <template x-if="formMethod === 'PUT'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                {{-- TÍTULO --}}
                <div>
                    <label
                        class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Título
                    </label>

                    <input
                        x-model="form.title"
                        name="title"
                        type="text"
                        required
                        placeholder="Digite o título da tarefa..."
                        class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm shadow-sm outline-none transition-all">
                </div>

                {{-- DESCRIÇÃO --}}
                <div>

                    <label
                        class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Descrição
                    </label>

                    <div
                        class="overflow-hidden rounded-md border border-gray-300 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">

                        {{-- TOOLBAR --}}
                        <div
                            class="sticky top-0 z-10 flex flex-wrap items-center gap-1 border-b border-gray-200 bg-gray-50 p-1 dark:border-gray-700 dark:bg-gray-800">

                            {{-- BOLD --}}
                            <button type="button"
                                @click="format('bold')"
                                class="rounded-md p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-bold class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            {{-- ITALIC --}}
                            <button type="button"
                                @click="format('italic')"
                                class="rounded-md p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-italic class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            {{-- UNDERLINE --}}
                            <button type="button"
                                @click="format('underline')"
                                class="rounded-md p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-underline class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-600"></div>

                            {{-- LIST --}}
                            <button type="button"
                                @click="format('insertUnorderedList')"
                                class="rounded-md p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-list class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            {{-- ORDERED --}}
                            <button type="button"
                                @click="format('insertOrderedList')"
                                class="rounded-md p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-list-ordered class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-600"></div>

                            {{-- LEFT --}}
                            <button type="button"
                                @click="format('justifyLeft')"
                                class="rounded-md p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-align-left class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            {{-- CENTER --}}
                            <button type="button"
                                @click="format('justifyCenter')"
                                class="rounded-md p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-align-center class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            {{-- RIGHT --}}
                            <button type="button"
                                @click="format('justifyRight')"
                                class="rounded-md p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-align-right class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>
                        </div>

                        {{-- EDITOR --}}
                        <div
                            id="editor"
                            contenteditable="true"
                            @input="syncEditor()"
                            class="min-h-[260px] max-h-[400px] overflow-y-auto break-all whitespace-pre-wrap p-3 text-sm leading-7 text-gray-700 outline-none dark:text-gray-200">
                        </div>
                                            

                        <textarea
                            x-model="form.description"
                            name="description"
                            id="description"
                            class="hidden">
                        </textarea>
                    </div>
                </div>

                {{-- CAMPOS --}}
               
                    <div
    x-show="isCreateOpen"
    x-transition
    class="grid grid-cols-1 gap-4 md:grid-cols-3"
>

    {{-- STATUS --}}
    <div
        x-data="{ open: false }"
        class="relative"
    >

        <label
            class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
            Status
        </label>

        {{-- BUTTON --}}
        <button
            type="button"
            @click="open = !open"
            class="flex w-full items-center justify-between rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm transition-all "
        >

            <div class="flex items-center gap-2">


                <span
                    x-text="
                        form.status === 'a_fazer'
                        ? 'Pendente'
                        : form.status === 'fazendo'
                        ? 'Em andamento'
                        : 'Concluída'
                    "
                ></span>

            </div>

            <x-lucide-chevron-down
                class="h-4 w-4 text-gray-400 transition"
                x-bind:class="open ? 'rotate-180' : ''"
            />

        </button>

        {{-- DROPDOWN --}}
        <div
            x-show="open"
            x-transition
            @click.outside="open = false"
            class="absolute left-0 top-full z-50 mt-2 w-full rounded-md border border-gray-300 bg-white p-1 shadow-xl dark:border-gray-700 dark:bg-gray-900"
        >

            <button
                type="button"
                @click="form.status = 'a_fazer'; open = false"
                class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800"
            >
              
                Pendente
            </button>

            <button
                type="button"
                @click="form.status = 'fazendo'; open = false"
                class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800"
            >

                Fazendo
            </button>

            <button
                type="button"
                @click="form.status = 'concluida'; open = false"
                class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm text-gray-700 transition hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800"
            >
           
                Concluída
            </button>

        </div>

        <input
            type="hidden"
            name="status"
            x-model="form.status"
        >
    </div>

    {{-- PRIORIDADE (Stars) --}}
    <div class="relative">
        <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
            Prioridade
        </label>

        <div
            role="radiogroup"
            aria-label="Prioridade da tarefa"
            class="flex items-center gap-1"
        >
            {{-- Baixa = 1 estrela --}}
            <button
                type="button"
                role="radio"
                aria-label="Baixa"
                :aria-checked="form.priority === 'baixa'"
                @click="form.priority = 'baixa'"
                class="rounded-md p-0.5 transition hover:bg-slate-100 dark:hover:bg-slate-800"
            >
                <x-lucide-star
                    class="h-6 w-6"
                    x-bind:class="(form.priority === 'baixa' || form.priority === 'media' || form.priority === 'alta') ? 'text-amber-500' : 'text-amber-300'"
                    x-bind:fill="(form.priority === 'baixa' || form.priority === 'media' || form.priority === 'alta') ? 'currentColor' : 'none'"
                    stroke-width="1.75"
                />
            </button>

            {{-- Média = 2 estrelas --}}
            <button
                type="button"
                role="radio"
                aria-label="Média"
                :aria-checked="form.priority === 'media'"
                @click="form.priority = 'media'"
                class="rounded-md p-0.5 transition hover:bg-slate-100 dark:hover:bg-slate-800"
            >
                <x-lucide-star
                    class="h-6 w-6"
                    x-bind:class="(form.priority === 'media' || form.priority === 'alta') ? 'text-amber-500' : 'text-amber-300'"
                    x-bind:fill="(form.priority === 'media' || form.priority === 'alta') ? 'currentColor' : 'none'"
                    stroke-width="1.75"
                />
            </button>

            {{-- Alta = 3 estrelas --}}
            <button
                type="button"
                role="radio"
                aria-label="Alta"
                :aria-checked="form.priority === 'alta'"
                @click="form.priority = 'alta'"
                class="rounded-md p-0.5 transition hover:bg-slate-100 dark:hover:bg-slate-800"
            >
                <x-lucide-star
                    class="h-6 w-6"
                    x-bind:class="(form.priority === 'alta') ? 'text-amber-500' : 'text-amber-300'"
                    x-bind:fill="(form.priority === 'alta') ? 'currentColor' : 'none'"
                    stroke-width="1.75"
                />
            </button>
        </div>

        <input type="hidden" name="priority" x-model="form.priority">
    </div>

    {{-- PRAZO --}}
    <div>

        <label
            class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
            Prazo
        </label>

        <input
            x-model="form.deadline"
            name="deadline"
            type="date"
            class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm transition-all"
        >
    </div>

</div>

                {{-- FOOTER --}}
                <div
                    class="flex flex-col-reverse   sm:flex-row sm:justify-end">

                

                    <button
                        type="submit"
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
                            shadow-lg">

                        <span x-text="isEditOpen ? 'Salvar alterações' : 'Criar tarefa'"></span>

                        <x-lucide-check class="h-4 w-4" />
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function taskModal() {
        return {

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

            closeModal() {

                this.isCreateOpen = false;
                this.isEditOpen = false;
            }
        }
    }
</script>