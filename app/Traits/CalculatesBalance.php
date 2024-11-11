<?php

namespace App\Traits;

use App\Enums\TransactionType;
use App\Events\BalanceLowEvent;
use App\Models\User;

trait CalculatesBalance
{
    protected float $balanceThreshold = 100;

    /**
     * Calculates the balance for the transferred user.
     *
     * @param  User $user
     * @return float
     */
    public function calculateBalanceUser(User $user): float
    {
        $deposits = $this->getTransactionSumByType($user, TransactionType::DEPOSIT);
        $withdrawals = $this->getTransactionSumByType($user, TransactionType::WITHDRAWAL);

        $balance = $deposits - $withdrawals;

        $this->checkIfLowBalance($user, $balance);

        return round($balance, 2);
    }

    /**
     * Returns the amount of transactions for the specified type.
     *
     * @param  User $user
     * @param  TransactionType $type
     * @return float
     */
    protected function getTransactionSumByType(User $user, TransactionType $type): float
    {
        return $user->transactions()->where('type', $type)->sum('amount');
    }

    public function checkIfLowBalance($user, $balance): void
    {
        if ($balance < $this->balanceThreshold) {
            event(new BalanceLowEvent($user, $balance));
        }
    }
}
