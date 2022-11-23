<?php

namespace App\Repositories;

use App\Models\Instruction;

class InstructionRepository
{
    public function storeInstruction($instruction)
    {
        $dataSaved = [
            'status' => 'In Progress',
            'no' => $instruction['no'],
            'type' => $instruction['type'],
            'assigned_vendor' => $instruction['assigned_vendor'],
            'attention_of' => $instruction['attention_of'],
            'quotation_no' => $instruction['quotation_no'],
            'vendor_address' => $instruction['vendor_address'],
            'invoice_to' => $instruction['invoice_to'],
            'customer' => $instruction['customer'],
            'customer_po_no' => $instruction['customer_po_no'],
            'costs' => $instruction['costs'],
            'attachments' => [],
            'note' => $instruction['note'],
            'link_to' => $instruction['link_to'],
            'activity_notes' => [
                [
                    'note' => 'Created 3rd Party Instruction',
                    'performed_by' => 'Alfi',
                    'date' => now()->format('d/m/y h:i A')
                ]
            ],
            'cancellation' => null
        ];

        return Instruction::create($dataSaved);
    }

    public function countForLogisticInstruction()
    {
        return Instruction::where('type', 'LI')->count();
    }

    public function updateInstructionAttachments(Instruction $instruction, $attachments)
    {
        $instruction->update([
            'attachments' => $attachments
        ]);

        return $instruction;
    }

    public function updateInstruction(Instruction $instruction, $newInstruction)
    {
        $activity_notes = $instruction->activity_notes;
        $activity_notes[] = [
            'note' => 'Edited 3rd Party Instruction',
            'performed_by' => 'Alfi',
            'date' => now()->format('d/m/y h:i A')
        ];

        $newInstruction['activity_notes'] = $activity_notes;

        $instruction->update($newInstruction);
        return $instruction;
    }
}
