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

        <div class="relative w-full max-w-lg overflow-visible rounded-xl border border-white/10 bg-white p-6 shadow-2xl dark:border-gray-800 dark:bg-[#0f172a]">

        

            {{-- HEADER --}}
            <div class="flex items-start justify-between">

                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white" x-text="isEditOpen ?        'Editar usuário' : 'Novo usuário'">
                    </h2>

                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400" x-text="isEditOpen ? 'Atualize os dados do usuário' : 'Crie uma nova conta administrativa ou comum'">
                    </p>

                </div>

                <button type="button"
                        aria-label="Fechar modal de usuário"
                        @click="closeModal()"
                        class="rounded p-1 text-gray-500 transition hover:bg-red-500/10 hover:text-red-700">

                    <x-lucide-x class="h-5 w-5" />
                </button>

            </div>

            {{-- FORM --}}
            <form :action="formAction"
                  method="POST"
                  class="mt-6 flex flex-col gap-4"
                  x-data="{
                        showPassword: false,
                        showConfirm: false,
                        showCurrentAdminPassword: false
                        
                  }">

                @csrf

                <template x-if="formMethod === 'PUT'">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <input type="hidden" name="is_admin" :value="form.is_admin ? 1 : 0">

                
                
                {{-- NOME --}}
                <div class="space-y-1.5">
                    <label for="admin-user-name" class="text-sm font-semibold text-gray-700 dark:text-gray-200">Nome</label>
                   
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <x-lucide-user class="h-5 w-5" />
                        </span>

                        <input x-model="form.name"
                               id="admin-user-name"
                               name="name"
                               type="text"
                               required
                               class="mt-1 block w-full rounded border-gray-300 pl-12 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-red-700 focus:ring-red-700">
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="space-y-1.5">
                    <label for="admin-user-email" class="text-sm font-semibold text-gray-700 dark:text-gray-200">Email</label>
                    

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <x-lucide-mail class="h-5 w-5" />
                        </span>

                        <input x-model="form.email"
                               id="admin-user-email"
                               name="email"
                               type="email"
                               required
                               class="mt-1 block w-full rounded border-gray-300 pl-12 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-red-700 focus:ring-red-700">
                    </div>
                </div>


                  {{-- SENHA --}}
                <div class="space-y-1.5">
                    <label for="admin-user-password" class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                        <span x-text="isEditOpen ? 'Nova senha' : 'Senha'"></span>
                    </label>

                
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <x-lucide-lock class="h-5 w-5" />
                        </span>

               
                        <input
                            x-model="form.password"
                            id="admin-user-password"
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            :required="isCreateOpen"
                            autocomplete="new-password"
                            class="mt-1 block w-full rounded border-gray-300 pl-12 pr-10 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-red-700 focus:ring-red-700">

                        <button type="button"
                                aria-label="Alternar visibilidade da senha"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <template x-if="showPassword">
                                <x-lucide-eye class="h-5 w-5" />
                            </template>

                            <template x-if="!showPassword">
                                <x-lucide-eye-off class="h-5 w-5" />
                            </template>
                        </button>
                    </div>
                </div>



                

                

               

                <div class="space-y-1.5">
                        <label for="admin-user-password-confirmation" class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Confirmar senha
                    </label>

                          <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <x-lucide-shield-check class="h-5 w-5" />
                        </span>

                        <input
                            x-model="form.password_confirmation"
                            id="admin-user-password-confirmation"
                            :type="showConfirm ? 'text' : 'password'"
                            name="password_confirmation"
                            :required="isCreateOpen"
                            autocomplete="new-password"
                            class="mt-1 block w-full rounded border-gray-300 pl-12 pr-10 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-red-700 focus:ring-red-700">

                        <button type="button"
                                aria-label="Alternar visibilidade da confirmação de senha"
                                @click="showConfirm = !showConfirm"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <template x-if="showConfirm">
                                <x-lucide-eye class="h-5 w-5" />
                            </template>

                            <template x-if="!showConfirm">
                                <x-lucide-eye-off class="h-5 w-5" />
                            </template>
                        </button>
                    </div>
                </div>


                <div class="space-y-1.5" x-show="isEditOpen && form.password.length > 0">
                    <label for="current-admin-password" class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Confirme sua senha de administrador
                    </label>

                     <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <x-lucide-key-round class="h-5 w-5" />
                        </span>

                    <input
                            x-model="form.current_admin_password"
                            id="current-admin-password"
                            :type="showCurrentAdminPassword ? 'text' : 'password'"
                            name="current_admin_password"
                            autocomplete="current-password"
                            class="mt-1 block w-full rounded border-gray-300 pl-12 pr-10 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-red-700 focus:ring-red-700">

                        <button type="button"
                                aria-label="Alternar visibilidade da senha atual"
                                @click="showCurrentAdminPassword = !showCurrentAdminPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <template x-if="showCurrentAdminPassword">
                                <x-lucide-eye class="h-5 w-5" />
                            </template>

                            <template x-if="!showCurrentAdminPassword">
                                <x-lucide-eye-off class="h-5 w-5" />
                            </template>
                        </button>
                    </div>

                    <p class="text-xs text-gray-500">Obrigatório para alterar a senha de outro usuário.</p>

                </div>

                {{-- PERFIL PIPELINE INLINE --}}
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                        Perfil de acesso
                    </label>

                    <div class="flex flex-col items-center gap-2">
                        <div
                            role="radiogroup"
                            aria-label="Tipo de usuário"
                            class="flex items-center justify-center"
                        >
                            <button
                                type="button"
                                role="radio"
                                aria-label="Usuário"
                                :aria-checked="form.is_admin == 0"
                                @click="form.is_admin = 0"
                                class="flex h-10 w-10 items-center justify-center rounded-full border-2 transition"
                                :class="form.is_admin == 0
                                    ? 'bg-blue-700 text-white'
                                    : 'bg-white text-slate-400 dark:bg-gray-950 dark:border-gray-700'"
                            >
                                <x-lucide-user class="h-5 w-5" />
                            </button>

                            <span class="mx-2 h-0.5 w-6 rounded bg-slate-300 dark:bg-gray-700"></span>

                            <button
                                type="button"
                                role="radio"
                                aria-label="Administrador"
                                :aria-checked="form.is_admin == 1"
                                @click="form.is_admin = 1"
                                class="flex h-10 w-10 items-center justify-center rounded-full border-2 transition"
                                :class="form.is_admin == 1
                                    ? ' bg-red-700 text-white'
                                    : ' bg-white text-slate-400 dark:bg-gray-950 dark:border-gray-700'"
                            >
                                <x-lucide-shield class="h-5 w-5" />
                            </button>
                        </div>

                        <div class="flex w-full justify-center gap-10 text-xs text-gray-500 dark:text-gray-400">
                            <span>Usuário</span>
                            <span>Admin</span>
                        </div>
                    </div>
                </div>


                {{-- FOOTER --}}
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button"
                            @click="closeModal()"
                            class="rounded bg-gray-200 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-300 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        Cancelar
                    </button>

                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded bg-red-700 px-4 py-2 text-sm font-semibold text-white shadow transition hover:bg-red-600">
                        <span x-text="isEditOpen ? 'Salvar' : 'Criar usuário'"></span>
                        <x-lucide-check class="h-4 w-4" />
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>