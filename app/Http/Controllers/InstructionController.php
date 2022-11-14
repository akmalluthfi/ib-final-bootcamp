<?php

namespace App\Http\Controllers;

use App\Services\InstructionService;
use App\Http\Resources\InstructionCollection;
use App\Models\Instruction;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function __construct()
    {
        $this->instructionService = new InstructionService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructions = Instruction::paginate(10, [
            'instruction_id',
            'instruction_type',
            'link_to',
            'assigned_vendor',
            'attention_of',
            'quotation_no',
            'customer_po',
            'status'
        ]);

        return new InstructionCollection($instructions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function show(/* Instruction $instruction */$id)
    {
        return response()->json([
            'status'   => 200,
            'message'  => 'Show Detail Instruction Successfully',
            'data'     => $this->instructionService->getInstruction($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instruction $instruction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instruction $instruction)
    {
        //
    }

    public function terminate(Request $request, $id)
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
