<?php

namespace App\Livewire\Dashboard\Modals;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\NewAccountNotification;

class AddUserModal extends Component
{
    public $name = '';
    public $cpf_cnpj = '';
    public $email = '';
    public $phone = '';
    public $role = '';
    public $status = 'active';

    public function render()
    {
        $roles = Role::all()->pluck('name');

        if(empty($this->role)) {
            $this->role = $roles->first();
        }

        return view('livewire.dashboard.modals.add-user-modal', [
            'roles' => $roles
        ]);
    }

    public function save()
    {
        $this->authorize('createUsers');
        
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'cpf_cnpj' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric',
                'role' => 'required',
                'status' => 'required',
            ]);

            // Lógica para salvar o usuário
            $temporaryPassword = strval(mt_rand(100000, 999999));
            $user = User::create([
                'name' => $this->name,
                'cpf_cnpj' =>  Crypt::encryptString($this->cpf_cnpj),
                'email' => $this->email,
                'phone' => $this->phone,
                'status' => $this->status == 'true' ? 'active' : 'inactive',
                'password' => Hash::make($temporaryPassword),
            ]);

            $user->notificationPreferences()->create([]);

            $user->notify(new NewAccountNotification($temporaryPassword, $user->name));
            $user->assignRole($this->role);

            session()->flash('message', ['Usuário ' . $user->name . ' adicionado com sucesso!']);
            $this->reset(['name', 'cpf_cnpj', 'email', 'phone', 'role', 'status']);
            return redirect(route('users'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redireciona com erros usando sessão
            session()->flash('message', $e->validator->errors());

            return redirect(request()->header('Referer'));
        }
    }
}
