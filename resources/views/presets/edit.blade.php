<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Preset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('presets.update', $preset) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nome do Preset')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $preset->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Pedal Brand -->
                        <div class="mt-4">
                            <x-input-label for="pedal_brand" :value="__('Marca da Pedaleira')" />
                            <x-text-input id="pedal_brand" class="block mt-1 w-full" type="text" name="pedal_brand" :value="old('pedal_brand', $preset->pedal_brand)" required />
                            <x-input-error :messages="$errors->get('pedal_brand')" class="mt-2" />
                        </div>

                        <!-- Pedal Model -->
                        <div class="mt-4">
                            <x-input-label for="pedal_model" :value="__('Modelo da Pedaleira')" />
                            <x-text-input id="pedal_model" class="block mt-1 w-full" type="text" name="pedal_model" :value="old('pedal_model', $preset->pedal_model)" required />
                            <x-input-error :messages="$errors->get('pedal_model')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Descrição')" />
                            <textarea id="description" name="description" rows="4" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('description', $preset->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Settings -->
                        <div class="mt-4">
                            <x-input-label for="settings" :value="__('Configurações')" />
                            <textarea id="settings" name="settings" rows="6" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" placeholder="Ex: Gain: 7, Treble: 5, Middle: 6, Bass: 4">{{ old('settings', $preset->settings) }}</textarea>
                            <x-input-error :messages="$errors->get('settings')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-4">
                            <a href="{{ route('presets.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Atualizar Preset') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
