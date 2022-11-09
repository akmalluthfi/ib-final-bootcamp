<?php

namespace App\Http\Controllers;

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

        return response()->json([
            'message' => 'Success get vendors',
            'data' => InvoiceTargetResource::collection($invoiceTargets),
            'errors' => null
        ]);
    }
}
