<?php

namespace App\Repositories\Interfaces;

use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;

interface TransactionRepositoryInterface
{
    /**
     * @param  array $payload
     * @return Transaction
     */
    public function create(array $payload): Transaction;

    /**
     * @param  array $filters
     * @return LengthAwarePaginator
     */
    public function getFilteredTransactions(array $filters): LengthAwarePaginator;

    /**
     * @param  int $userId
     * @param  array $filters
     * @return LengthAwarePaginator
     */
    public function getUserFilteredTransactions(int $userId, array $filters): LengthAwarePaginator;
}
