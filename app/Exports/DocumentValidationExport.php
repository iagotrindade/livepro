<?php

namespace App\Exports;

use App\Models\DocumentValidation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocumentValidationExport implements FromCollection, WithHeadings, ShouldQueue
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DocumentValidation::with(['professionalDocument', 'supportAgent'])
            ->get()
            ->map(function ($documentValidation) {
                return [
                    'protocol' => $documentValidation->protocol,
                    'document' => $documentValidation->professionalDocument->document->name,
                    'support_agent' => $documentValidation->supportAgent->name,
                    'status' => $documentValidation->status->getName(),
                    'date' => $documentValidation->created_at ? $documentValidation->created_at->format('d/m/Y H:i') : '-',
                ];
            });
    }

    /**
     * Define os cabeçalhos das colunas no Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Protocolo',
            'Documento',
            'Operador',
            'Status',
            'Data',
        ];
    }
}
