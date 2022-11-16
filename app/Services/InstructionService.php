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
        $path = Storage::putFile('public/instructions/' . $instruction->id . '/terminate', $data['attachment']);
        $data['attachment'] = $path;

        $vendor = $this->instructionRepository->terminateInstruction($data, $instruction);
        return $vendor;
    }
}
