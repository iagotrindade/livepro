<?php

namespace App\Livewire\Dashboard\Tables;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTable extends Component
{
    public $areas = [];
    public $count;
    public $name;
    public $permissions = [];
    public $roles;
    public $roleUsers = [];
    public $isDrawerOpen = false;

    #[On('updateRolesTable')]
    public function render()
    {
        $this->roles = Role::all(); // Apenas atualiza a lista de roles

        $this->count = User::whereHas('roles')->count();

        if(empty($this->areas)) {
            $permissions = Permission::all()->pluck('name')->toArray();

            $actions = ['view', 'edit', 'download', 'delete'];

            foreach ($permissions as $item) {
                foreach ($actions as $action) {
                    // Verifica se a string começa com a ação
                    if (strpos($item, $action) === 0) {
                        // Remove a ação do início para obter a área
                        $area = strtolower(str_replace($action, '', $item));

                        if (!isset($groupedPermissions[$area])) {
                            $groupedPermissions[$area] = [];
                        }

                        $this->areas[$area][] = $item;
                        break;
                    }
                }
            }

        }
        return view('livewire.dashboard.tables.permissions-table');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|min:2',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $this->name])
            ->givePermissionTo($this->permissions);

        session()->flash('success', 'Grupo ' . $this->name . ' criado com sucesso.');

        return redirect(route('permissions'));
    }

    public function loadUpdateRole($id)
    {
        if ($id) {
            $this->dispatch('loadUpdateRole', $id);
        } else {
            session()->flash('error', 'O papel selecionado não foi encontrado.');
        }
    }

    public function prepareDeleteRole($id) {
        $this->dispatch('prepareDeleteRole', $id);
    }
}
