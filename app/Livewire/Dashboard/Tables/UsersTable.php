<?php

namespace App\Livewire\Dashboard\Tables;

use App\Models\User;
use Livewire\Component;
use App\Exports\UserExport;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\ExportReadyNotification;

class UsersTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '';
    public $filter = [];
    public $deletedUser;
    public $exportMessage = '';
    public function render()
    {
        // Aplica os filtros de busca e roles selecionadas
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->when(!empty($this->filter), function ($query) {
                $query->where(function ($subQuery) {
                    // Filtra por múltiplas roles
                    $subQuery->whereHas('roles', function ($roleQuery) {
                        $roleQuery->whereIn('name', $this->filter);
                    })
                        // Adiciona o filtro por status usando o mesmo $this->filter
                        ->orWhereIn('status', $this->filter);
                });
            })
            ->with('reviews')
            ->paginate(10);
        // Carrega todas as roles disponíveis
        $roles = Role::all()->pluck('name');

        return view('livewire.dashboard.tables.users-table', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
    public function filterUsers($status)
    {
        if (in_array($status, $this->filter)) {
            $this->filter = array_diff($this->filter, [$status]);
        } else {
            $this->filter[] = $status;
        }
        // Resetar a paginação
        $this->resetPage();
    }

    public function loadUpdateUser($id)
    {
        $this->dispatch('loadUpdateUser', $id);
    }
    public function loadDeleteUser($id)
    {
        $this->deletedUser = User::find($id);

        if (!$this->deletedUser) {
            session()->flash('error', 'Usuário não encontrado!');
            return;
        }
    }
    public function deleteUser()
    {
        $this->deletedUser->delete();

        session()->flash('message', ['Usuário ' . $this->deletedUser->name . ' deletado com sucesso!']);
        $this->deletedUser = null;

        return redirect(request()->header('Referer'));
    }

    public function exportUsers() {
        Excel::store(new UserExport, 'exports/Dados dos usuários.xlsx', 'public');

        Auth::user()->notify(new ExportReadyNotification('Dados dos usuários', 'exports/Dados dos usuários.xlsx'));

        $this->exportMessage = 'A exportação foi iniciada e será processada em breve.';
        $this->dispatch('exportComplete');
    }
}
