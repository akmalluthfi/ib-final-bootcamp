<?php

namespace App\Exports;

use App\Models\Instruction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InstructionsExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Instruction::all([
            'no',
            'link_to',
            'type',
            'assigned_vendor',
            'attention_of',
            'quotation_no',
            'customer_po_no',
            'status',
        ]);
    }

    /**
     * @var Instruction $instruction
     */
    public function map($instruction): array
    {
        return [
            $instruction->no,
            $instruction->link_to,
            $instruction->type,
            $instruction->assigned_vendor,
            $instruction->attention_of,
            $instruction->quotation_no,
            $instruction->customer_po_no,
            $instruction->status,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Link To',
            'Type',
            'Assigned Vendor',
            'Attention Of',
            'Quotation No',
            'Customer PO',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }
}
