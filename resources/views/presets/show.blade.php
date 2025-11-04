<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $preset->name }}
            </h2>
            <a href="{{ route('presets.index') }}" class="text-blue-600 hover:text-blue-800">
                Voltar para lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Informações do Preset</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="font-semibold text-gray-700">Nome:</span>
                                <span class="ml-2">{{ $preset->name }}</span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-700">Marca da Pedaleira:</span>
                                <span class="ml-2">{{ $preset->pedal_brand }}</span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-700">Modelo da Pedaleira:</span>
                                <span class="ml-2">{{ $preset->pedal_model }}</span>
                            </div>
                            @if ($preset->description)
                                <div>
                                    <span class="font-semibold text-gray-700">Descrição:</span>
                                    <p class="ml-2 mt-1 text-gray-600">{{ $preset->description }}</p>
                                </div>
                            @endif
                            @if ($preset->settings)
                                <div>
                                    <span class="font-semibold text-gray-700">Configurações:</span>
                                    <pre class="ml-2 mt-1 text-gray-600 bg-gray-50 p-3 rounded">{{ $preset->settings }}</pre>
                                </div>
                            @endif
                            <div>
                                <span class="font-semibold text-gray-700">Criado em:</span>
                                <span class="ml-2">{{ $preset->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div>
                                <span class="font-semibold text-gray-700">Atualizado em:</span>
                                <span class="ml-2">{{ $preset->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-6 pt-6 border-t">
                        <a href="{{ route('presets.edit', $preset) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Editar
                        </a>
                        <form action="{{ route('presets.destroy', $preset) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este preset?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
