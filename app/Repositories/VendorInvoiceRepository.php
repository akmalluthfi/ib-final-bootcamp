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
            'supporting_documents' => $data['supporting_documents']
        ];

        
        $vendorInvoice = $instruction->vendorInvoices()->create($dataSaved);

        return $vendorInvoice;
    }

    public function getById(Instruction $instruction, $id)
    {
        $vendorInvoice = $instruction->vendorInvoices->firstOrFail(function($value) use($id) {
            return $value->id == $id;
        });

        return $vendorInvoice;
    }
    
    public function update($data, $vendorInvoice)
    {
        $vendorInvoice->update($data);
        
        return $vendorInvoice;
    }

    public function delete($vendorInvoice)
    {
        $result = $vendorInvoice->delete();

        return $result;
    }
    
    public function pull(Instruction $instruction, $field, $data)
    {
        $vendorInvoice = $instruction->pull('vendor_invoices.'. $field, $data);
        
        return $vendorInvoice;
    }
}
