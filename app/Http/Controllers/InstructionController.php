<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstructionRequest;
use App\Http\Resources\InstructionCollection;
use App\Http\Resources\InstructionResource;
use App\Models\Instruction;
use App\Services\InstructionService;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    protected $instructionService;

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
     * @param  \App\Http\Requests\InstructionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstructionRequest $request)
    {
        $instruction = $this->instructionService->storeInstruction($request->validated(), $request->file('attachments'));

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
     * @param  \App\Http\Requests\InstructionRequest  $request
     * @param  \App\Models\Instruction  $instruction
     * @return \Illuminate\Http\Response
     */
    public function update(InstructionRequest $request, Instruction $instruction)
    {
        $validatedData = $request->safe()->except(['deleted_attachments']);

        $attachments = $this->instructionService->updateAttachments($instruction, $request->post('deleted_attachments'), $request->file('attachments'));

        $validatedData['attachments'] = $attachments;

        $instruction = $this->instructionService->updateInstruction($instruction, $validatedData);

        return new InstructionResource($instruction, 'Edited instruction successfully');
    }
}
