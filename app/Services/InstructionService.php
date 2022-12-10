<?php

namespace App\Services;

use App\Models\Instruction;
use App\Repositories\InstructionRepository;
use Illuminate\Support\Facades\Storage;

class InstructionService
{
    private InstructionRepository $instructionRepository;

    public function __construct(InstructionRepository $instructionRepository)
    {
        $this->instructionRepository = $instructionRepository;
    }

    public function storeInstruction($instruction, $attachments)
    {
        $instruction['no'] = $this->generateNo($instruction['type']);
        $instruction['quotation_no'] = strtoupper($instruction['quotation_no']);
        $instruction['customer_po_no'] = strtoupper($instruction['customer_po_no']);

        $instruction = $this->bindInstructionCosts($instruction);

        $instruction =  $this->instructionRepository->storeInstruction($instruction);

        if ($attachments) {
            $attachments = $this->storeAttachments($instruction->id, $attachments);
            $instruction = $this->instructionRepository->updateInstructionAttachments($instruction, $attachments);
        }

        return $instruction;
    }

    public function bindInstructionCosts($instruction)
    {
        foreach ($instruction['costs'] as $key => $cost) {
            $instruction['costs'][$key]['qty'] = (int) $cost['qty'];
            $instruction['costs'][$key]['discount'] = (int) $cost['discount'];
            $instruction['costs'][$key]['unit_price'] = round((int)$cost['unit_price'], 2);
            $instruction['costs'][$key]['vat'] = (int) $cost['vat'];
            $instruction['costs'][$key]['vat_ammount'] = (float) $cost['vat_ammount'];
            $instruction['costs'][$key]['sub_total'] = (float) $cost['sub_total'];
            $instruction['costs'][$key]['total'] = (float) $cost['total'];
        }

        return $instruction;
    }

    public function storeAttachments($instruction_id, $files)
    {
        $attachments = [];

        foreach ($files as $file) {
            if (!$file) continue;
            $attachments[] = $file->store('files/instructions/' . $instruction_id);
        }

        return $attachments;
    }

    public function updateAttachments(Instruction $instruction, $deleted_attachments, $newAttachments)
    {
        $attachments = [];

        if ($instruction->attachments) {
            if ($deleted_attachments) {

                foreach ($deleted_attachments as $deleted_attachment) {
                    Storage::delete($deleted_attachment);
                }

                $attachments = array_diff($instruction->attachments, $deleted_attachments);
            } else {
                $attachments = $instruction->attachments;
            }
        }

        if ($newAttachments) {
            $newAttachments = $this->storeAttachments($instruction->id, $newAttachments);
            $attachments = array_merge($attachments, $newAttachments);
        }

        return $attachments;
    }

    public function updateInstruction(Instruction $instruction, $validatedData)
    {
        $validatedData['attachments'] = $this->updateAttachments(
            $instruction,
            $validatedData['deleted_attachments'] ?? null,
            $validatedData['attachments'] ?? null
        );

        unset($validatedData['deleted_attachments']);
        $validatedData['no'] = $this->generateNoRev($instruction->no);
        $validatedData['quotation_no'] = strtoupper($validatedData['quotation_no']);
        $validatedData['customer_po_no'] = strtoupper($validatedData['customer_po_no']);
        $validatedData = $this->bindInstructionCosts($validatedData);

        return $this->instructionRepository->updateInstruction($instruction, $validatedData);
    }

    public function generateNoRev($no)
    {
        $revCount = 1;
        $items = explode("R", $no);
        if (count($items) > 1) {
            $revCount = (int)$items[1] + 1;
            $items[0] = rtrim($items[0]);
        }
        return "{$items[0]} R" . str_pad($revCount, 2, '0', STR_PAD_LEFT);
    }

    public function generateNo($type)
    {
        if ($type === 'LI') {
            $total = $this->instructionRepository->countForLogisticInstruction();
        } else {
            $total = $this->instructionRepository->countForServiceInstruction();
        }

        return "$type-" . date('Y') . '-' . str_pad($total + 1, 4, '0', STR_PAD_LEFT);
    }

    public function terminateInstruction(array $data, Instruction $instruction)
    {
        $data['attachments'] = isset($data['attachments']) ? $data['attachments'] : [];

        $paths = [];

        if ($data['attachments']) {
            foreach ($data['attachments'] as $attachment) {
                $path = Storage::putFile('files/instructions/' . $instruction->id . '/terminate', $attachment);
                $paths[] = $path;
            }
            $data['attachments'] = $paths;
        }

        $vendor = $this->instructionRepository->terminateInstruction($data, $instruction);

        return $vendor;
    }

    public function filterInstruction(array $data)
    {
        $search = $data['search'] ?? null;

        $data['tab'] = $data['tab'] ?? null;
        if ($data['tab'] == "open" || !$data['tab']) {
            $instruction = $this->instructionRepository->getInstructionsOpen($search);
        } else if ($data['tab'] == "completed") {
            $instruction = $this->instructionRepository->getInstructionsCompleted($search);
        }

        return $instruction;
    }

    public function receiveInstruction(Instruction $instruction)
    {
        $instruction = $this->instructionRepository->updateStatusCompleted($instruction);

        return $instruction;
    }
}
