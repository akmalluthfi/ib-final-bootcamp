<?php

namespace App\Http\Requests;

use App\Models\Instruction;
use Illuminate\Foundation\Http\FormRequest;

class InternalNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $user_id = auth()->user()->id;
        $user_id = '6383898895512a62ee06d389';
        if( $this->routeIs('instruction.internal-note.store') ) {
            return true;
        }
        $internal = $this->instruction->internal;
        $note = $internal->notes()->find($this->route('internal_note'));
        return $note->user_id === $user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}
