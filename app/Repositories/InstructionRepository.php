<?php

namespace App\Repositories;

use App\Models\Instruction;

class InstructionRepository
{
    private Instruction $instruction;

    public function __construct()
    {
        $this->instruction = new Instruction();
    }

    public function terminateInstruction(array $data, Instruction $instruction)
    {
        $instruction->push('activity_note', [[
            'note'         => "Terminated",
            'performed_by' => 'Daffa Pratama A.S',
            'date'         => now()->toDateTimeString(),
        ]]);

        $data = [
            'status' => 'Cancelled',
            'cancellation' => [
                'reason'      => $data['reason'],
                'canceled_by' => 'Daffa Pratama A.S',
                'attachment'  => $data['attachment']
            ]
        ];

        $instruction->update($data);
        return $instruction;
    }
}
