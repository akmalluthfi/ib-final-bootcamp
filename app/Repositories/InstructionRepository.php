<?php

namespace App\Repositories;

use App\Models\Instruction;

use Illuminate\Support\Facades\DB;

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
}
