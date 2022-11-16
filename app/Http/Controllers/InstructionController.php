<?php

namespace App\Http\Controllers;

use App\Http\Requests\TerminateInstructionRequest;
use App\Services\InstructionService;
use App\Http\Resources\InstructionCollection;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function index(Request $request)
    {
        $data = $request->validate([
            'page' => Rule::in(['Open', 'Completed'])
        ]);

        if ($request->page == "Open") {
            $instruction = $this->instructionService->getInstructionsOpen();
        } else if ($request->page == "Completed") {
            $instruction = $this->instructionService->getInstructionsCompleted();
        } else {
            $instruction = $this->instructionService->getAllInstruction();
        }
        return new InstructionCollection($instruction);
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
    public function show(Instruction $instruction)
    {
        return response()->json([
            'status'   => 200,
            'message'  => 'Show Detail Instruction Successfully',
            'data'     => $instruction,
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

    public function terminate(TerminateInstructionRequest $request, Instruction $instruction)
    {
        $data = $request->validated();

        $instructionSave = $this->instructionService->terminateInstruction($data, $instruction);

        return response()->json([
            'status'  => 200,
            'message' => 'Terminate Instruction Successfully',
            'data'    => $instructionSave
        ]);
    }
}
