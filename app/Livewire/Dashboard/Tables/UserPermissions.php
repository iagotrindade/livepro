<?php

namespace App\Livewire\Dashboard\Tables;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On; 
use Spatie\Permission\Models\Role;

class UserPermissions extends Component
{
    public $roles;
    public $users;

    public function render()
    {
        $this->roles = Role::all();
        foreach ($this->roles as $role) {
            // Filtra usuários que possuem a role atual
            $this->users = User::with('roles')->get()->filter(
                fn($user) => $user->roles->isNotEmpty() // Verifica se o usuário possui ao menos uma role
            );
        }
        return view('livewire.dashboard.tables.user-permissions');
    }

    public function changeUserPermission($role, $userId) {
        $user = User::find($userId);

        $user->removeRole($user->roles[0]->name);
        $user->assignRole($role);

        session()->flash('message', 'O cargo do usuário ' . $user->name . ' foi alterado');
    }
}
