<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\InstructionService;
use App\Http\Requests\InstructionRequest;
use App\Http\Resources\InstructionResource;
use App\Http\Resources\InstructionCollection;
use Illuminate\Validation\ValidationException;

class InstructionController extends Controller
{
    private InstructionService $instructionService;

    public function __construct(InstructionService $instructionService)
    {
        $this->instructionService = $instructionService;
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
    public function store(InstructionRequest $request)
    {
        $instruction = $this->instructionService->storeInstruction($request->validated());

        if ($files = $request->file('attachments')) {
            $instruction = $this->instructionService->storeAttachments($instruction, $files);
        }

        return (new InstructionResource($instruction, 'Created instruction successfully'))
            ->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function show(Instruction $instruction)
    {
        //
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

    public function receive(Instruction $instruction)
    {
        if($instruction->status === 'In Progress'){
            $instruction = $this->instructionService->receiveInstruction($instruction);
        } else {
            return response()->json(['message' => 'The instruction.status must be In Progress'], 400);
        }

        return new InstructionResource($instruction, 'Received instruction successfully');
    }
}
