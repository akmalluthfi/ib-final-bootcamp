<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Instruction;
use App\Repositories\InstructionRepository;

class InstructionService
{
    private InstructionRepository $instructionRepository;

    public function __construct()
    {
        $this->instructionRepository = new InstructionRepository();
    }

    public function terminateInstruction(array $data, Instruction $instruction)
    {
        $path = Storage::putFile('instructions/' . $instruction->id . '/terminate', $data['attachment']);
        $data['attachment'] = $path;

        $vendor = $this->instructionRepository->terminateInstruction($data, $instruction);
        return $vendor;
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
