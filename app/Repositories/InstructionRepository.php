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

    public function getAll()
    {
        $instruction = $this->instruction->paginate(10, [
            'instruction_id',
            'instruction_type',
            'link_to',
            'assigned_vendor',
            'attention_of',
            'quotation_no',
            'customer_po',
            'status'
        ]);

        return $instruction;
    }

    public function getInstructionsOpen()
    {
        $instruction = $this->instruction->where('status', 'In Progress')->orWhere('status', 'Draft')->paginate(10, [
            'instruction_id',
            'instruction_type',
            'link_to',
            'assigned_vendor',
            'attention_of',
            'quotation_no',
            'customer_po',
            'status'
        ]);

        return $instruction;
    }

    public function getInstructionsCompleted()
    {
        $instruction = $this->instruction->where('status', 'Complete')->orWhere('status', 'Cancelled')->paginate(10, [
            'instruction_id',
            'instruction_type',
            'link_to',
            'assigned_vendor',
            'attention_of',
            'quotation_no',
            'customer_po',
            'status'
        ]);

        return $instruction;
    }

    public function getAllInstruction()
    {
        return $this->instruction->latest()->limit(10)->get();
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
            ->limit(10)
            ->get();
    }
}
