<?php

namespace App\Services;

use App\Http\Requests\TransactionFilterRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Interfaces\TransactionServiceInterface;
use App\Traits\CalculatesBalance;
use App\Traits\FilterableTransactions;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionService implements TransactionServiceInterface
{
    use FilterableTransactions, CalculatesBalance;

    /**
     * @param  array $payload
     * @return Transaction
     */
    public function createTransaction(array $payload): Transaction
    {
        $transaction = Transaction::create($payload);

        $user = User::find($payload['user_id']);
        if ($user) {
            $this->calculateBalanceUser($user);
        }

        return $transaction;
    }

    /**
     * @param  TransactionFilterRequest $request
     * @return LengthAwarePaginator
     */
    public function getTransactions(TransactionFilterRequest $request): LengthAwarePaginator
    {
        $query = Transaction::query();
        $this->applyFilters($query, $request);

        return $query->paginate();
    }

    /**
     * @param  TransactionFilterRequest $request
     * @param  User $user
     * @return LengthAwarePaginator
     */
    public function getUserTransactions(TransactionFilterRequest $request, User $user): LengthAwarePaginator
    {
        $query = Transaction::query()->where('user_id', $user->getKey());
        $this->applyFilters($query, $request);

        return $query->paginate();
    }

    /**
     * @param  User $user
     * @return float
     */
    public function calculateBalance(User $user): float
    {
        return $this->calculateBalanceUser($user);
    }
}
