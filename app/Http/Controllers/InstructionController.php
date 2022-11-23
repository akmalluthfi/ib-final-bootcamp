<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructionRequest;
use App\Http\Requests\TerminateInstructionRequest;
use App\Http\Requests\FilterInstructionRequest;
use App\Http\Resources\InstructionCollection;
use App\Http\Resources\InstructionResource;
use App\Models\Instruction;
use App\Services\InstructionService;
use Illuminate\Http\Request;
use App\Exceptions\SearchNotFoundException;

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
    public function index(FilterInstructionRequest $request)
    {
        $data = $request->validated();

        $instruction = $this->instructionService->filterInstruction($data);

        if ($instruction->count() <= 0) throw new SearchNotFoundException('Instruction not found');

        return new InstructionCollection($instruction);
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
        return (new InstructionResource($instruction, 'Show instruction successfully'));
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
        if ($instruction->status !== 'In Progress') {
            return response()->json(['message' => 'The instruction.status must be In Progress'], 400);
        }

        $instruction = $this->instructionService->receiveInstruction($instruction);
        
        return new InstructionResource($instruction, 'Received instruction successfully');
    }

    public function terminate(TerminateInstructionRequest $request, Instruction $instruction)
    {
        if ($instruction->status !== "In Progress") {
            return response()->json(['message' => 'The instruction.status must be In Progress'], 400);
        }

        $data = $request->validated();
        
        $instructionSave = $this->instructionService->terminateInstruction($data, $instruction);

        return (new InstructionResource($instructionSave, 'Terminate instruction successfully'));
    }
}
