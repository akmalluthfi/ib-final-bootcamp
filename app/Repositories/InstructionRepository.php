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

    public function getAll()
    {
        $instruction = Instruction::paginate(10);

        return $instruction;
    }

    public function getInstructionsOpen()
    {
        $instruction = Instruction::where('status', 'In Progress')->orWhere('status', 'Draft')->paginate(10);

        return $instruction;
    }

    public function getInstructionsCompleted()
    {
        $instruction = Instruction::where('status', 'Complete')->orWhere('status', 'Cancelled')->paginate(10);

        return $instruction;
    }

    public function getAllInstruction()
    {
        return Instruction::latest()->paginate(10);
    }

    public function searchAndFind($search)
    {
        return $this->instruction->latest()
            ->where('_id', 'like', "%$search%")
            ->orWhere('instruction_id', 'like', "%$search%")
            ->orWhere('instruction_type', 'like', "%$search%")
            ->orWhere('customer', 'like', "%$search%")
            ->orWhere('link_to', 'like', "%$search%")
            ->orWhere('assigned_vendor', 'like', "%$search%")
            ->orWhere('attention_of', 'like', "%$search%")
            ->orWhere('quotation_no', 'like', "%$search%")
            ->orWhere('status', 'like', "%$search%")
            ->orWhere('customer_po_no', 'like', "%$search%")
            ->paginate(10);
    }
}
