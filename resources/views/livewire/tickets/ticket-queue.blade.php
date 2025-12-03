<div class="space-y-4">
    <h2 class="text-lg font-semibold text-white">
        Fila de Chamados
    </h2>

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
