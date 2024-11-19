<?php

namespace App\Repositories;

use App\Http\Requests\TransactionFilterRequest;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Traits\CalculatesBalance;
use App\Traits\FilterableTransactions;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    use FilterableTransactions, CalculatesBalance;

    /**
     * @param Transaction $model
     */
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    /**
     * @param  array $payload
     * @return Transaction
     */
    public function create(array $payload): Transaction
    {
        $transaction = Transaction::create($payload);

        $user = User::find($payload['user_id']);
        if ($user) {
            $this->calculateBalanceUser($user);
        }

        return $transaction;
    }

    /**
     * Get transactions with filters.
     *
     * @param  TransactionFilterRequest|array $filters
     * @return LengthAwarePaginator
     */
    public function getFilteredTransactions(TransactionFilterRequest|array $filters): LengthAwarePaginator
    {
        $query = $this->model->query();
        $this->applyFilters($query, $filters);

        return $query->paginate();
    }

    /**
     * Get user-specific transactions with filters.
     *
     * @param  int $userId
     * @param  TransactionFilterRequest|array $filters
     * @return LengthAwarePaginator
     */
    public function getUserFilteredTransactions(int $userId, TransactionFilterRequest|array $filters): LengthAwarePaginator
    {
        $query = $this->model->query()->where('user_id', $userId);
        $this->applyFilters($query, $filters);

        return $query->paginate();
    }
}
