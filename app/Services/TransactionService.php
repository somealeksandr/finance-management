<?php

namespace App\Services;

use App\Http\Requests\TransactionFilterRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Services\Interfaces\TransactionServiceInterface;
use App\Traits\CalculatesBalance;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionService implements TransactionServiceInterface
{
    use CalculatesBalance;

    /**
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(protected TransactionRepositoryInterface $transactionRepository)
    {
        //
    }

    /**
     * @param  array $payload
     * @return Transaction
     */
    public function createTransaction(array $payload): Transaction
    {
        return $this->transactionRepository->create($payload);
    }

    /**
     * @param  TransactionFilterRequest $request
     * @return LengthAwarePaginator
     */
    public function getTransactions(TransactionFilterRequest $request): LengthAwarePaginator
    {
        return $this->transactionRepository->getFilteredTransactions($request);
    }

    /**
     * @param  TransactionFilterRequest $request
     * @param  User $user
     * @return LengthAwarePaginator
     */
    public function getUserTransactions(TransactionFilterRequest $request, User $user): LengthAwarePaginator
    {
        return $this->transactionRepository->getUserFilteredTransactions($user->getKey(), $request);
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
