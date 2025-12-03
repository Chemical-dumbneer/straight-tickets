<?php
namespace App\Livewire;

use App\Enums\TicketStatus;
use App\Enums\UserType;
use Livewire\Component;
use App\Models\Ticket;

class Dashboard extends Component
{
    public int $openForUser = 0;
    public int $pendingForUser = 0;
    public int $closedForUser = 0;

    public int $newForTech = 0;
    public int $toHandleForTech = 0;
    public int $inProgressForTech = 0;

    public function mount()
    {
        $user = auth()->user();

        if ($user->type === UserType::TECH) {

            $this->newForTech = Ticket::withoutTech()->count();

            $this->toHandleForTech = Ticket::assignedToTech($user)
                ->status(TicketStatus::OPEN)
                ->count();

            $this->inProgressForTech = Ticket::assignedToTech($user)->count();

        } else {
            $this->openForUser = Ticket::fromUser($user)
                ->status(TicketStatus::OPEN)
                ->count();

            $this->pendingForUser = Ticket::fromUser($user)
                ->status(TicketStatus::PENDING)
                ->count();

            $this->closedForUser = Ticket::fromUser($user)
                ->status(TicketStatus::CLOSED)
                ->count();
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
