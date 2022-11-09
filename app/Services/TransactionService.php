<?php

namespace App\Services;

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
        // if instructionType doesn't exist throw an exception
        if (is_null($instructionType)) {
            throw new Exception('Required instructionType parameters', 400);
        }

        if (!in_array($instructionType, ['SI', 'LI'])) {
            throw new Exception('Undefined instructionType parameters', 400);
        }

        return $this->transactionRepository->SearchAndFilter($instructionType, $search);
    }
}
