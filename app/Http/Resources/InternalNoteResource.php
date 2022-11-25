<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InternalNoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($request->routeIs('instruction.internal.delete-note')){
            return [
                'message' => 'Successfully deleted internal note'
            ];
        }


        return [
            'message' => 'Successfully created internal note',
            'data' => [
                'id' => $this->_id,
                'note' => $this->note,
                'noted_by' => $this->noted_by,
                'updated_at' => $this->updated_at
            ],
        ];
    }
}
