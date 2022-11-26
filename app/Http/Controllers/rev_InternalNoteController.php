<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Services\InternalNoteService;
use App\Http\Resources\InternalNoteResource;

class rev_InternalNoteController extends Controller
{
    private InternalNoteService $internalNoteService;

    public function __construct(InternalNoteService $internalNoteService)
    {
        $this->internalNoteService = $internalNoteService;
    }

    public function addInternalNote(Request $request, Instruction $instruction)
    {
        // $user = auth()->user();
        $user = "dummy";

		$data = [
            'note' => $request->note,
            'noted_by' => $user
		];

        $internalNote = $this->internalNoteService->storeInternalNote($data, $instruction);
        return (new InternalNoteResource($internalNote, 'Successfully created internal note'))->response()->setStatusCode(201);
    }

    public function editInternalNote(Request $request, Instruction $instruction, $id)
    {
        // $user = auth()->user();
        $user = "dadsa";

        $data = [
            'note' => $request->note,
            'user' => $user
        ];
        // return $instruction->internal->notes[0];
        $internalNote = $this->internalNoteService->updateInternalNote($data, $instruction, $id);
        return (new InternalNoteResource($internalNote, 'Successfully updated internal note'))->response()->setStatusCode(200);
    }

    public function deleteInternalNote(Instruction $instruction, $id)
    {
        // $user = auth()->user();
        $user = "dummy";

        $result = $this->internalNoteService->deleteInternalNote($user, $instruction, $id);
        return $result;
    }
}
