<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Services\InternalNoteService;
use App\Http\Requests\InternalNoteRequest;
use App\Http\Resources\InternalNoteResource;
use Exception;

class InternalNoteController extends Controller
{
    private InternalNoteService $internalNoteService;

    public function __construct(InternalNoteService $internalNoteService)
    {
        $this->internalNoteService = $internalNoteService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternalNoteRequest $request, Instruction $instruction)
    {
        try {
            $note = $request->validated();
            $internalNote = $this->internalNoteService->storeInternalNote($note, $instruction->internal);
            return (new InternalNoteResource($internalNote, 'Sucessfully created internal note'))->response()->setStatusCode(201);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InternalNoteRequest $request, Instruction $instruction, $id)
    {
        
        try {
            $newNote = $request->validated();
            $internalNote = $this->internalNoteService->updateInternalNote($newNote, $instruction->internal, $id);
            if(is_object($internalNote))
            {
                return (new InternalNoteResource($internalNote, 'Successfully updated internal note'))->response()->setStatusCode(200);
            }
            return $internalNote;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InternalNoteRequest $request, Instruction $instruction, $id)
    {
        // $this->authorize('delete', $instruction->internal);
        try {
            $result = $this->internalNoteService->deleteInternalNote($instruction->internal, $id);
            if($result == 1) {
                return response()->json(['message' => 'Successfully deleted internal note'], 200);
            }
            return response()->json(['message' => 'Oops, something went wroong'], 202);
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
}
