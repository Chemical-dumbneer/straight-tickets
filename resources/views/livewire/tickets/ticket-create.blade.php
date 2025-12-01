<div class="max-w-3xl space-y-6">

    <h2 class="text-xl font-semibold text-white">
        Novo Chamado
    </h2>

    @if (session('success'))
        <div class="rounded-lg bg-green-600/20 border border-green-500 px-4 py-2 text-sm text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        {{-- Título --}}
        <div>
            <label class="block text-sm font-medium text-gray-200 mb-1">
                Título
            </label>
            <input
                type="text"
                wire:model.defer="title"
                class="w-full rounded-md border border-gray-700 bg-gray-900 px-3 py-2 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
            @error('title')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Descrição --}}
        <div>
            <label class="block text-sm font-medium text-gray-200 mb-1">
                Descrição
            </label>
            <textarea
                rows="6"
                wire:model.defer="description"
                class="w-full rounded-md border border-gray-700 bg-gray-900 px-3 py-2 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            ></textarea>
            @error('description')
            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-3">
            <a
                href="{{ route('tickets.index') }}"
                class="inline-flex items-center rounded-md border border-gray-600 px-4 py-2 text-sm text-gray-200 hover:bg-gray-800"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 disabled:opacity-50"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Salvar Chamado</span>
                <span wire:loading>Salvando...</span>
            </button>
        </div>
    </form>
</div>
