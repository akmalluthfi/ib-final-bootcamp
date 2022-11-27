<?php

namespace App\Http\Controllers;

use App\Exports\InstructionsExport;
use App\Http\Requests\SendEmailRequest;
use App\Mail\InstructionReport;
use App\Models\Instruction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function exportToExcel()
    {
        return Excel::download(new InstructionsExport, 'instructions.xlsx');
    }

    public function exportToPdf(Instruction $instruction)
    {
        return $this->generateAndSavePdf($instruction)->stream();
    }

    public function generateAndSavePdf(Instruction $instruction)
    {
        $instructionId = $instruction->id;

        $pdf = Pdf::loadView('pdf.instructions.show', [
            'instruction' => $instruction
        ]);

        Storage::put("files/instructions/$instructionId/pdf/output.pdf", $pdf->download()->getOriginalContent());

        return $pdf;
    }

    public function sendEmail(SendEmailRequest $request, $instructionId)
    {
        $validatedData = $request->validated();

        foreach ($validatedData['recipients'] as $recipient) {
            if (!Storage::exists('/files/instructions/' . $instructionId . '/pdf/output.pdf')) {
                $this->generateAndSavePdf(Instruction::findOrFail($instructionId));
            }
            Mail::to($recipient)->send(new InstructionReport("files/instructions/$instructionId/pdf/output.pdf"));
        }
    }
}
