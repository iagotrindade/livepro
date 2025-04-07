<?php

namespace App\Exports;

use App\Models\AuditLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class AuditExport implements FromQuery, WithHeadings, WithMapping, ShouldQueue
{
    use Exportable;

    public function __construct()
    {
        ini_set('memory_limit', '1024M'); // Aumenta o limite de memória para 1GB
    }
    
    /**
     * Define a query otimizada para exportação.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return AuditLog::query()
            ->select('id', 'entity_name', 'url', 'ip_address', 'user_agent', 'created_at', 'user_id')
            ->with([
                'user:id,name', 
                'entity:id,name'
            ]);
    }

    /**
     * Define os cabeçalhos das colunas no Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Usuário',
            'Item afetado',
            'URL',
            'Endereço de IP',
            'Dispositivo',
            'Data',
        ];
    }

    /**
     * Mapeia os dados exportados para o formato desejado.
     *
     * @param mixed $audit
     * @return array
     */
    public function map($audit): array
    {
        return [
            $audit->id,
            $audit->user ? $audit->user->name : 'Desconhecido',
            $audit->entity ? $audit->entity->name : '-',
            $audit->url ?? '-',
            $audit->ip_address ?? '-',
            $audit->user_agent ?? '-',
            $audit->changes ?? '-',
            $audit->created_at ? $audit->created_at->format('d/m/Y H:i') : '-',
        ];
    }

    /**
     * Define o tamanho do chunk para exportação.
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }
}

