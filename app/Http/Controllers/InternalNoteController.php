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
            $note = $request->only('note');
            $internalNote = $this->internalNoteService->storeInternalNote($note, $instruction);
            return (new InternalNoteResource($internalNote, 'Sucessfully created internal note'))->response()->setStatusCode(201);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InternalNoteRequest $request, Instruction $instruction, $noteId)
    {
        try {
            $newNote = $request->only('note');
            $internalNote = $this->internalNoteService->updateInternalNote($newNote, $instruction, $noteId);
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
    public function destroy(Instruction $instruction, $noteId)
    {
        try {
            $result = $this->internalNoteService->deleteInternalNote($instruction, $noteId);
            if($result == 1) {
                return (new InternalNoteResource($result, 'Successfully deleted internal note'))->response()->setStatusCode(202);
            }
            return $result;
        }
        catch (Exception $e){
            return $e->getMessage();
        }
    }
}
