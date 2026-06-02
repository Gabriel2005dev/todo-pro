<div >
    <nav
     class="fixed top-0 bottom-0 bg-white rounded-xl m-4 border border-gray-300
            flex flex-col justify-between  p-2 transition-all duration-300"
     :class="sidebarOpen ? 'w-64' : 'w-16'">

    {{-- TOGGLE BUTTON --}}
    <button
        @click="sidebarOpen = !sidebarOpen"
        class="absolute top-1/2 -right-4 w-8 h-8 bg-white text-gray-700
               rounded-full bg-white flex items-center justify-center
               border border-gray-300 hover:scale-105 transition">

        <x-lucide-chevron-left class="w-6 h-6" x-show="sidebarOpen" />
        <x-lucide-chevron-right class="w-6 h-6" x-show="!sidebarOpen" />
    </button>

    {{-- TOPO --}}
    <div class="flex flex-col h-full justify-between">

        <div class="space-y-0">

            {{-- LOGO --}}
            <a class="flex items-center">
                <div class="flex items-center">
                    <x-application-logo class="block h-12 w-auto fill-current text-gray-800" />

                    <span class="font-semibold transition-all duration-200"
                          x-show="sidebarOpen"
                          x-transition>
                        TodoPro
                    </span>
                </div>
            </a>

            <div class="border-t border-gray-300 pt-1"></div>

            {{-- MENU --}}
            <div class="space-y-2">

                {{-- DASHBOARD --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center rounded transition py-3
                   {{ request()->routeIs('dashboard')
                        ? 'bg-red-700 text-white shadow-lg'
                        : 'text-gray-700 hover:bg-red-100' }}"
                   :class="sidebarOpen ? 'justify-start px-4' : 'justify-center px-2'">

                    <div class="flex items-center" :class="sidebarOpen ? 'gap-3' : 'gap-0'">
                        <x-lucide-home class="w-5 h-5" />
                        <span class="font-medium text-sm" x-show="sidebarOpen" x-transition>
                            Dashboard
                        </span>
                    </div>
                </a>

                {{-- TASKS --}}
                <a href="{{ route('tasks.index') }}"
                   class="flex items-center rounded transition py-3
                   {{ request()->routeIs('tasks.*')
                        ? 'bg-red-700 text-white shadow-lg'
                        : 'text-gray-700 hover:bg-red-100' }}"
                   :class="sidebarOpen ? 'justify-start px-4' : 'justify-center px-2'">

                    <div class="flex items-center" :class="sidebarOpen ? 'gap-3' : 'gap-0'">
                        <x-lucide-clipboard-list class="w-5 h-5" />
                        <span class="font-medium text-sm" x-show="sidebarOpen" x-transition>
                            Tarefas
                        </span>
                    </div>
                </a>

                  @if (Auth::user()->is_admin)
                    {{-- ADMIN USERS --}}
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center rounded transition py-3
                       {{ request()->routeIs('admin.users.*')
                            ? 'bg-red-700 text-white shadow-lg'
                            : 'text-gray-700 hover:bg-red-100' }}"
                       :class="sidebarOpen ? 'justify-start px-4' : 'justify-center px-2'">

                        <div class="flex items-center" :class="sidebarOpen ? 'gap-3' : 'gap-0'">
                            <x-lucide-users-round class="w-5 h-5" />
                            <span class="font-medium text-sm" x-show="sidebarOpen" x-transition>
                                Usuários
                            </span>
                        </div>
                    </a>
                @endif







            </div>
        </div>
        {{-- RODAPÉ --}}
<x-dropdown align="top" width="64" class="z-50">
    <x-slot name="trigger">
  <button
    @click="sidebarOpen = true"
    class="w-full flex items-center rounded-lg hover:bg-gray-100 transition py-3 overflow-hidden"
    :class="sidebarOpen ? 'px-3 gap-3' : 'justify-center px-1'">

            {{-- AVATAR --}}
            @if(Auth::user()->avatar)
                <img
                    src="{{ asset('storage/' . Auth::user()->avatar) }}"
                    alt="Avatar"
                    class="w-8 h-8 rounded-full object-cover border border-gray-300 flex-shrink-0"
                >
            @else
                <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-300 flex items-center justify-center flex-shrink-0">
                    <x-lucide-user-round class="w-5 h-5 text-gray-600"/>
                </div>
            @endif

            {{-- NOME --}}
            <div
                class="text-left transition-all duration-200 overflow-hidden"
                :class="sidebarOpen ? 'opacity-100 w-auto' : 'opacity-0 w-0'">

                <div class="font-semibold text-sm text-gray-800 whitespace-nowrap">
                    {{ Auth::user()->name }}
                </div>

                <div class="text-xs text-gray-500 whitespace-nowrap">
                    {{ Auth::user()->email }}
                </div>
            </div>
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link
            class="flex items-center gap-3"
            :href="route('profile.edit')">

            <x-lucide-user-round-pen class="w-5 h-5 text-gray-700" />
            {{ __('Editar Perfil') }}
        </x-dropdown-link>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link
                class="flex items-center gap-3"
                :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();">

                <x-lucide-log-out class="w-5 h-5 text-gray-700" />
                {{ __('Sair') }}
            </x-dropdown-link>
        </form>
    </x-slot>
</x-dropdown>

       
        </div>
</nav>
    <!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->
</div>