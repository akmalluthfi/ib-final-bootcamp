<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getTransaction($instructionType, $search)
    {
        if ($instructionType === 'LI') {
            if (is_null($search)) return $this->transactionRepository->getForLogisticInstruction();

            $transactions = $this->transactionRepository->searchForLogisticInstruction($search);
        }

        if ($instructionType === 'SI') {
            if (is_null($search)) return $this->transactionRepository->getAll();

            $transactions = $this->transactionRepository->searchAndFind($search);
        }

        return $transactions;
    }
}
