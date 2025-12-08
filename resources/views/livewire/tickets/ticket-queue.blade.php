<div class="space-y-4">
    <h2 class="text-lg font-semibold text-white">
        Fila de Chamados
    </h2>

    <div class="mb-4 flex flex-wrap gap-4 items-end">

        <x-filter-search
            label="Buscar"
            placeholder="Título, texto, etc..."
            wire:model.live.debounce.500ms="search"
        />

        <div class="flex flex-col gap-2">
            <span class="text-xs text-gray-400">Status</span>
            <div class="flex flex-wrap gap-2">
                @php
                    $statusOptions = ['Open' => 'Open', 'Pending' => 'Pending', 'Closed' => 'Closed'];
                @endphp

                @foreach($statusOptions as $value => $label)
                    @php
                        $isActive = in_array($value, $status);
                    @endphp

                    <button type="button"
                            wire:click="toggleStatus('{{ $value }}')"
                            class="px-3 py-1.5 rounded-full text-xs font-medium border
                               transition
                               {{ $isActive
                                    ? 'bg-indigo-600 border-indigo-500 text-white'
                                    : 'bg-gray-900 border-gray-700 text-gray-300 hover:border-gray-500' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        @if(auth()->user()->type->value === 'Tech')
            <x-filter-checkbox
                label="Somente sem atribuição ou atribuídos a mim"
                wire:model.live="onlyMyTickets"
            />
        @endif

    </div>

    <div class="space-y-3">
        @if ($tickets->isEmpty())
            <div class="rounded-xl border border-slate-800 bg-slate-900/70 p-4 text-center text-xs text-slate-500">
                Nenhum chamado encontrado.
            </div>
        @else

            <div class="mt-3">
                {{ $tickets->links() }}
            </div>

            @foreach ($tickets as $ticket)
                <x-ticket-card :ticket="$ticket" />
            @endforeach

            <div class="mt-3">
                {{ $tickets->links() }}
            </div>

        @endif
    </div>

</div>
