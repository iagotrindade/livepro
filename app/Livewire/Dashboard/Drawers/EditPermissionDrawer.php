<?php

namespace App\Livewire\Dashboard\Drawers;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EditPermissionDrawer extends Component
{
    public $updatedRole;
    #[Validate('required|min:2')]
    public $name = '';
    public $changedPermission;
    public $areas = [];
    public $isDrawerOpen = false;
    public $deletedRoleId;

    public function render()
    {
        if (empty($this->updatedRole)) {
            $this->updatedRole = Role::find(1); // Só será carregado se não houver estado pré-definido
        }

        if (empty($this->areas)) {

            $permissions = Permission::all()->pluck('name')->toArray();

            $actions = ['create', 'view', 'edit', 'download', 'delete'];

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

        return view('livewire.dashboard\drawers.edit-permission-drawer');
    }

    #[On('loadUpdateRole')]
    public function openDrawer($id)
    {
        $this->updatedRole = Role::find($id);
        $this->name = $this->updatedRole->name;

        $this->isDrawerOpen = true; // Abre o drawer para edição
    }

    public function updated($title, $value)
    {
        $this->authorize('editPermissions');

        $this->validate([
            'name' => ['required', 'min:2'],
        ]);
        $this->updatedRole->name = $value;
        $this->updatedRole->save();

        session()->flash('message', 'O nome do grupo foi atualizado com sucesso');

        $this->dispatch('updateRolesTable');
    }

    public function updateRole($permission)
    {
        if (in_array($permission, $this->updatedRole->permissions->pluck('name')->toArray())) {
            $this->updatedRole->revokePermissionTo($permission);
        } else {
            $this->updatedRole->givePermissionTo($permission);
            session()->flash('message', 'Permissão alterada com sucesso.');
        }
    }

    #[On('prepareDeleteRole')]
    public function prepareDeleteRole($id) {
        $this->deletedRoleId = $id;
    }

    public function deleteRole()
    {
        $this->authorize('deletePermissions');

        $role = Role::find($this->deletedRoleId);

        if ($role) {
            $role->revokePermissionTo($role->permissions->pluck('name')->toArray());
            $role->delete();
            session()->flash('message', 'O grupo ' . $this->name . ' foi excluído com sucesso.');
        } else {
            session()->flash('message', 'O grupo ' . $this->name . ' não foi encontrado.');
        }

        return redirect(route('permissions'));
    }
}
