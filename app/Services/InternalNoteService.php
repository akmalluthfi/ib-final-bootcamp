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

    public function getNote(Instruction $instruction, $noteId)
    {
        return $this->internalNoteRepository->getById($instruction, $noteId);
    }

    public function storeInternalNote($note, Instruction $instruction)
    {
        return $this->internalNoteRepository->create($note, $instruction);
    }

    public function updateInternalNote($newNote, Instruction $instruction, $noteId)
    {
        return $this->internalNoteRepository->update($newNote, $instruction, $noteId);
    }

    public function deleteInternalNote(Instruction $instruction,  $noteId)
    {
        $note = $this->internalNoteRepository->getById($instruction, $noteId);
        // $user = auth()->user()->id;
        $user = '6383898895512a62ee06d389-tes';

        if($user == $note->user_id) {
            return $this->internalNoteRepository->delete($instruction,  $noteId);
        }
        return 'Failed, the note is not yours';
    }
}
