<?php

namespace App\Services;

use App\Http\Requests\FilterInstructionRequest;
use App\Models\Instruction;
use App\Repositories\InstructionRepository;
use Illuminate\Support\Facades\Storage;

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

        foreach ($instruction['costs'] as $key => $cost) {
            $instruction['costs'][$key]['qty'] = (int) $cost['qty'];
            $instruction['costs'][$key]['discount'] = (int) $cost['discount'];
            $instruction['costs'][$key]['vat'] = (int) $cost['vat'];
            $instruction['costs'][$key]['unit_price'] = round((int)$cost['unit_price'], 2);
            $instruction['costs'][$key]['sub_total'] = (float) $cost['sub_total'];
            $instruction['costs'][$key]['total'] = (float) $cost['total'];
        }

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

    public function terminateInstruction(array $data, Instruction $instruction)
    {
        $paths = [];

        foreach ($data['attachments'] as $attachment) {
            $path = Storage::putFile('instructions/' . $instruction->id . '/terminate', $attachment);
            $paths[] = $path;
        }

        $data['attachments'] = $paths;

        $vendor = $this->instructionRepository->terminateInstruction($data, $instruction);
        return $vendor;
    }

    public function filterInstruction(array $data)
    {
        $search = isset($data['search']) ? $data['search'] : null;

        if ($data['tab'] == "open") {
            $instruction = $this->instructionRepository->getInstructionsOpen($search);
        } else if ($data['tab'] == "completed") {
            $instruction = $this->instructionRepository->getInstructionsCompleted($search);
        }

        return $instruction;
    }
}
