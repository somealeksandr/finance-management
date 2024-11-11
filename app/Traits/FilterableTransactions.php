<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait FilterableTransactions
{
    /**
     * Applies filters to transactions.
     *
     * @param  Builder  $query
     * @param  Request  $request
     * @return Builder
     */
    public function applyFilters(Builder $query, Request $request): Builder
    {
        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        if ($request->has('from_date') && $request->has('to_date')) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();

            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }

        return $query;
    }
}
