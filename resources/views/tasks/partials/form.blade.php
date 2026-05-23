<div>
    <div x-show="isCreateOpen || isEditOpen" x-transition class="fixed inset-0 z-40 bg-black/40"></div>

    <div x-show="isCreateOpen || isEditOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click.away="isCreateOpen = false; isEditOpen = false"
            class="w-full max-w-lg rounded-lg bg-white p-6 shadow-2xl dark:bg-gray-900">

            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white"
                    x-text="isEditOpen ? 'Editar tarefa' : 'Nova tarefa'"></h3>

                <button type="button"
                    @click="isCreateOpen = false; isEditOpen = false"
                    class="text-gray-500 transition hover:text-red-500">
                    <x-lucide-x class="h-5 w-5" />
                </button>
            </div>

            <form :action="formAction" method="POST" class="mt-5 space-y-5">
                @csrf

                <template x-if="formMethod === 'PUT'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                {{-- TÍTULO --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Título
                    </label>

                    <input x-model="form.title"
                        name="title"
                        type="text"
                        required
                        class="w-full rounded-md border-gray-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-violet-500 focus:ring-violet-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                </div>

                {{-- DESCRIÇÃO --}}
                <div>
                    <label class="mb-2 block text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Descrição
                    </label>

                    <div class="overflow-hidden rounded-md border border-gray-300 dark:border-gray-700">

                        {{-- TOOLBAR --}}
                        <div
                            class="flex flex-wrap items-center gap-1 border-b border-gray-200 bg-gray-50 p-2 dark:border-gray-700 dark:bg-gray-800">

                            <button type="button"
                                onclick="document.execCommand('bold', false, '')"
                                class="rounded-lg p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-bold class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <button type="button"
                                onclick="document.execCommand('italic', false, '')"
                                class="rounded-lg p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-italic class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <button type="button"
                                onclick="document.execCommand('underline', false, '')"
                                class="rounded-lg p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-underline class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-600"></div>

                            <button type="button"
                                onclick="document.execCommand('insertUnorderedList', false, '')"
                                class="rounded-lg p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-list class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <button type="button"
                                onclick="document.execCommand('insertOrderedList', false, '')"
                                class="rounded-lg p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-list-ordered class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <div class="mx-1 h-5 w-px bg-gray-300 dark:bg-gray-600"></div>

                            <button type="button"
                                onclick="document.execCommand('justifyLeft', false, '')"
                                class="rounded-lg p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-align-left class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <button type="button"
                                onclick="document.execCommand('justifyCenter', false, '')"
                                class="rounded-lg p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-align-center class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>

                            <button type="button"
                                onclick="document.execCommand('justifyRight', false, '')"
                                class="rounded-lg p-2 transition hover:bg-gray-200 dark:hover:bg-gray-700">

                                <x-lucide-align-right class="h-4 w-4 text-gray-700 dark:text-gray-200" />
                            </button>
                        </div>

                        {{-- EDITOR --}}
                        <div contenteditable="true"
                            id="editor"
                            oninput="document.getElementById('description').value = this.innerHTML"
                            class="min-h-[250px] w-full bg-white p-4 text-sm text-gray-700 outline-none dark:bg-gray-900 dark:text-gray-200">
                        </div>

                        <textarea x-model="form.description"
                            name="description"
                            id="description"
                            class="hidden"></textarea>
                    </div>
                </div>

                {{-- CAMPOS --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Status
                        </label>

                        <select x-model="form.status"
                            name="status"
                            class="w-full rounded-md    px-4
                            py-2 border-gray-300 bg-white text-xs shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

                            <option value="a_fazer">Pendente</option>
                            <option value="fazendo">Em andamento</option>
                            <option value="concluida">Concluída</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200">
                            Prioridade
                        </label>

                        <select x-model="form.priority"
                            name="priority"
                            class="w-full rounded-md    px-4
                            py-2 border-gray-300 bg-white text-xs shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white">

                            <option value="baixa">Baixa</option>
                            <option value="media">Média</option>
                            <option value="alta">Alta</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xm font-semibold text-gray-700 dark:text-gray-200">
                            Prazo
                        </label>

                        <input x-model="form.deadline"
                            name="deadline"
                            type="date"
                            class="w-full rounded-md    px-4
                            py-2 border-gray-300 bg-white text-xs sha dow-sm focus:border-violet-500 focus:ring-violet-500 dark:border-gray-700 dark:bg-gray-800 dark:text-white" />
                    </div>
                </div>

                {{-- BOTÕES --}}
                <div class="mt-6 flex items-center justify-end gap-3">

                  <button
                            typer="submit"
                            class="
                            ml-2
                            inline-flex
                            items-center
                            gap-2
                            rounded-md
                            bg-violet-900
                            px-4
                            py-2
                            text-xs
                            font-semibold
                            text-white
                            shadow-lg
                            shadow-violet-500/20
                            transition-all
                            duration-200
                            hover:-translate-y-0.5
                            hover:bg-violet-700
                            hover:shadow-violet-500/30
                            active:scale-95
                        ">
                            Adicionar tarefa 
                            <x-lucide-plus class="h-4 w-4" />
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>