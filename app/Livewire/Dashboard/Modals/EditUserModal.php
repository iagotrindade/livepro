<?php

namespace App\Livewire\Dashboard\Modals;

use App\Models\User;
use Livewire\Component;
use App\Enums\UserStatus;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Crypt;
use App\Services\AccessDetailsService;
use App\Notifications\UpdateAccountNotification;
use App\Services\DecryptDataService;

class EditUserModal extends Component
{
    public $updatedUser;
    public $accessDetails;
    public $name = '';
    public $cpf_cnpj = '';
    public $email = '';
    public $phone = '';
    public $role = '';
    public $status = '';

    public function mount(Request $request)
    {
        $this->accessDetails = AccessDetailsService::generateAccessDetails($request);
    }

    public function render()
    {
        $roles = Role::all()->pluck('name');

        return view('livewire.dashboard.modals.edit-user-modal', [
            'roles' => $roles,
        ]);
    }

    #[On('loadUpdateUser')]
    public function loadUpdateUser($id)
    {
        $this->updatedUser = User::find($id);
        $this->name = $this->updatedUser->name;
        $this->cpf_cnpj = DecryptDataService::decryptData($this->updatedUser->cpf_cnpj);
        $this->email = $this->updatedUser->email;
        $this->phone = $this->updatedUser->phone;
        $this->role = $this->updatedUser->roles->first()->name ?? '';

        // Verifique diretamente com o enum
        $this->status = $this->updatedUser->status === UserStatus::ACTIVE;
    }

    public function update()
    {
        $this->authorize('editUsers');
        
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'cpf_cnpj' => 'required|unique:users,cpf_cnpj,' . $this->updatedUser->id,
                'email' => 'required|email|unique:users,email,' . $this->updatedUser->id,
                'phone' => 'required|numeric',
                'role' => 'required',
                'status' => 'required|boolean',
            ]);

            $this->updatedUser->update([
                'name' => $this->name,
                'cpf_cnpj' =>  Crypt::encryptString($this->cpf_cnpj),
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status ? UserStatus::ACTIVE->value : UserStatus::INACTIVE->value,
            ]);

            $this->updatedUser->notify(new UpdateAccountNotification($this->updatedUser->name, $this->accessDetails));
            $this->updatedUser->syncRoles([$this->role]);

            session()->flash('message', ['Usuário ' . $this->updatedUser->name . ' atualizado com sucesso!']);
            $this->reset(['name', 'cpf_cnpj', 'email', 'phone', 'role', 'status']);
            return redirect(route('users'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('message', ['Preencha todos os campos!']);
            return redirect(request()->header('Referer'));
        }
    }
}
