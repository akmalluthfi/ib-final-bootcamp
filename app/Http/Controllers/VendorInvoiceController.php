<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorInvoiceRequest;
use App\Http\Resources\VendorInvoiceResource;
use App\Models\Instruction;
use App\Models\VendorInvoice;
use App\Services\VendorInvoiceService;

class VendorInvoiceController extends Controller
{
    private VendorInvoiceService $vendorInvoiceService;

    public function __construct(VendorInvoiceService $vendorInvoiceService)
    {
        $this->vendorInvoiceService = $vendorInvoiceService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorInvoiceRequest $request, Instruction $instruction)
    {
        $data = $request->validated();
        
        $vendorInvoice = $this->vendorInvoiceService->store($data, $instruction);

        return response()->json([
            'message' => 'Successfully created vendor invoices',
            'data' => new VendorInvoiceResource($vendorInvoice)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorInvoice  $vendorInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(VendorInvoice $vendorInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorInvoice  $vendorInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(VendorInvoiceRequest $request, VendorInvoice $vendorInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorInvoice  $vendorInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorInvoice $vendorInvoice)
    {
        //
    }
}
