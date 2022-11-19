<?php

namespace App\Services;

use App\Repositories\InstructionRepository;

class InstructionService
{
    protected $instructionRepository;

    public function __construct(InstructionRepository $instructionRepository)
    {
        $this->instructionRepository = $instructionRepository;
    }

    public function storeInstruction($instruction)
    {
        $instruction['no'] = $this->generateNo($instruction['type']);

        $costs = [];
        foreach ($instruction['costs'] as $cost) {
            $costs[] = [
                "description" => $cost['description'],
                "qty" => (int) $cost['qty'],
                "uom" => $cost['uom'],
                "unit_price" => (float) $cost['unit_price'],
                "discount" => (int) $cost['discount'],
                "vat" => (int) $cost['vat'],
                "sub_total" => (float) $cost['sub_total'],
                "total" => (float) $cost['total'],
                "charge_to" => $cost['charge_to'],
            ];
        }

        $instruction['costs'] = $costs;

        return $this->instructionRepository->storeInstruction($instruction);
    }

    public function storeAttachments($instruction, $files)
    {
        $attachments = [];

        foreach ($files as $file) {
            $attachments[] = $file->store('files/instructions/' . $instruction->id);
        }

        return $this->instructionRepository->updateAttachments($instruction, $attachments);
    }

    public function generateNo($type)
    {
        $total = $this->instructionRepository->countForLogisticInstruction();
        return "$type-" . date('Y') . '-' . str_pad($total + 1, 4, '0', STR_PAD_LEFT);
    }
}
