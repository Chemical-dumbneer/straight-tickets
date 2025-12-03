<div class="space-y-6 max-w-4xl">

    {{-- Cabeçalho do chamado --}}
    <div class="rounded-xl border border-gray-800 bg-gray-900/70 p-5 space-y-2">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-white">
                    #{{ $ticket->id }} — {{ $ticket->title }}
                </h2>
                <p class="text-sm text-gray-400">
                    Aberto por
                    <span class="text-gray-200">
                        {{ $ticket->user->name ?? 'Desconhecido' }}
                    </span>
                    em
                    {{ $ticket->created_at->format('d/m/Y H:i') }}
                </p>
            </div>

            <div class="text-right">
                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium
                    @if($ticket->status === 'Open') bg-green-600/20 text-green-300 border border-green-500
                    @elseif($ticket->status === 'Pending') bg-yellow-600/20 text-yellow-300 border border-yellow-500
                    @else bg-gray-600/20 text-gray-300 border border-gray-500
                    @endif
                ">
                    {{ $ticket->status }}
                </span>
            </div>
        </div>

        <div class="pt-3 border-t border-gray-800 text-sm text-gray-200 whitespace-pre-line">
            {{ $ticket->description }}
        </div>
    </div>

    {{-- Formulário de nova interação --}}
    <div class="rounded-xl border border-gray-800 bg-gray-900/70 p-5 space-y-3">
        <h3 class="text-sm font-semibold text-gray-200">Nova interação</h3>

        <form wire:submit.prevent="addInteraction" class="space-y-4">

            {{-- Tipo da interação --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-200">
                    Tipo da interação
                </label>

                <div class="flex flex-col sm:flex-row gap-3">

                    {{-- FollowUp --}}
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            wire:model="type"
                            value="FollowUp"
                            class="text-blue-500 focus:ring-blue-400"
                        >
                        <span class="text-gray-200">Follow-up</span>
                    </label>

                    @if (auth()->user()->type === \App\Enums\UserType::TECH)
                    {{-- Task --}}
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            wire:model="type"
                            value="Task"
                            class="text-amber-500 focus:ring-amber-400"
                        >
                        <span class="text-amber-300">Tarefa</span>
                    </label>

                    {{-- Solution --}}
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            wire:model="type"
                            value="Solution"
                            class="text-sky-500 focus:ring-sky-400"
                        >
                        <span class="text-sky-300">Solução</span>
                    </label>
                </div>
                @endif
                @error('type')
                <p class="text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Mensagem --}}
            <div>
        <textarea
            wire:model.defer="description"
            rows="4"
            class="w-full rounded-md border border-gray-700 bg-gray-950 px-3 py-2 text-sm text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            placeholder="Digite sua mensagem..."
        ></textarea>

                @error('description')
                <p class="text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Botão --}}
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 disabled:opacity-50"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>Enviar interação</span>
                    <span wire:loading>Enviando...</span>
                </button>
            </div>
        </form>


    </div>

    {{-- Histórico de interações --}}
    <div class="space-y-3">
        <h3 class="text-sm font-semibold text-gray-200">Histórico de interações</h3>

        @if ($interactions->isEmpty())
            <p class="text-xs text-gray-400">Nenhuma interação ainda.</p>
        @else
            <div class="space-y-3">
                @foreach ($interactions as $interaction)
                    @php
                        // Quem escreveu a interação
                        $author = $interaction->user;

                        // Descobrir se é o usuário que abriu ou o técnico
                        $isFromTech = $author->type === \App\Enums\UserType::TECH;

                        // Alinhamento do "balão" (user à esquerda, tech à direita)
                        $rowAlignment = $isFromTech ? 'justify-end' : 'justify-start';
                        $textAlignment = $isFromTech ? 'text-right' : 'text-left';

                        $type = $interaction->type->value;

                        // Cores conforme o type
                        $colorClasses = match($type) {
                            'Task' => 'bg-amber-900/40 border-amber-500 text-amber-100',
                            'Solution' => 'bg-sky-900/40 border-sky-500 text-sky-100',
                            default => 'bg-gray-900/60 border-gray-700 text-gray-100'
                        };
                    @endphp

                    <div class="flex {{ $rowAlignment }}">
                        <div class="max-w-3xl w-fit rounded-lg border px-3 py-2 space-y-1 {{ $colorClasses }} {{ $textAlignment }}">
                            <div class="flex items-center justify-between text-[11px] text-gray-300/80 gap-2">
                                <div class="{{ $textAlignment }}">
                                <span class="font-semibold">
                                    {{ $author->name ?? 'Usuário desconhecido' }}
                                </span>

                                    @if ($isFromTech)
                                        <span class="ml-1 text-[10px] uppercase tracking-wide">
                                        (Técnico)
                                    </span>
                                    @else
                                        <span class="ml-1 text-[10px] uppercase tracking-wide">
                                        (Solicitante)
                                    </span>
                                    @endif
                                </div>

                                <span>
                                {{ $interaction->created_at->format('d/m/Y H:i') }}
                            </span>
                            </div>

                            <div class="text-sm whitespace-pre-line">
                                {{ $interaction->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
