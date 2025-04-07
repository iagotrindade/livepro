<?php

namespace App\Exports;

use App\Models\Schedule;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Exportable;

class ServiceExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldQueue
{
    use Exportable;

    public function query()
    {
        return Schedule::with(['client', 'professional', 'payment', 'room']);
    }

    public function map($schedule): array
    {
        return [
            'protocol' => $schedule->protocol,
            'date' => $schedule->date ? $schedule->date->format('d/m/Y H:i') : 'N/A',
            'status' => $schedule->status ? $schedule->status->getName() : 'N/A',
            'client' => $schedule->client->name ?? 'N/A',
            'professional' => $schedule->professional->name ?? 'N/A',
            'payment_method' => $schedule->payment->method->getName() ?? 'N/A',
            'payment_status' => $schedule->payment->status->getName() ?? 'N/A',
            'room' => $schedule->room->room_id ?? 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            'Protocolo',
            'Data',
            'Status',
            'Cliente',
            'Profissional',
            'Método de Pagamento',
            'Status do Pagamento',
            'Sala',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
