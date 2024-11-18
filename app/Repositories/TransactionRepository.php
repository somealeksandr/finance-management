<?php

namespace App\Repositories;

use App\Http\Requests\TransactionFilterRequest;
use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Traits\FilterableTransactions;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    use FilterableTransactions;

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
        return Transaction::create($payload);
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
