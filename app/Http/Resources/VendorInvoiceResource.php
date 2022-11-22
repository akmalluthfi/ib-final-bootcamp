<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorInvoiceResource extends JsonResource
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
        if($request->routeIs('instructions.show')){
            return [
                'id' => $this->_id,
                'no' => $this->no,
                'attachment' => $this->attachment,
                'supporting_documents' => $this->supporting_documents
            ];
        }

        return [
            'message' => $this->message,
            'data' => [
                'id' => $this->id,
                'no' => $this->no,
                'attachment' => $this->attachment,
                'supporting_documents' => $this->supporting_documents
            ]
        ];
    }
}
