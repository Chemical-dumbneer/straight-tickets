@props(['ticket'])

@php
    $status = strtolower($ticket->status->value);

    $statusColors = [
        'open'    => 'bg-sky-500',
        'pending' => 'bg-amber-400',
        'closed'  => 'bg-slate-500',
    ];

    $statusLabels = [
        'open'    => 'Aberto',
        'pending' => 'Pendente',
        'closed'  => 'Fechado',
    ];

    $colorClass  = $statusColors[$status]  ?? 'bg-slate-500';
    $label       = $statusLabels[$status] ?? ucfirst($ticket->status);
@endphp

{{-- Link clicável englobando todo o card --}}
<a
    href="{{ route('tickets.show', $ticket) }}"
    class="flex gap-3 rounded-xl border border-slate-800 bg-slate-900/80 p-4 hover:border-slate-700 hover:bg-slate-900 transition group"
>
    {{-- Faixa lateral colorida --}}
    <div class="w-1 rounded-full {{ $colorClass }}"></div>

    {{-- Conteúdo --}}
    <div class="flex-1 flex flex-col gap-2">

        {{-- Título --}}
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="text-xs text-slate-500">#{{ $ticket->id }}</span>

                <h3 class="text-sm font-medium text-slate-100 group-hover:text-slate-50 transition">
                    {{ $ticket->title }}
                </h3>
            </div>

            <span class="inline-flex items-center rounded-full border border-slate-700 px-2 py-0.5 text-[10px] font-medium
                @if($status === 'open') border-sky-500/60 bg-sky-500/10 text-sky-300
                @elseif($status === 'pending') border-amber-500/60 bg-amber-500/10 text-amber-300
                @elseif($status === 'closed') border-slate-500/60 bg-slate-500/10 text-slate-300
                @endif
            ">
                {{ $label }}
            </span>
        </div>

        {{-- Solicitante e técnico --}}
        <div class="flex flex-wrap items-center gap-4 text-xs text-slate-400">
            <div>
                <span class="text-slate-500">Solicitante:</span>
                <span class="ml-1 text-slate-200">
                    {{ $ticket->user->name ?? '—' }}
                </span>
            </div>

            <div>
                <span class="text-slate-500">Técnico responsável:</span>
                <span class="ml-1 text-slate-200">
                    {{ $ticket->tech->name ?? '—' }}
                </span>
            </div>
        </div>

        {{-- Criado em --}}
        <div class="text-xs text-slate-500">
            Criado em
            <span class="text-slate-300">
                {{ $ticket->created_at?->format('d/m/Y H:i') }}
            </span>
        </div>
    </div>
</a>
