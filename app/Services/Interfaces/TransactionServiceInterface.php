<?php

namespace App\Services\Interfaces;

use App\Http\Requests\TransactionFilterRequest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface TransactionServiceInterface
{
    /**
     * @param  array $payload
     * @return Transaction
     */
    public function createTransaction(array $payload): Transaction;

    /**
     * @param  TransactionFilterRequest $request
     * @return LengthAwarePaginator
     */
    public function getTransactions(TransactionFilterRequest $request): LengthAwarePaginator;

    /**
     * @param  TransactionFilterRequest $request
     * @param  User $user
     * @return LengthAwarePaginator
     */
    public function getUserTransactions(TransactionFilterRequest $request, User $user): LengthAwarePaginator;

    /**
     * @param  User $user
     * @return float
     */
    public function calculateBalance(User $user): float;
}
