<div class="space-y-4 max-w-5xl">

    {{-- Cabeçalho / filtros --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-lg font-semibold text-white">
            Usuários cadastrados
        </h2>

        <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
            {{-- Filtro por tipo --}}
            <select
                wire:model.live="typeFilter"
                class="rounded-md border border-gray-700 bg-gray-900 px-3 py-1.5 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                <option value="">Todos os tipos</option>
                <option value="user">Usuários</option>
                <option value="tech">Técnicos</option>
            </select>

            {{-- Busca por nome/email --}}
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Buscar por nome ou e-mail..."
                class="rounded-md border border-gray-700 bg-gray-900 px-3 py-1.5 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
        </div>
    </div>

    {{-- Tabela --}}
    <div class="overflow-x-auto rounded-xl border border-gray-800">
        <table class="min-w-full text-sm text-gray-200">
            <thead class="bg-gray-900/70">
            <tr>
                <th class="px-4 py-2 text-left">Nome</th>
                <th class="px-4 py-2 text-left">E-mail</th>
                <th class="px-4 py-2 text-left">Tipo</th>
                <th class="px-4 py-2 text-left">Criado em</th>
                <th class="px-4 py-2 text-right">Ações</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-800 bg-gray-900/40">
            @forelse ($users as $user)
                <tr>
                    <td class="px-4 py-2">
                        {{ $user->name }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $user->email }}
                    </td>
                    <td class="px-4 py-2">
                        @php
                            $type = $user->type instanceof \BackedEnum ? $user->type->value : $user->type;
                        @endphp

                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium
                                @if($type === 'TECH')
                                    bg-indigo-600/20 text-indigo-300 border border-indigo-500
                                @else
                                    bg-gray-600/20 text-gray-200 border border-gray-500
                                @endif
                            ">
                                {{ $type === 'TECH' ? 'Técnico' : 'Usuário' }}
                            </span>
                    </td>
                    <td class="px-4 py-2">
                        {{ $user->created_at?->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-4 py-2 text-right">
                        <a
                            href="{{ route('users.edit', $user) }}"
                            class="text-xs text-indigo-300 hover:underline"
                        >
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-400">
                        Nenhum usuário encontrado.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginação --}}
    <div>
        {{ $users->links() }}
    </div>
</div>
