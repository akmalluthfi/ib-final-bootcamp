<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionCollection;
use App\Services\TransactionService;
use App\Exceptions\SearchNotFoundException;

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

        if ($transactions->count() <= 0) throw new SearchNotFoundException('Transaction not found');

        return new TransactionCollection($transactions);
    }
}
