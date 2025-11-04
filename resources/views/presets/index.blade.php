<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Meus Presets') }}
            </h2>
            <a href="{{ route('presets.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Novo Preset
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($presets->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($presets as $preset)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                    <h3 class="font-bold text-lg mb-2">{{ $preset->name }}</h3>
                                    <p class="text-sm text-gray-600 mb-1">
                                        <span class="font-semibold">Marca:</span> {{ $preset->pedal_brand }}
                                    </p>
                                    <p class="text-sm text-gray-600 mb-3">
                                        <span class="font-semibold">Modelo:</span> {{ $preset->pedal_model }}
                                    </p>
                                    @if ($preset->description)
                                        <p class="text-sm text-gray-700 mb-3">{{ Str::limit($preset->description, 100) }}</p>
                                    @endif
                                    <div class="flex gap-2 mt-4">
                                        <a href="{{ route('presets.show', $preset) }}" class="text-blue-600 hover:text-blue-800 text-sm">Ver</a>
                                        <a href="{{ route('presets.edit', $preset) }}" class="text-green-600 hover:text-green-800 text-sm">Editar</a>
                                        <form action="{{ route('presets.destroy', $preset) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este preset?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-600 mb-4">Você ainda não tem presets cadastrados.</p>
                            <a href="{{ route('presets.create') }}" class="text-blue-600 hover:text-blue-800">Criar meu primeiro preset</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
