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

    @if ($tickets->isEmpty())
        <p class="text-sm text-gray-400">Nenhum chamado encontrado.</p>
    @else
        <div class="overflow-x-auto rounded-xl border border-gray-800">
            <table class="min-w-full text-sm text-gray-200">
                <thead class="bg-gray-900/60">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Título</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Solicitante</th>
                    <th class="px-4 py-2 text-left">Criado em</th>
                    <th class="px-4 py-2 text-left">Técnico Responsável</th>
                    <th class="px-4 py-2 text-right">Ações</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-800 bg-gray-900/40">
                @foreach ($tickets as $ticket)
                    <tr>
                        <td class="px-4 py-2">{{ $ticket->id }}</td>
                        <td class="px-4 py-2">{{ $ticket->title }}</td>

                        <td class="px-4 py-2">
                            {{-- se status for enum, adapta aqui --}}
                            {{ $ticket->status }}
                        </td>

                        <td class="px-4 py-2">
                            {{ $ticket->user->name ?? '-' }}
                        </td>

                        <td class="px-4 py-2">
                            {{ $ticket->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="px-4 py-2">
                            {{ $ticket->tech->name ?? '-' }}
                        </td>

                        <td class="px-4 py-2 text-right">
                            <a href="{{ route('tickets.show', $ticket) }}"
                               class="text-blue-400 hover:underline">
                                Ver
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
