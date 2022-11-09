<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
{
    public function SearchAndFilter($instructionType, $search)
    {
        $transactions = Transaction::query();

        if ($instructionType == 'LI') {
            $transactions->where('transaction_type', 'Transfer')
                ->orWhere('transaction_type', 'Call Of');
        }

        if (!is_null($search)) {
            $transactions->where('transaction_id', 'like', "%$search%");
        }

        return $transactions->get(['transaction_type', 'transaction_id']);
    }
}
