<?php

namespace App\Http\Requests;

use App\Exceptions\Handler;
use App\Models\Instruction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Finder\Exception\AccessDeniedException;

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

        $note = $this->instruction->internal->notes->find($this->route('internal_note'));
        if (is_null($note)) throw new ModelNotFoundException();

        if( $note->user_id === (auth()->user()->id ?? '6383898895512a62ee06d389-tes') ) {
            return true;
        } else {
            throw new AccessDeniedException();
        }
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
