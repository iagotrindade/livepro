<?php

namespace App\Livewire\Dashboard\Charts;

use App\Models\Subscription;
use Carbon\Carbon;
use Livewire\Component;

class ProUsersChart extends Component
{
    public $dateRange = 7; // Intervalo padrão: últimos 7 dias

    public function render()
    {
        // Determina as datas de início e fim com base no intervalo escolhido
        $startDate = Carbon::now()->subDays($this->dateRange)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Filtra assinaturas com base no intervalo
        $subscriptions = Subscription::with('plan', 'user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Contagem total de usuários com inscrições
        $totalUsers = $subscriptions->unique('user_id')->count();

        // Cria as séries com contagem diária por plano
        $plans = ['Basic', 'Standard', 'Pro']; // Os nomes dos planos
        $categories = collect();
        $series = [];

        foreach ($plans as $plan) {
            $data = [];

            foreach (range(0, $this->dateRange - 1) as $i) {
                $date = Carbon::now()->subDays($this->dateRange - $i)->startOfDay();
                $categories->push($date->translatedFormat('d M')); // Formata para o eixo X em PT-BR
                $count = $subscriptions
                    ->filter(fn($sub) => $sub->plan->name === $plan)
                    ->filter(fn($sub) => $sub->created_at->startOfDay()->eq($date))
                    ->count();

                $data[] = $count;
            }

            $series[] = [
                'name' => "Edição $plan",
                'data' => $data,
                'color' => $this->getPlanColor($plan), // Define cores
            ];
        }

        return view('livewire.dashboard.charts.pro-users-chart', [
            'chartData' => [
                'categories' => $categories->unique()->values(),
                'series' => $series,
                'totalUsers' => $totalUsers, // Adiciona o total geral
            ],
        ]);
    }

    /**
     * Define cores para os planos.
     */
    private function getPlanColor($plan)
    {
        return match ($plan) {
            'Basic' => '#1A56DB',
            'Standard' => '#7E3BF2',
            'Pro' => '#E74694',
            default => '#000',
        };
    }

    public function updateDateRange($range)
    {
        $this->dateRange = $range;
    }
}
