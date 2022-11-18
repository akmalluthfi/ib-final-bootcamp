<?php

namespace App\Repositories;

use App\Models\Instruction;

class InstructionRepository
{
    public function updateStatusCompleted(Instruction $instruction)
    {
        $instruction->push('activity_note', [[
            'note' => 'Received',
            'noted_by' => 'Ricko Haikal Y.K',
            'date' => now()->toDateTimeString()
        ]]);

        $instruction->update(['status' => 'Complete']);

        return $instruction;
    }
}
