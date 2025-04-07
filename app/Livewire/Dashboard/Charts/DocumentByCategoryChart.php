<?php

namespace App\Livewire\Dashboard\Charts;

use Livewire\Component;
use App\Models\DocumentValidation;

class DocumentByCategoryChart extends Component
{
    public $occupationArray;

    public function render()
    {
        $documents = DocumentValidation::with('professionalDocument.user.occupations')->get();

        // Filtra os documentos com ocupações válidas
        $documentsByOccupation = $documents->filter(function ($document) {
            return $document->professionalDocument
                && $document->professionalDocument->user
                && $document->professionalDocument->user->occupations->isNotEmpty();
        });

        // Agrupa os documentos por ocupação
        $groupedByOccupation = $documentsByOccupation->flatMap(function ($document) {
            return $document->professionalDocument->user->occupations->map(function ($occupation) {
                return $occupation->name; // Assuma que a ocupação tem um campo 'name'
            });
        })->countBy();

        // Limita às 5 ocupações com mais documentos
        $topOccupations = $groupedByOccupation->sortDesc()->take(5);

        // Total dos documentos das 5 ocupações
        $totalTopOccupations = $topOccupations->sum();

        // Monta a coleção com contagem e percentuais
        $occupationCollection = $topOccupations->map(function ($count, $occupation) use ($totalTopOccupations) {
            return (object) [
                'occupation' => $occupation,
                'count' => $count,
                'percentage' => $totalTopOccupations > 0 ? ($count / $totalTopOccupations) * 100 : 0,
            ];
        });

        // Ajuste da porcentagem para totalizar 100%
        $totalPercentage = 0;
        $occupationCollection = $occupationCollection->values(); // Garante que os índices sejam sequenciais
        $occupationCollection->transform(function ($item, $index) use ($occupationCollection, &$totalPercentage) {
            $item->percentage = round($item->percentage, 2);
            $totalPercentage += $item->percentage;

            // Ajustar a última ocupação para garantir que totalize 100%
            if ($index === $occupationCollection->count() - 1) {
                $item->percentage += (100 - $totalPercentage);
            }

            return $item;
        });

        // Define a propriedade ocupationArray para a view
        $this->occupationArray = $occupationCollection;

        return view('livewire.dashboard.charts.document-by-category-chart');
    }
}
