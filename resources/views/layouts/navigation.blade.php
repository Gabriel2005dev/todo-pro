<nav x-data="{ open: true }"
     class="fixed top-0 left-0 h-screen bg-[#f5f3ff] border-r border-gray-200
            flex flex-col justify-between p-2 transition-all duration-300"
     :class="open ? 'w-64' : 'w-16'">

    {{-- TOGGLE BUTTON --}}
    <button
        @click="open = !open"
        class="absolute top-6 -right-4 w-8 h-8 bg-violet-500 text-white
               rounded-full shadow-lg flex items-center justify-center
               border border-white hover:scale-105 transition">

        <x-lucide-chevron-left class="w-4 h-4" x-show="open" />
        <x-lucide-chevron-right class="w-4 h-4" x-show="!open" />
    </button>

    {{-- TOPO --}}
    <div class="flex flex-col h-full justify-between">

        <div class="space-y-0">

            {{-- LOGO --}}
            <a class="flex items-center px-2 py-3">

                <div class="flex items-center gap-3">

                    <x-application-logo class="block h-12 w-auto fill-current text-gray-800" />

                    <span class="font-semibold transition-all duration-200"
                          x-show="open"
                          x-transition>
                        TodoPro
                    </span>

                </div>
            </a>

            <div class="border-t border-gray-200 pt-1"></div>

            {{-- MENU --}}
            <div class="space-y-2">

                {{-- DASHBOARD --}}
                <a href="{{ route('dashboard') }}"
                   class="flex items-center rounded-lg transition py-3
                   {{ request()->routeIs('dashboard')
                        ? 'bg-violet-500 text-white shadow-lg'
                        : 'text-gray-700 hover:bg-violet-100' }}"
                   :class="open ? 'justify-between px-4' : 'justify-center px-2'">

                    <div class="flex items-center gap-3">
                        <x-lucide-home class="w-5 h-5" />
                        <span class="font-medium" x-show="open" x-transition>
                            Dashboard
                        </span>
                    </div>

                </a>

                {{-- TASKS --}}
                <a href="{{ route('tasks.index') }}"
                   class="flex items-center rounded-lg transition py-3
                   {{ request()->routeIs('tasks.*')
                        ? 'bg-violet-500 text-white shadow-lg'
                        : 'text-gray-700 hover:bg-violet-100' }}"
                   :class="open ? 'justify-between px-4' : 'justify-center px-2'">

                    <div class="flex items-center gap-3">
                        <x-lucide-clipboard-list class="w-5 h-5" />
                        <span class="font-medium" x-show="open" x-transition>
                            Tasks
                        </span>
                    </div>

                </a>

                {{-- CREATE --}}
                <a href="{{ route('tasks.create') }}"
                   class="flex items-center rounded-lg text-gray-700 hover:bg-violet-100 transition py-3"
                   :class="open ? 'justify-between px-4' : 'justify-center px-2'">

                    <div class="flex items-center gap-3">
                        <x-lucide-badge-plus class="w-5 h-5" />
                        <span class="font-medium" x-show="open" x-transition>
                            Criar Task
                        </span>
                    </div>

                </a>

            </div>
        </div>

        {{-- RODAPÉ --}}
        <div class="border-t border-gray-200 pt-2">

    <x-dropdown align="top" width="full">

        <x-slot name="trigger">
            <button class="w-full flex items-center rounded-lg hover:bg-violet-100 transition gap-3 py-3"
                    :class="open ? 'justify-between px-4' : 'justify-center px-2'">

                <x-lucide-user-round class="w-5 h-5 text-gray-700"/>

                <div class="text-left transition-all duration-200 overflow-hidden"
                     :class="open ? 'opacity-100 w-auto ml-2' : 'opacity-0 w-0 ml-0'">

                    <div class="font-semibold text-base text-gray-700 whitespace-nowrap">
                        {{ Auth::user()->name }}
                    </div>

                </div>

            </button>
        </x-slot>

        <x-slot name="content">

            <x-dropdown-link class="flex items-center gap-3"
                             :href="route('profile.edit')">
                <x-lucide-user-round-pen class="w-5 h-5 text-gray-700" />
                {{ __('Editar Perfil') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link class="flex items-center gap-3"
                                 :href="route('logout')"
                                 onclick="event.preventDefault();
                                 this.closest('form').submit();">

                    <x-lucide-log-out class="w-5 h-5 text-gray-700" />
                    {{ __('Sair') }}

                </x-dropdown-link>

            </form>

        </x-slot>

    </x-dropdown>


        

    </div>

</nav>