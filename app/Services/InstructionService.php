<?php

namespace App\Services;

use App\Repositories\InstructionRepository;

class InstructionService
{
    private InstructionRepository $instructionRepository;

    public function __construct()
    {
        $this->instructionRepository = new InstructionRepository();
    }

    public function getInstruction($id)
    {
        $instruction = $this->instructionRepository->getById($id);
        return $instruction;
    }

    public function getById(string $id)
    {
        $instruction = $this->instructionRepository->getById($id);
        return $instruction;
    }

    public function updateInstruction(array $data, $idInstruction)
    {
        $id = $this->instructionRepository->saveInstruction($data, $idInstruction);
        return $id;
    }
}
