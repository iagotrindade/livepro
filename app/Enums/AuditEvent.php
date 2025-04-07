<?php

namespace App\Enums;

enum AuditEvent :string
{
    case ACESSED = 'accessed';
    case LOGIN = 'login';
    case LOGOUT = 'logout';
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';
    case RESTORED = 'restored';

    public function getName(): string {
        return match ($this) 
        {
            self::ACESSED => 'Acesso',
            self::LOGIN => 'Login',
            self::LOGOUT => 'Logout',
            self::CREATED => 'Criar',
            self::UPDATED => 'Atualizar',
            self::DELETED => 'Deletar',
            self::RESTORED => 'Restaurar',
            default => 'Desconhecido',
        };
    }

    public function getStyles(): string {
        return match ($this) 
        {
            self::ACESSED => 'bg-green-100 text-green-800 text-xs font-medium mr-2 px-4 py-1 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500',

            self::LOGIN => 'bg-green-100 text-green-800 text-xs font-medium mr-2 px-4 py-1 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500',

            self::LOGOUT => 'bg-red-100 text-red-800 text-xs font-medium mr-2 px-4 py-1 rounded-md border border-red-100 dark:bg-gray-700 dark:border-red-500 dark:text-red-400',

            self::CREATED => 'bg-green-100 text-green-800 text-xs font-medium mr-2 px-4 py-1 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500',

            self::UPDATED => 'bg-orange-100 text-orange-800 text-xs font-medium mr-2 px-4 py-1 rounded-md border border-orange-100 dark:bg-gray-700 dark:border-orange-300 dark:text-orange-300 ',

            self::DELETED => 'bg-red-100 text-red-800 text-xs font-medium mr-2 px-4 py-1 rounded-md border border-red-100 dark:bg-gray-700 dark:border-red-500 dark:text-red-400',

            self::RESTORED => 'bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-4 py-1 rounded-md border border-purple-100 dark:bg-gray-700 dark:border-purple-500 dark:text-purple-400',

            default => '',
        };
    }
}
