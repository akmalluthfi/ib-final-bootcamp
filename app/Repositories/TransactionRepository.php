<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    public function getForLogisticInstruction()
    {
        return Transaction::latest()
            ->forLogisticInstruction()
            ->limit(10)
            ->get(['type', 'no']);
    }

    public function searchForLogisticInstruction($search)
    {
        return Transaction::latest()
            ->forLogisticInstruction()
            ->where('no', 'like', "%$search%")
            ->limit(10)
            ->get(['type', 'no']);
    }

    public function getAll()
    {
        return Transaction::latest()->limit(10)->get();
    }

    public function searchAndFind($search)
    {
        return Transaction::latest()
            ->where('no', 'like', "%$search%")
            ->limit(10)
            ->get(['type', 'no']);
    }
}
