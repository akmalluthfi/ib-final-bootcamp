<?php

namespace App\Repositories;

use App\Models\Instruction;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VendorInvoiceRepository
{
    public function create($data, Instruction $instruction)
    {
        $dataSaved = [
            'no' => $data['no'],
            'attachment' => $data['attachment'],
            'supporting_document' => $data['supporting_document']
        ];

        $vendorInvoice = $instruction->vendorInvoices()->create($dataSaved);

        return $vendorInvoice;
    }

    public function getById(Instruction $instruction, $vendorInvoice)
    {
        $vendorInvoice = $instruction->vendorInvoices->firstWhere('_id', '=', $vendorInvoice);
        
        if(empty($vendorInvoice)){
            throw new ModelNotFoundException;
        }

        return $vendorInvoice;
    }
    
    public function update($data, $vendorInvoice)
    {
        $vendorInvoice->update($data);
        
        return $vendorInvoice;
    }
    
    public function pull(Instruction $instruction, $field, $data)
    {
        $vendorInvoice = $instruction->pull('vendor_invoices.'. $field, $data);
        
        return $vendorInvoice;
    }
}
