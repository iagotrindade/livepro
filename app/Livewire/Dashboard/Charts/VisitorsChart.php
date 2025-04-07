<?php

namespace App\Livewire\Dashboard\Charts;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VisitorsChart extends Component
{
    public $dateRange = 7; // Intervalo padrão: últimos 7 dias

    public function render()
    {
        $startDate = Carbon::now()->subDays($this->dateRange)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $sessions = DB::table('sessions')
            ->whereBetween('last_activity', [$startDate->timestamp, $endDate->timestamp])
            ->get();

        $devices = [
            'desktop' => [
                'count' => $sessions->filter(function ($session) {
                    return stripos($session->user_agent, 'Windows') !== false ||
                        stripos($session->user_agent, 'Macintosh') !== false;
                })->count(),
                'users' => [
                    'anonymous' => $sessions->filter(function ($session) {
                        return is_null($session->user_id) &&
                            (stripos($session->user_agent, 'Windows') !== false || stripos($session->user_agent, 'Macintosh') !== false);
                    })->count(),
                    'clients' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'client' &&
                            (stripos($session->user_agent, 'Windows') !== false || stripos($session->user_agent, 'Macintosh') !== false);
                    })->pluck('user_id')->unique()->count(),
                    'professionals' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'professional' &&
                            (stripos($session->user_agent, 'Windows') !== false || stripos($session->user_agent, 'Macintosh') !== false);
                    })->pluck('user_id')->unique()->count(),
                    'collaborators' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'collaborator' &&
                            (stripos($session->user_agent, 'Windows') !== false || stripos($session->user_agent, 'Macintosh') !== false);
                    })->pluck('user_id')->unique()->count(),
                ]
            ],
            'mobile' => [
                'count' => $sessions->filter(function ($session) {
                    return stripos($session->user_agent, 'Android') !== false ||
                        stripos($session->user_agent, 'iPhone') !== false;
                })->count(),
                'users' => [
                    'anonymous' => $sessions->filter(function ($session) {
                        return is_null($session->user_id) &&
                            (stripos($session->user_agent, 'Android') !== false || stripos($session->user_agent, 'iPhone') !== false);
                    })->count(),
                    'clients' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'client' &&
                            (stripos($session->user_agent, 'Android') !== false || stripos($session->user_agent, 'iPhone') !== false);
                    })->pluck('user_id')->unique()->count(),
                    'professionals' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'professional' &&
                            (stripos($session->user_agent, 'Android') !== false || stripos($session->user_agent, 'iPhone') !== false);
                    })->pluck('user_id')->unique()->count(),
                    'collaborators' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'collaborator' &&
                            (stripos($session->user_agent, 'Android') !== false || stripos($session->user_agent, 'iPhone') !== false);
                    })->pluck('user_id')->unique()->count(),
                ]
            ],
            'tablet' => [
                'count' => $sessions->filter(function ($session) {
                    return stripos($session->user_agent, 'iPad') !== false;
                })->count(),
                'users' => [
                    'anonymous' => $sessions->filter(function ($session) {
                        return is_null($session->user_id) && stripos($session->user_agent, 'iPad') !== false;
                    })->count(),
                    'clients' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'client' && stripos($session->user_agent, 'iPad') !== false;
                    })->pluck('user_id')->unique()->count(),
                    'professionals' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'professional' && stripos($session->user_agent, 'iPad') !== false;
                    })->pluck('user_id')->unique()->count(),
                    'collaborators' => $sessions->filter(function ($session) {
                        return $this->getUserRole($session->user_id) === 'collaborator' && stripos($session->user_agent, 'iPad') !== false;
                    })->pluck('user_id')->unique()->count(),
                ]
            ]
        ];

        $data = [
            'anonymous' => $sessions->whereNull('user_id')->count(),
            'clients' => $sessions->filter(fn($s) => $this->getUserRole($s->user_id) === 'client')->count(),
            'professionals' => $sessions->filter(fn($s) => $this->getUserRole($s->user_id) === 'professional')->count(),
            'collaborators' => $sessions->filter(fn($s) => $this->getUserRole($s->user_id) === 'collaborator')->count(),
        ];

        $total = array_sum($data);

        return view('livewire.dashboard.charts.visitors-chart', [
            'data' => $data,
            'devices' => $devices,
            'total' => $total,
        ]);
    }

    private function getUserRole($userId)
    {
        if (!$userId) {
            return null;
        }

        $user = User::find($userId);

        return'client'; // Substitua `role` pelo campo que define a função do usuário
    }

    public function updateDateRange($range)
    {
        $this->dateRange = $range;
    }
}
