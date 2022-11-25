<?php

namespace App\Repositories;

use App\Models\Instruction;

class InternalNoteRepository
{
    public function create($data, Instruction $instruction)
    {
        $noteSaved = [
			'_id'=> (string) new \MongoDB\BSON\ObjectId(),
            'note' => $data['note'],
            'noted_by' => $data['noted_by']
		];

        $internal = $instruction->internal;
        $note = $internal->notes()->create($noteSaved);
        $note->save();

        return $note;
    }

    public function getById(Instruction $instruction, $id)
    {
        $internal = $instruction->internal;
        $note = $internal->notes->firstOrFail(function ($value) use ($id) {
            return $value->id == $id;
        });

        return $note;
    }

    public function update($data, Instruction $instruction, $id)
    {
        $note = $this->getById($instruction, $id);

        if($data['user'] == $note->noted_by) {
            $note->note = $data['note'];
            $note->save();
            return $note;
        } else {
            return 'Failed, the note is not yours';
        }
    }

    public function delete($user, Instruction $instruction, $id)
    {
        $note = $this->getById($instruction, $id);

        if($user == $note->noted_by) {
            $note->delete();
            return response()->json(['message' => 'Successfully deleted internal note']);
        } else {
            return response()->json(['message' => 'Failed, the note is not yours']);
        }
    }
}
