<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceTargetRequest;
use App\Http\Resources\InvoiceTargetResource;
use App\Models\InvoiceTarget;
use App\Services\InvoiceTargetService;
use Illuminate\Http\Request;

class InvoiceTargetController extends Controller
{
    protected $invoiceTargetService;

    public function __construct(InvoiceTargetService $invoiceTargetService)
    {
        $this->invoiceTargetService = $invoiceTargetService;
    }

    public function index(Request $request)
    {
        $invoiceTargets =  $this->invoiceTargetService->getInvoiceTarget($request->query('search'));

        return response()->json([
            'message' => 'Success get Invoice Targets',
            'data' => InvoiceTargetResource::collection($invoiceTargets),
            'errors' => null
        ]);
    }

    public function store(StoreInvoiceTargetRequest $request)
    {
        $invoiceTarget = $request->validated();

        $this->invoiceTargetService->storeInvoiceTarget($invoiceTarget);

        return response()->json([
            'message' => 'Successfully created new invoice',
            'data' => $invoiceTarget,
            'errors' => null
        ]);
    }
}
