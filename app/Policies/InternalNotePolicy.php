<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Instruction;
use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternalNotePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(Instruction $instruction, $request)
    {
        $internal = $instruction->internal;
        $note = $internal->notes()->find($request->route('internal_note'));
        return $note->user_id === (auth()->user()->id ?? '6383898895512a62ee06d389');
    }

    public function delete($internal)
    {
        return $internal->notes()->user_id === (auth()->user()->id ?? '6383898895512a62ee06d389');
    }
}
