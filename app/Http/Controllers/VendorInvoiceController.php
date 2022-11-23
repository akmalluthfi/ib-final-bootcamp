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
        if($instruction->status !== 'In Progress'){
            return response()->json(['message' => 'The instruction.status must be In Progress'], 400);
        }

        $data = $request->validated();
        
        $vendorInvoice = $this->vendorInvoiceService->storeVendorInvoice($data, $instruction);

        return (new VendorInvoiceResource($vendorInvoice, 'Successfully created vendor invoices'))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorInvoice  $vendorInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(Instruction $instruction, $id)
    {
        $vendorInvoice = $this->vendorInvoiceService->getVendorInvoice($instruction, $id);

        return new VendorInvoiceResource($vendorInvoice, 'Successfully got vendor invoice');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorInvoice  $vendorInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(VendorInvoiceRequest $request, Instruction $instruction, $id)
    {
        if($instruction->status !== 'In Progress'){
            return response()->json(['message' => 'The instruction.status must be In Progress'], 400);
        }

        $vendorInvoice = $this->vendorInvoiceService->getVendorInvoice($instruction, $id);

        $data = $request->validated();
        $vendorInvoice = $this->vendorInvoiceService->updateVendorInvoice($data, $instruction, $vendorInvoice);

        return new VendorInvoiceResource($vendorInvoice, 'Successfully updated vendor invoice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorInvoice  $vendorInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instruction $instruction, $id)
    {
        if($instruction->status !== 'In Progress'){
            return response()->json(['message' => 'The instruction.status must be In Progress'], 400);
        }

        $vendorInvoice = $this->vendorInvoiceService->getVendorInvoice($instruction, $id);

        $result = $this->vendorInvoiceService->deleteVendorInvoice($vendorInvoice);

        if($result){
            return response()->json(['message' => 'Successfully deleted vendor invoice']);
        } else {
            return response()->json(['message' => 'failed to delete vendor invoice'], 400);
        }
    }
}
