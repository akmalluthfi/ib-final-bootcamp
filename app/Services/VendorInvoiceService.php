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

    public function store($data, Instruction $instruction)
    {
        $data['attachment'] = $this->storeFile($data['attachment'], $instruction->id);

        if(isset($data['supporting_document'])){
            $data['supporting_document'] = [$this->storeFile($data['supporting_document'], $instruction->id)];
        } else {
            $data['supporting_document'] = [];
        }

        $vendorInvoice = $this->vendorInvoiceRepository->create($data, $instruction);

        return $vendorInvoice;
    }

    public function getVendorInvoice(Instruction $instruction, $id)
    {
        $vendorInvoice = $this->vendorInvoiceRepository->getById($instruction, $id);

        return $vendorInvoice;
    }

    public function updateVendorInvoice($data, Instruction $instruction, $vendorInvoice)
    {
        if(isset($data['attachment'])){
            $this->deleteFile($vendorInvoice->attachment);
            $data['attachment'] = $this->storeFile($data['attachment'], $instruction->id);
        }

        if(isset($data['supporting_document'])){
            $this->deleteFile($vendorInvoice->supporting_document);
            $data['supporting_document'] = [$this->storeFile($data['supporting_document'], $instruction->id)];
        }

        if(isset($data['delete'])){
            $this->deleteFile($data['delete']);
            $this->vendorInvoiceRepository->pull($instruction, 'supporting_document', $data['delete']);
        }

        $vendorInvoice = $this->vendorInvoiceRepository->update($data, $vendorInvoice);

        return $vendorInvoice;
    }

    public function deleteVendorInvoice($vendorInvoice)
    {
        if(!empty($vendorInvoice->attachment)){
            $this->deleteFile($vendorInvoice->attachment);
        }

        if(count($vendorInvoice->supporting_document) === 0){
            foreach ($vendorInvoice->supporting_document as $supportingDocument) {
                $this->deleteFile($supportingDocument);
            }
        }

        $result = $this->vendorInvoiceRepository->delete($vendorInvoice);

        return $result;
    }

    public function storeFile(UploadedFile $file, $instructionId)
    {
        $path = Storage::putFile('instructions/' . $instructionId . '/vendor-invoices', $file);

        return $path;
    }

    public function deleteFile($data)
    {
        if(!empty($data)){
            return Storage::delete($data);
        }

        return false;
    }
}
