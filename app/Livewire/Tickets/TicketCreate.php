<?php

namespace App\Livewire\Tickets;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use Livewire\Component;

class TicketCreate extends Component
{
    public string $title = '';
    public string $description = '';

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

        Ticket::create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => TicketStatus::OPEN,
            'user_id' => $user->id,
        ]);

        session()->flash('success', 'Chamado aberto com sucesso!');

        $this->redirect(route('tickets.index'), navigate: true);
    }
    public function render()
    {
        return view('livewire.tickets.ticket-create');
    }
}
