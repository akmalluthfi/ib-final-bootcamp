<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceTargetRequest;
use App\Http\Resources\InvoiceTargetCollection;
use App\Http\Resources\InvoiceTargetResource;
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

        return new InvoiceTargetCollection($invoiceTargets);
    }

    public function store(StoreInvoiceTargetRequest $request)
    {
        $invoiceTarget = $this->invoiceTargetService->storeInvoiceTarget($request->validated());

        return response()->json([
            'message' => 'Invoice target created successfully',
            'data' => new InvoiceTargetResource($invoiceTarget),
        ], 201);
    }
}
