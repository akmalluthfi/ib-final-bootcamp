<?php

namespace App\Services;

use App\Models\Instruction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Repositories\VendorInvoiceRepository;

class VendorInvoiceService
{
    private VendorInvoiceRepository $vendorInvoiceRepository;

    public function __construct(VendorInvoiceRepository $vendorInvoiceRepository)
    {
        $this->vendorInvoiceRepository = $vendorInvoiceRepository;
    }

    public function store($data, Instruction $instruction){
        $data['attachment'] = $this->storeFile($data['attachment'], $instruction->id);

        if(isset($data['supporting_document'])){
            $data['supporting_document'] = [$this->storeFile($data['supporting_document'], $instruction->id)];
        } else {
            $data['supporting_document'] = [];
        }

        $vendorInvoice = $this->vendorInvoiceRepository->create($data, $instruction);

        return $vendorInvoice;
    }

    public function storeFile(UploadedFile $file, $instructionId){
        $path = Storage::putFile('instructions/' . $instructionId . '/vendor-invoices', $file);

        return $path;
    }
}
