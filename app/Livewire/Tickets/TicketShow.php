<?php

namespace App\Livewire\Tickets;

use App\Enums\InteractionType;
use App\Models\Ticket;
use App\Models\TicketInteraction;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TicketShow extends Component
{
    public Ticket $ticket;
    public string $description = '';
    public string $type = 'FollowUp';

    /** @var Collection<int, TicketInteraction> */
    public Collection $interactions;

    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket->load(['user']);

        $this->interactions = $this->ticket->interactions()
            ->latest()
            ->get();
    }

    protected function rules(): array
    {
        return [
            'description' => ['required','string','min:3'],
            'type' => ['required','in:FollowUp,Task,Solution'],
        ];
    }

    public function addInteraction(): void
    {
        $this->validate();

        $user = auth()->user();

        $interaction = TicketInteraction::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => $user->id,
            'timelinePosition' => $this->ticket->interactions()->count()+1,
            'type' => InteractionType::from($this->type),
            'description' => $this->description,
        ]);

        $this->interactions->prepend($interaction->load('user'));

        $this->description = '';
        $this->type = 'FollowUp';
    }
    public function render()
    {
        return view('livewire.tickets.ticket-show');
    }
}
