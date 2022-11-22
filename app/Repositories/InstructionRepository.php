<?php

namespace App\Repositories;

use App\Models\Instruction;

class InstructionRepository
{
    public function storeInstruction($instruction)
    {
        $instruction['status'] = 'In Progress';
        $instruction['attachments'] = null;
        $instruction['cancellation'] = null;
        $instruction['activity_notes'][] = [
            'note' => 'Created Instruction',
            'performed_by' => 'Alfi',
            'date' => now()->format('d/m/y h:i A')
        ];

        return Instruction::create($instruction);
    }

    public function countForLogisticInstruction()
    {
        return Instruction::where('type', 'LI')->count();
    }

    public function updateAttachments($instruction, $attachments)
    {
        $instruction->update([
            'attachments' => $attachments
        ]);

        return $instruction;
    }

    public function updateStatusCompleted(Instruction $instruction)
    {
        $instruction->push('activity_notes', [[
            'note' => 'Received All Invoice 3rd Party Instruction',
            'performed_by' => 'Ricko Haikal Y.K',
            'date' => now()->format('d/m/y h:i A')
        ]]);

        $instruction->update(['status' => 'Completed']);

        return $instruction;
    }
}
