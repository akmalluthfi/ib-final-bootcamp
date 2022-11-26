<?php

namespace App\Services;

use App\Models\Instruction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Repositories\VendorInvoiceRepository;
use MongoDB\BSON\ObjectId;

class VendorInvoiceService
{
    private VendorInvoiceRepository $vendorInvoiceRepository;

    public function __construct(VendorInvoiceRepository $vendorInvoiceRepository)
    {
        $this->vendorInvoiceRepository = $vendorInvoiceRepository;
    }

    public function storeVendorInvoice($data, Instruction $instruction)
    {
        $data['id'] = new ObjectId();

        $data['attachment'] = $this->storeFile($data['attachment'], $instruction->id, $data['id']);

        if(isset($data['supporting_documents'])){
            foreach ($data['supporting_documents'] as $index => $supportingDocument) {
                $data['supporting_documents'][$index] = $this->storeFile($supportingDocument, $instruction->id, $data['id']);
            }
        } else {
            $data['supporting_documents'] = [];
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
            $data['attachment'] = $this->storeFile($data['attachment'], $instruction->id, $vendorInvoice->id);
        }

        if(isset($data['supporting_documents'])){
            foreach ($data['supporting_documents'] as $index => $supportingDocument) {
                $data['supporting_documents'][$index] = $this->storeFile($supportingDocument, $instruction->id, $vendorInvoice->id);
            }
            $data['supporting_documents'] = array_merge($data['supporting_documents'], $vendorInvoice->supporting_documents);
        }

        if(isset($data['deleted_files'])){
            foreach ($data['deleted_files'] as $deletedFile) {
                $this->deleteFile($deletedFile);
            }

            $data['supporting_documents'] = array_diff($data['supporting_documents'] ?? $vendorInvoice->supporting_documents, $data['deleted_files']);
            unset($data['deleted_files']);
        }

        $vendorInvoice = $this->vendorInvoiceRepository->update($data, $vendorInvoice);

        return $vendorInvoice;
    }

    public function deleteVendorInvoice($vendorInvoice)
    {
        if(!empty($vendorInvoice->attachment)){
            $this->deleteFile($vendorInvoice->attachment);
        }

        if(count($vendorInvoice->supporting_documents) !== 0){
            foreach ($vendorInvoice->supporting_documents as $supportingDocument) {
                $this->deleteFile($supportingDocument);
            }
        }

        $result = $this->vendorInvoiceRepository->delete($vendorInvoice);

        return $result;
    }

    public function storeFile(UploadedFile $file, $instructionId, $vendorInvoiceId)
    {
        $path = $file->store('files/instructions/' . $instructionId . '/vendor-invoices/' . $vendorInvoiceId);

        return $path;
    }

    public function deleteFile($data)
    {
        if($data){
            return Storage::delete($data);
        }

        return false;
    }
}
