<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        {{-- Linha de cards principais --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @if(auth()->user()->is_technician)
                {{-- TÉCNICOS --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm text-gray-500 dark:text-gray-400">Chamados Novos</div>
                        <div class="mt-2 text-3xl font-bold">{{ $newForTech }}</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm text-gray-500 dark:text-gray-400">Chamados a Tratar</div>
                        <div class="mt-2 text-3xl font-bold">{{ $toHandleForTech }}</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm text-gray-500 dark:text-gray-400">Chamados em Atendimento</div>
                        <div class="mt-2 text-3xl font-bold">{{ $inProgressForTech }}</div>
                    </div>
                </div>
            @else
                {{-- USUÁRIOS --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm text-gray-500 dark:text-gray-400">Chamados em Atendimento</div>
                        <div class="mt-2 text-3xl font-bold">{{ $openForUser }}</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm text-gray-500 dark:text-gray-400">Chamados em Espera</div>
                        <div class="mt-2 text-3xl font-bold">{{ $pendingForUser }}</div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="text-sm text-gray-500 dark:text-gray-400">Chamados Solucionados</div>
                        <div class="mt-2 text-3xl font-bold">{{ $closedForUser }}</div>
                    </div>
                </div>
            @endif
        </div>

        {{-- Placeholder inferior: mantém como está no template padrão --}}
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                Você está logado!
            </div>
        </div>
    </div>
</div>
