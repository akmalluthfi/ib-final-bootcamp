<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InternalNoteResource extends JsonResource
{
    public function __construct($resource, $message)
    {
        parent::__construct($resource);
        $this->message = $message;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($request->routeIs('instructions.internal-note.destroy') ){
            return [
                'message' => $this->message,
                'data' => [

                ]
            ];
        }

        return [
            'message' => $this->message,
            'data' => [
                'id' => $this->_id,
                'note' => $this->note,
                'noted_by' => $this->noted_by,
                'user_id' => $this->user_id,
                'updated_at' => $this->updated_at
            ],
        ];

    }
}
