<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\TransactionFilterRequest;
use App\Http\Resources\TransactionResource;
use App\Models\User;
use App\Services\Interfaces\TransactionServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TransactionController extends Controller
{
    /**
     * @param TransactionServiceInterface $transactionService
     */
    public function __construct(protected TransactionServiceInterface $transactionService)
    {
    }

    /**
     * @param  StoreTransactionRequest $request
     * @return TransactionResource
     */
    public function store(StoreTransactionRequest $request): TransactionResource
    {
        $transaction = $this->transactionService->createTransaction($request->validated());
        return new TransactionResource($transaction);
    }

    /**
     * @param  TransactionFilterRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(TransactionFilterRequest $request): AnonymousResourceCollection
    {
        $transactions = $this->transactionService->getTransactions($request);
        return TransactionResource::collection($transactions);
    }


    /**
     * @param  TransactionFilterRequest $request
     * @param  User $user
     * @return AnonymousResourceCollection
     */
    public function userTransactions(TransactionFilterRequest $request, User $user): AnonymousResourceCollection
    {
        $transactions = $this->transactionService->getUserTransactions($request, $user);
        return TransactionResource::collection($transactions);
    }

    /**
     * @param  User $user
     * @return JsonResponse
     */
    public function balance(User $user): JsonResponse
    {
        $balance = $this->transactionService->calculateBalance($user);
        return response()->json(['balance' => $balance]);
    }
}
