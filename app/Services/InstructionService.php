<?php

namespace App\Services;

use App\Models\Instruction;
use App\Repositories\InstructionRepository;

class InstructionService
{
    private InstructionRepository $instructionRepository;

    public function __construct(InstructionRepository $instructionRepository)
    {
        $this->instructionRepository = $instructionRepository;
    }

    public function receiveInstruction(Instruction $instruction)
    {
        $instruction = $this->instructionRepository->updateStatusCompleted($instruction);

        return $instruction;
    }
}
