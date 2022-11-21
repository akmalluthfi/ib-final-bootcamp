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

    public function terminateInstruction(array $data, Instruction $instruction)
    {
        $instruction->push('activity_notes', [[
            'note'         => "Terminated",
            'performed_by' => 'Daffa Pratama A.S',
            'date'         => now()->format('d/m/y h:i A'),
        ]]);

        $instruction->update([
            'status' => 'Cancelled',
            'cancellation' => [
                'reason'      => $data['reason'],
                'canceled_by' => 'Daffa Pratama A.S',
                'attachments' => $data['attachments']
            ]
        ]);

        return $instruction;
    }

    public function getInstructionsOpen($search)
    {
        $instruction = Instruction::latest()->where('status', 'In Progress')->orWhere('status', 'Draft')->paginate(10);

        if (isset($search) && $search) {
            $instruction->search($search);
        }

        return $instruction;
    }

    public function getInstructionsCompleted($search)
    {
        $instruction = Instruction::latest()->where('status', 'Complete')->orWhere('status', 'Cancelled')->paginate(10);

        if (isset($search) && $search) {
            $instruction->search($search);
        }

        return $instruction;
    }
}
