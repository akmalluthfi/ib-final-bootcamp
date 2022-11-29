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
        if( $this->routeIs('instructions.internal-notes.store') ) {
            return true;
        }
        $internal = $this->instruction->internal;
        $note = $internal->notes()->find($this->route('internal_note'));
        return $note->user_id === (auth()->user()->id ?? '6383898895512a62ee06d389');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if( $this->routeIs('instructions.internal-notes.destroy') ) {
            return [

            ];
        }

        return [
            'note' => 'required | string'
        ];


    }
}
