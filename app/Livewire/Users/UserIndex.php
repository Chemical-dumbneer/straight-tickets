<?php

namespace App\Livewire\Users;

use App\Enums\UserType;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public ?string $typeFilter = null;
    public ?string $search = null;

    public function mount(): void
    {
        // Segurança extra: só técnico pode acessar
        $user = auth()->user();

        if ($user->type !== UserType::TECH) {
            abort(403, 'Acesso não autorizado.');
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingTypeFilter(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query()->orderBy('name');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'ilike', '%'.$this->search.'%')
                    ->orWhere('email', 'ilike', '%'.$this->search.'%');
            });
        }

        if ($this->typeFilter === 'user') {
            $query->where('type', UserType::USER);
        } elseif ($this->typeFilter === 'tech') {
            $query->where('type', UserType::TECH);
        }

        $users = $query->paginate(10);

        return view('livewire.users.user-index', [
            'users' => $users,
        ]);
    }
}
