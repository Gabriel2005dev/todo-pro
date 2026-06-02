<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-[1400px] px-8 py-4">

        {{-- CARD DO PERFIL --}}
        <div class="bg-white border border-gray-300 rounded-lg p-6 mb-6">

            <div class="flex flex-col md:flex-row items-center gap-6">

                {{-- AVATAR --}}
                <div class="relative group">

                    <form
                        id="avatarForm"
                        method="POST"
                        action="{{ route('profile.avatar.update') }}"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        @if(Auth::user()->avatar)
                            <img
                                src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                alt="Avatar"
                                class="w-32 h-32 rounded-full object-cover  shadow-lg">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gray-100  flex items-center justify-center shadow-lg">
                                <x-lucide-user-round class="w-14 h-14 text-gray-500" />
                            </div>
                        @endif

                        {{-- INPUT OCULTO --}}
                        <input
                            id="avatarInput"
                            name="avatar"
                            type="file"
                            accept="image/*"
                            class="hidden"
                            onchange="document.getElementById('avatarForm').submit()">

                        {{-- OVERLAY COM LÁPIS --}}
                        <label
                            for="avatarInput"
                            class="absolute inset-0 rounded-full bg-black/50
                                   opacity-0 group-hover:opacity-100
                                   transition-all duration-300
                                   flex items-center justify-center
                                   cursor-pointer">

                            <div class="bg-white rounded-full p-3 shadow-lg">
                                <x-lucide-pencil class="w-6 h-6 text-gray-800" />
                            </div>

                        </label>

                    </form>

                </div>

                {{-- INFORMAÇÕES --}}
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ Auth::user()->name }}
                    </h1>

                    <p class="text-gray-500">
                        {{ Auth::user()->email }}
                    </p>

                    <div class="mt-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                            Usuário Ativo
                        </span>
                    </div>
                </div>

            </div>
        </div>

        {{-- CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 items-start">

            <div class="p-4 sm:p-8 bg-white border border-gray-300 rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white border border-gray-300 rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white border border-gray-300 rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>

    </div>
</x-app-layout>