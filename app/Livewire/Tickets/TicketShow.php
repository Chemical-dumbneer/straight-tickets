<?php

namespace App\Livewire\Tickets;

use App\Enums\InteractionType;
use App\Models\Ticket;
use App\Models\TicketInteraction;
use App\services\TicketService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TicketShow extends Component
{
    public Ticket $ticket;
    public string $description = '';
    public string $type = 'FollowUp';
    protected TicketService $ticketService;

    /** @var Collection<int, TicketInteraction> */
    public Collection $interactions;


    public function mount(Ticket $ticket): void
    {
        $this->ticket = $ticket->load(['user']);

        $this->interactions = $this->ticket->interactions()
            ->latest()
            ->get();
    }

    public function boot(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    protected function rules(): array
    {
        return [
            'description' => ['required','string','min:3'],
            'type' => ['required','in:FollowUp,Task,Solution'],
        ];
    }

    public function addInteraction()
    {
        $this->validate();

        $user = auth()->user();

        $this->ticketService->addInteraction(
            $this->ticket,
            $user,
            $this->description,
            InteractionType::from($this->type)
        );

        session()->flash('success', match($this->type) {
            'FollowUp'=>'Acompanhamento inserido com sucesso!',
            'Task'=>'Tarefa inserida com sucesso! Status do chamado alterado para Pendente.',
            'Solution'=>'Chamado solucionado com sucesso!',
            });

        $this->ticket = $this->ticket->fresh()->load(['interactions','user']);

        $this->description = '';
        $this->type = 'FollowUp';

        return $this->redirectRoute('tickets.show', $this->ticket);
    }

    public function assignMeToThis()
    {
        $me = auth()->user();
        $this->ticketService->assignTicket(
            $this->ticket,
            $me,
        );
        $this->ticket->tech_id = $me->id;

        session()->flash('success', 'Chamado atribuído com sucesso!');
    }

    public function removeMeFromThis()
    {
        $this->ticketService->assignTicket(
            $this->ticket
        );
        $this->ticket->tech_id = null;

        session()->flash('success', 'Chamado abandonado com sucesso!');
    }
    public function render()
    {
        return view('livewire.tickets.ticket-show');
    }
}
