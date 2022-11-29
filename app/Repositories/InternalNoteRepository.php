<?php

namespace App\Repositories;

use App\Models\Instruction;

class InternalNoteRepository
{
    public function create($note, $internal)
    {
        $noteSaved = [
			'_id'=> (string) new \MongoDB\BSON\ObjectId(),
            'note' => $note['note'],
            'noted_by' => auth()->user()->name ?? "Whisnoo",
            'user_id' => auth()->user()->id ?? "6383898895512a62ee06d389"
        ];

        return $internal->notes()->create($noteSaved);
    }

    public function getById($internal, $id)
    {
        $note = $internal->notes->firstOrFail(function ($value) use ($id) {
            return $value->id == $id;
        });

        return $note;
    }

    public function update($newNote, $internal, $id)
    {
        $note = $this->getById($internal, $id);
        $note->update($newNote);
        return $note;
    }

    public function delete($internal, $id)
    {
        $note = $this->getById($internal, $id);
        return $note->delete();
    }
}
