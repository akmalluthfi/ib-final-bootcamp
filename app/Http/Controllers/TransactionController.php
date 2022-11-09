<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        try {
            $transactions = $this->transactionService->getTransaction($request->query('instructionType'), $request->query('search'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Validation Error',
                'data' => null,
                'errors' => $e->getMessage()
            ]);
        }

        return response()->json([
            'message' => 'Success get Transaction',
            'data' => TransactionResource::collection($transactions),
            'errors' => null
        ]);
    }
}
