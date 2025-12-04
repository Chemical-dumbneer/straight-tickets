<?php

namespace App\Livewire\Tickets;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\services\TicketService;
use Livewire\Component;

class TicketCreate extends Component
{
    public string $title = '';
    public string $description = '';

    public function __construct(TicketService $ticketService)
    {
    }

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $user = auth()->user();

        $this->ticketService->create(
            $this->title,
            $this->description,
            $user
        );

        session()->flash('success', 'Chamado aberto com sucesso!');

        $this->redirect(route('tickets.index'), navigate: true);
    }
    public function render()
    {
        return view('livewire.tickets.ticket-create');
    }
}
