<?php

namespace App\Services;

use App\Models\Instruction;
use App\Repositories\InternalNoteRepository;

class InternalNoteService
{
    private InternalNoteRepository $internalNoteRepository;

    public function __construct(InternalNoteRepository $internalNoteRepository)
    {
        $this->internalNoteRepository = $internalNoteRepository;
    }

    public function getInternalNote(Instruction $instruction, $id)
    {
        $vendorInvoice = $instruction->vendorInvoices->firstOrFail(function ($value) use ($id) {
            return $value->id == $id;
        });

        return $vendorInvoice;
    }

    public function storeInternalNote($data, Instruction $instruction)
    {
        $internalNote = $this->internalNoteRepository->create($data, $instruction);
        return $internalNote;
    }

    public function updateInternalNote($data, Instruction $instruction, $id)
    {
        $internalNote = $this->internalNoteRepository->update($data, $instruction, $id);
        return $internalNote;
    }

    public function deleteInternalNote($user, Instruction $instruction, $id)
    {
        $internalNote = $this->internalNoteRepository->delete($user, $instruction, $id);
        return $internalNote;
    }
}
