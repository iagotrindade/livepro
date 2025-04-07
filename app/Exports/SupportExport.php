<?php

namespace App\Exports;

use App\Models\Support;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupportExport implements FromCollection, WithHeadings, ShouldQueue
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Support::with(['supportAgent', 'category', 'user'])
            ->get()
            ->map(function ($support) {
                return [
                    'client' => $support->user->name ?? '-',
                    'support_agent' => $support->supportAgent->name,
                    'subject' => $support->subject,
                    'protocol' => $support->protocol,
                    'priority' => $support->priority->getName(),
                    'status' => $support->status->getName(),
                    'resolution' => $support->resolution,
                    'date' => $support->created_at ? $support->created_at->format('d/m/Y H:i') : '-',
                    'closed_at' => $support->closed_at ? $support->closed_at->format('d/m/Y H:i') : '-',
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
            'Cliente',
            'Operador',
            'Assunto',
            'Protocolo',
            'Prioridade',
            'Status',
            'Solução',
            'Data',
            'Fechado em'
        ];
    }
}
