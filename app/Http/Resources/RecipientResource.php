<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipientResource extends JsonResource
{
    protected $message;

    public function __construct($recipient, $message)
    {
        parent::__construct($recipient);
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
        if ($request->routeIs('recipients.index')) {
            return [
                'data' => [
                    'id' => $this->id,
                    'created_at' => $this->updated_at->format('d/m/y h:i A'),
                    'updated_at' => $this->updated_at->format('d/m/y h:i A'),
                    'email' => $this->email
                ]
            ];
        } else {
            return $this->toArrayAll();
        }
    }

    public function toArrayAll()
    {
        return [
            'messsage' => $this->message,
            'data' => [
                'id' => $this->id,
                'created_at' => $this->updated_at->format('d/m/y h:i A'),
                'updated_at' => $this->updated_at->format('d/m/y h:i A'),
                'email' => $this->email
            ]
        ];
    }
}
