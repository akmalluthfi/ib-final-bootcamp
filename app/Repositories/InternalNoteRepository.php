<?php

namespace App\Repositories;

use App\Models\Instruction;

class InternalNoteRepository
{
    public function create($note, Instruction $instruction)
    {
        $noteSaved = [
			'_id'=> (string) new \MongoDB\BSON\ObjectId(),
            'note' => $note['note'],
            'noted_by' => 'whisnoo',
            'user_id' => '6383898895512a62ee06d389'
            // 'noted_by' => auth()->user()->name,
            // 'user_id' => auth()->user()->id
        ];

        $internal = $instruction->internal;
        return $internal->notes()->create($noteSaved);
    }

    public function getById(Instruction $instruction, $noteId)
    {
        $internal = $instruction->internal;
        $note = $internal->notes->firstOrFail(function ($value) use ($noteId) {
            return $value->id == $noteId;
        });

        return $note;
    }

    public function update($newNote, Instruction $instruction, $noteId)
    {
        $note = $this->getById($instruction, $noteId);
        $note->note = $newNote['note'];
        $note->save();
        return $note;
    }

    public function delete(Instruction $instruction, $id)
    {
        $note = $this->getById($instruction, $id);
        return $note->delete();
    }
}
