<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionCollection;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(TransactionRequest $request)
    {
        $transactions = $this->transactionService->getTransaction(
            $request->query('instructionType'),
            $request->query('search')
        );

        return new TransactionCollection($transactions);
    }
}
