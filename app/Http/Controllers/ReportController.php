<?php

namespace App\Http\Controllers;

use App\Exports\InstructionsExport;
use App\Models\Instruction;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function exportToExcel()
    {
        return Excel::download(new InstructionsExport, 'instructions.xlsx');
    }

    public function exportToPdf(Instruction $instruction)
    {
        $pdf = Pdf::loadView('pdf.instructions.show', [
            'instruction' => $instruction
        ]);

        return $pdf->stream();
    }
}
