<?php

namespace App\Http\Controllers;

use App\Services\InstructionService;

use Illuminate\Http\Request;

class InstructionController extends Controller
{
    private InstructionService $instructionService;

    public function __construct()
    {
        $this->instructionService = new InstructionService();
    }

    public function detailInstruction($id)
    {
        return response()->json([
            'status'   => 200,
            'message'  => 'Show Detail Instruction Successfully',
            'data'     => $this->instructionService->getInstruction($id),
        ]);
    }

    public function terminateInstruction(Request $request, $id)
    {
        $request->validate([
            'reason'     => 'required|string',
            'attachment' => 'required|file|mimes:png,jpg'
        ]);

        $data = [
            'reason'     => $request->reason,
            'attachment' => $request->attachment,
        ];

        $dataSaved = [
            'canceled_by' => 'Daffa Pratama A.S',
            'reason'      => $data['reason'],
            'attachment'  => $data['attachment'],
        ];

        $fileName = time() . $request->file('attachment')->getClientOriginalName();
        $path = $request->file('attachment')->storeAs('attachment', $fileName, 'public');
        $dataSaved['attachment'] = $path;
        $idInstruction = $this->instructionService->getById($id);
        $instructionSave = $this->instructionService->updateInstruction($dataSaved, $idInstruction->id);

        return response()->json([
            'status'  => 200,
            'message' => 'Terminate Instruction Successfully',
        ]);
    }
}
