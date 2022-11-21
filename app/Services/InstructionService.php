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
        if ($data['tab'] == "open") {
            $instruction = $this->getInstructionsOpen();
        } else if ($data['tab'] == "completed") {
            $instruction = $this->getInstructionsCompleted();
        } else {
            $instruction = $this->getAllInstruction();
        }

        return $instruction;
    }

    public function getInstruction($search)
    {
        if (is_null($search)) return $this->instructionRepository->getAllInstruction();

        return $this->instructionRepository->searchAndFind($search);
    }

    public function getAllInstruction()
    {
        $instruction = $this->instructionRepository->getAll();
        return $instruction;
    }

    public function getInstructionsOpen()
    {
        $instruction = $this->instructionRepository->getInstructionsOpen();
        return $instruction;
    }

    public function getInstructionsCompleted()
    {
        $instruction = $this->instructionRepository->getInstructionsCompleted();
        return $instruction;
    }
}
