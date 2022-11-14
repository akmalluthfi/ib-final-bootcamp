<?php

namespace App\Repositories;

use App\Models\Instruction;
use Carbon\Carbon;

class InstructionRepository
{
    private Instruction $instruction;

    public function __construct()
    {
        $this->instruction = new Instruction();
    }

    public function getById(string $id)
    {
        $id = $this->instruction->find(['_id' => $id])->first();
        return $id;
    }

    public function saveInstruction(array $data, $idInstruction)
    {
        $date = Carbon::now();
        $id = $this->getById($idInstruction);
        $activityNote = $id->activity_note;
        $activityNote[] = [
            'note'         => "Terminated",
            'performed_by' => $data['canceled_by'],
            'date'         => $date->toDateTimeString(),
        ];

        $data = [
            'status' => 'Cancelled',
            'activity_note' => $activityNote,
            'cancellation' => [
                'reason'      => $data['reason'],
                'canceled_by' => $data['canceled_by'],
                'attachment'  => [
                    $data['attachment']
                ]
            ]
        ];

        $id->update($data);
        return $id;
    }
}
