<?php

namespace App\Repositories;

use App\Models\Instruction;

class VendorInvoiceRepository
{
    public function create($data, Instruction $instruction)
    {
        $dataSaved = [
            '_id' => $data['id'],
            'no' => $data['no'],
            'attachment' => $data['attachment'],
            'supporting_documents' => $data['supporting_documents']
        ];

        $vendorInvoice = $instruction->vendorInvoices()->create($dataSaved);

        return $vendorInvoice;
    }

    public function getById(Instruction $instruction, $id)
    {
        $vendorInvoice = $instruction->vendorInvoices->firstOrFail(function ($value) use ($id) {
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
}
