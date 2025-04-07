<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UserExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, ShouldQueue
{
    use Exportable;
    public function query()
    {
        return User::with(['reviews']);
    }

    public function map($user): array
    {
        return [
            'name' => $user->name,
            'cpf_cnpj' => $user->cpf_cnp ?? '-',
            'role' => $user->getRoleNames()->first() ?? 'Nenhum',
            'phone' => $user->phone ?? '-',
            'email' => $user->email ?? '-',
            'rating' => number_format($user->rating, 1),
            'crated_at' => $user->created_at ? $user->created_at->format('d/m/Y H:i') : '-',
            'last_access' => $user->lastActivity() ? $user->lastActivity()->translatedFormat('d M y à\s\ H:i') : '-' ,
            'status' => $user->status ? $user->status->getName() : 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            'Nome',
            'CPF/CNPJ',
            'Cargo',
            'Telefone',
            'Email',
            'Avaliação',
            'Data de Criação',
            'Último acesso',
            'Status',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
