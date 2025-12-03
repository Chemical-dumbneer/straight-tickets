<?php

namespace App\Livewire\Tickets;

use App\Enums\UserType;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class TicketQueue extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public function render()
    {
        $user = auth()->user();

        $query = Ticket::query()->latest();

        if ($user->type === UserType::USER)
        {
            $query->where('user_id', $user->id);
        }

        $tickets = $query->paginate(15);

        return view('livewire.tickets.ticket-queue', [
            'tickets' => $tickets,
        ]);
    }
}
