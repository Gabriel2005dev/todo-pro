<div>
    <div x-show="isCreateOpen || isEditOpen" x-transition class="fixed inset-0 z-40 bg-black/40"></div>

    <div x-show="isCreateOpen || isEditOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click.away="isCreateOpen = false; isEditOpen = false" class="w-full max-w-2xl rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white" x-text="isEditOpen ? 'Editar tarefa' : 'Nova tarefa'"></h3>

            <form :action="formAction" method="POST" class="mt-5 space-y-4">
                @csrf
                <template x-if="formMethod === 'PUT'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div>
                    <label class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Título</label>
                    <input x-model="form.title" name="title" type="text" required class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500" />
                </div>

                <div>
                    <label class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Descrição</label>
                    <textarea x-model="form.description" name="description" rows="3" class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500"></textarea>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Status</label>
                        <select x-model="form.status" name="status" class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500">
                            <option value="a_fazer">Pendente</option>
                            <option value="fazendo">Em andamento</option>
                            <option value="concluida">Concluída</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Prioridade</label>
                        <select x-model="form.priority" name="priority" class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500">
                            <option value="baixa">Baixa</option>
                            <option value="media">Média</option>
                            <option value="alta">Alta</option>
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-sm font-semibold text-gray-700 dark:text-gray-200">Prazo</label>
                        <input x-model="form.deadline" name="deadline" type="date" class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500" />
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-2">
                    <button type="button" @click="isCreateOpen = false; isEditOpen = false" class="rounded-xl border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100">Cancelar</button>
                    <button type="submit" class="rounded-xl bg-violet-600 px-4 py-2 text-sm font-semibold text-white hover:bg-violet-700">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="isViewOpen" x-transition class="fixed inset-0 z-40 bg-black/40"></div>
    <div x-show="isViewOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div @click.away="isViewOpen = false" class="w-full max-w-xl rounded-2xl bg-white p-6 shadow-2xl dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Detalhes da tarefa</h3>
                <button @click="isViewOpen = false" class="text-gray-500 hover:text-gray-700">✕</button>
            </div>

            <div class="mt-4 space-y-3 text-sm">
                <p><span class="font-semibold">Título:</span> <span x-text="selectedTask?.title"></span></p>
                <p><span class="font-semibold">Descrição:</span> <span x-text="selectedTask?.description || 'Sem descrição'"></span></p>
                <p><span class="font-semibold">Status:</span> <span x-text="statusLabel(selectedTask?.status)"></span></p>
                <p><span class="font-semibold">Prioridade:</span> <span x-text="selectedTask?.priority"></span></p>
                <p><span class="font-semibold">Prazo:</span> <span x-text="selectedTask?.deadline || 'Sem prazo'"></span></p>
                <p><span class="font-semibold">Criada em:</span> <span x-text="selectedTask?.created_at"></span></p>
            </div>
        </div>
    </div>
</div>