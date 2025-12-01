<?php

namespace App\Livewire\Tickets;

use App\Models\Ticket;
use App\Models\TicketInteraction;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TicketShow extends Component
{
    public Ticket $ticket;
    public string $description = '';

    /** @var Collection<int, TicketInteraction> */
    public Collection $interactions;

    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket->load(['user', 'ticket_interactions']);

        $this->interactions = $this->ticket->interactions()
            ->latest()
            ->get();
    }

    protected function rules(): array
    {
        return [
            'description' => ['required','string','min:3'],
        ];
    }

    public function addInteraction(): void
    {
        $this->validate();

        $user = auth()->user();

        $interaction = TicketInteraction::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => $user->id,
            'type' => $this->type,
            'description' => $this->description,
        ]);

        $this->interactions->prepend($interaction->load('user'));

        $this->description = '';
    }
    public function render()
    {
        return view('livewire.tickets.ticket-show');
    }
}
