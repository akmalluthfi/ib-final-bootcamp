<?php

namespace App\Repositories;

use App\Models\Instruction;

class VendorInvoiceRepository
{
    public function create($data, Instruction $instruction){
        $dataSaved = [
            'no' => $data['no'],
            'attachment' => $data['attachment'],
            'supporting_document' => $data['supporting_document']
        ];

        $vendorInvoice = $instruction->vendorInvoices()->create($dataSaved);

        return $vendorInvoice;
    }
}
