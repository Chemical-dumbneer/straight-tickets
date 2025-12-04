<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Straight Tickets — Portal de Chamados</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#0a0a0a] text-gray-200 min-h-screen flex flex-col items-center">

{{-- Top Navigation --}}
<header class="w-full max-w-6xl flex justify-end p-6">
    @if (false) <!-- não quero me desfazer desses botão, as vezes é útil -->
        <nav class="flex gap-3 text-sm">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-4 py-1.5 border border-gray-700 rounded-md hover:border-indigo-500 transition">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-1.5 rounded-md hover:text-white border border-gray-700 hover:border-gray-500 transition">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-4 py-1.5 rounded-md bg-indigo-600 hover:bg-indigo-500 transition">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>

{{-- Main Section --}}
<main class="flex flex-col lg:flex-row max-w-6xl w-full px-6 lg:px-8 gap-10 items-center mt-4 flex-1">

    {{-- Left side - text --}}
    <div class="flex-1 space-y-6">

        <div class="inline-flex items-center gap-2 px-2 py-1 rounded-full bg-gray-900 border border-gray-700 text-[11px] text-gray-400">
            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
            Portal interno de chamados
        </div>

        <h1 class="text-4xl font-semibold leading-tight">
            Um jeito simples e direto<br>
            de gerenciar <span class="text-indigo-400">chamados de TI</span>.
        </h1>

        <p class="text-gray-400 max-w-lg text-sm leading-relaxed">
            O Straight Tickets centraliza solicitações, melhora o fluxo de atendimento
            e dá aos técnicos uma visão clara da fila — sem frescura, sem ruído, sem complexidade desnecessária.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

            {{-- Abertura rápida de chamados --}}
            <div class="flex gap-3">
                <div class="mt-1 h-6 w-6 rounded-md bg-gray-900 border border-gray-700 flex items-center justify-center">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <!-- ticket-ish icon -->
                        <rect x="4" y="7" width="16" height="10" rx="2" ry="2" />
                        <path d="M10 9v6" />
                        <path d="M14 9v6" />
                    </svg>
                </div>
                <div>
                    <div class="font-medium text-gray-100">Abertura rápida de chamados</div>
                    <p class="text-gray-400 text-xs mt-1">
                        Usuários registram problemas em poucos cliques.
                    </p>
                </div>
            </div>

            {{-- Painel para técnicos --}}
            <div class="flex gap-3">
                <div class="mt-1 h-6 w-6 rounded-md bg-gray-900 border border-gray-700 flex items-center justify-center">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <!-- lightning / bolt -->
                        <path d="M11 3L5 13h5l-1 8 6-10h-5l1-8z" />
                    </svg>
                </div>
                <div>
                    <div class="font-medium text-gray-100">Painel para técnicos</div>
                    <p class="text-gray-400 text-xs mt-1">
                        Organização clara por status e responsável.
                    </p>
                </div>
            </div>

            {{-- Status em tempo real --}}
            <div class="flex gap-3">
                <div class="mt-1 h-6 w-6 rounded-md bg-gray-900 border border-gray-700 flex items-center justify-center">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <!-- bar chart -->
                        <path d="M5 19V9" />
                        <path d="M10 19V5" />
                        <path d="M15 19v-7" />
                        <path d="M20 19V11" />
                    </svg>
                </div>
                <div>
                    <div class="font-medium text-gray-100">Status em tempo real</div>
                    <p class="text-gray-400 text-xs mt-1">
                        Atualização ao vivo usando Livewire.
                    </p>
                </div>
            </div>

            {{-- Acesso seguro --}}
            <div class="flex gap-3">
                <div class="mt-1 h-6 w-6 rounded-md bg-gray-900 border border-gray-700 flex items-center justify-center">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <!-- shield with check -->
                        <path d="M12 3L6 5v6c0 4.28 2.48 7.36 6 8 3.52-.64 6-3.72 6-8V5l-6-2z" />
                        <path d="M9.5 12.5l1.75 1.75L15 10.5" />
                    </svg>
                </div>
                <div>
                    <div class="font-medium text-gray-100">Acesso seguro</div>
                    <p class="text-gray-400 text-xs mt-1">
                        Apenas usuários autenticados acessam o sistema.
                    </p>
                </div>
            </div>

        </div>


        {{-- CTA --}}
        @guest
            <div class="flex flex-wrap gap-3 pt-2">
                <a href="{{ route('login') }}"
                   class="px-5 py-2.5 rounded-md bg-indigo-600 hover:bg-indigo-500 text-sm font-medium transition">
                    Entrar no portal
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-5 py-2.5 rounded-md bg-gray-900 border border-gray-700 hover:border-gray-500 text-sm font-medium transition">
                        Criar conta
                    </a>
                @endif
            </div>
        @endguest

    </div>

    {{-- Right side — mock da tabela --}}
    <div class="relative flex-1 max-w-xl">
        <div class="absolute -inset-6 bg-gradient-to-br from-indigo-600/20 via-transparent to-emerald-500/10 blur-2xl"></div>

        <div class="relative bg-gray-950 border border-gray-800 rounded-xl shadow-2xl overflow-hidden">

            <div class="px-5 py-4 border-b border-gray-800 flex justify-between">
                <div>
                    <div class="text-xs uppercase tracking-widest text-gray-500">
                        Fila de chamados
                    </div>
                    <div class="text-sm text-gray-300">Visão geral</div>
                </div>

                <div class="flex gap-2 text-[10px]">
                    <span class="px-2 py-1 rounded-full bg-gray-900 border border-gray-700 text-gray-400">Open · 5</span>
                    <span class="px-2 py-1 rounded-full bg-gray-900 border border-gray-700 text-gray-400">Pending · 3</span>
                    <span class="px-2 py-1 rounded-full bg-gray-900 border border-gray-700 text-gray-400">Closed · 12</span>
                </div>
            </div>

            <div class="p-4 space-y-2 text-xs">
                @foreach ([
                    ['#104', 'Erro ao acessar sistema X', 'Open'],
                    ['#103', 'Solicitação de impressora', 'Pending'],
                    ['#102', 'Reset de senha', 'Open'],
                    ['#101', 'Queda de rede setor financeiro', 'Open'],
                    ['#100', 'Configuração de e-mail', 'Closed'],
                ] as [$id, $title, $status])
                    <div class="flex items-center justify-between rounded-lg bg-gray-900/60 border border-gray-800 px-3 py-2">
                        <div class="flex flex-col">
                            <span class="text-[11px] text-gray-500">{{ $id }}</span>
                            <span class="text-gray-100 truncate max-w-[200px]">{{ $title }}</span>
                        </div>

                        @php
                            $colors = [
                                'Open' => 'bg-emerald-500/10 text-emerald-300 border-emerald-500/40',
                                'Pending' => 'bg-amber-500/10 text-amber-300 border-amber-500/40',
                                'Closed' => 'bg-gray-700/40 text-gray-200 border-gray-600/60',
                            ];
                        @endphp

                        <span class="px-2 py-1 rounded-full border text-[10px] {{ $colors[$status] }}">
                                {{ $status }}
                            </span>
                    </div>
                @endforeach
            </div>

            <div class="px-4 py-3 border-t border-gray-800 text-[11px] text-gray-500 flex justify-between">
                <span>Exibindo 1–5 de 30 chamados</span>
                <span class="flex items-center gap-1">
                        Live
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    </span>
            </div>
        </div>
    </div>
</main>

</body>
</html>
