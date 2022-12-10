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

    public function getNote($internal, $id)
    {
        return $this->internalNoteRepository->getById($internal, $id);
    }

    public function storeInternalNote($note, $internal)
    {
        return $this->internalNoteRepository->create($note, $internal);
    }

    public function updateInternalNote($newNote, $internal, $id)
    {
        return $this->internalNoteRepository->update($newNote, $internal, $id);
    }

    public function deleteInternalNote($internal,  $id)
    {
        return $this->internalNoteRepository->delete($internal,  $id);

    }
}
