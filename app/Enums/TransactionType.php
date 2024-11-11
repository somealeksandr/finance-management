<?php

namespace App\Enums;

enum TransactionType:string
{
    case DEPOSIT = 'deposit';
    case WITHDRAWAL = 'withdrawal';

    /**
     * Returns all transaction type values.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
