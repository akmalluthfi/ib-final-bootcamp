<?php

namespace App\Http\Controllers;

use App\Exports\InstructionsExport;
use App\Models\Instruction;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function exportToExcel()
    {
        return Excel::download(new InstructionsExport, 'instructions.xlsx');
    }

    public function exportToPdf(Instruction $instruction)
    {
        # code...
    }
}
