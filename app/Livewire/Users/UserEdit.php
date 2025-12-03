<?php

namespace App\Livewire\Users;

use App\Enums\UserType;
use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public User $user;

    public string $name;
    public string $email;
    public string $type; // string para bind do select

    public function mount(User $user): void
    {
        // Só técnico pode acessar
        $authUser = auth()->user();
        if ($authUser->type !== UserType::TECH) {
            abort(403, 'Acesso não autorizado.');
        }

        $this->user  = $user;
        $this->name  = $user->name;
        $this->email = $user->email;

        $this->type = $user->type->value;
    }

    protected function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->user->id],
            'type'  => ['required'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->user->name  = $this->name;
        $this->user->email = $this->email;

        $this->user->type = UserType::from($this->type);

        $this->user->save();

        session()->flash('success', 'Usuário atualizado com sucesso.');

        $this->redirect(route('users.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.users.user-edit', [
            'types' => UserType::cases(),
        ]);
    }
}
