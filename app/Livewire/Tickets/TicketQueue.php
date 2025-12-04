<?php

namespace App\Livewire\Tickets;

use App\Enums\UserType;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class TicketQueue extends Component
{
    use WithPagination;

    public $status = ['Open','Pending'];
    public $search = '';
    public $onlyMyTickets = true;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => []],
        'onlyMyTickets' => ['except' => true],
        'page' => ['except' => 1],
    ];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        if ($this->onlyMyTickets === null) {
            $this->onlyMyTickets = true;
        }
        if ($this->status === null) {
            $this->status = ['Open','Pending'];
        }
    }

    public function updating($field)
    {
        if (in_array($field, ['search', 'status', 'onlyMyTickets'])) {
            $this->resetPage();
        }
    }

    public function toggleStatus(string $value): void
    {
        if (in_array($value, $this->status)) {
            $this->status = array_values(array_diff($this->status, [$value]));
        } else {
            $this->status[] = $value;
        }
    }

    public function render()
    {
        $user = auth()->user();

        $query = Ticket::query()->latest('updated_at');

        if ($this->search) {
            $query->where('title', 'ILIKE', "%{$this->search}%");
        }

        if (!empty($this->status)) {
            $query->whereIn('status', $this->status);
        }

        if ($user->type === UserType::USER)
        {
            $query->where('user_id', $user->id);
        }else{
            if ($this->onlyMyTickets) {
                $query->where(function ($q) {
                    $q->whereNull('tech_id')
                        ->orWhere('tech_id', auth()->id());
                });
            }
        }

        $tickets = $query->paginate(15);

        return view('livewire.tickets.ticket-queue', [
            'tickets' => $tickets,
        ]);
    }
}
