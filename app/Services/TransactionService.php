<?php

namespace App\Services;

use App\Exceptions\SearchNotFoundException;
use App\Repositories\TransactionRepository;
use Exception;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getTransaction($instructionType, $search)
    {
        $transactions = collect();

        if ($instructionType === 'LI') {
            if (is_null($search)) return $this->transactionRepository->getForLogisticInstruction();

            $transactions = $this->transactionRepository->searchForLogisticInstruction($search);
        }

        if ($instructionType === 'SI') {
            if (is_null($search)) return $this->transactionRepository->getAll();

            $transactions = $this->transactionRepository->searchAndFind($search);
        }

        if ($transactions->count() <= 0) throw new SearchNotFoundException('Transaction not found');

        return $transactions;
    }
}
