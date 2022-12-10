<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceTargetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($request->routeIs('invoice-target.index')) {
            return [
                'id' => $this->id,
                'name' => $this->name
            ];
        }

        return [
            'message' => 'Invoice target created successfully',
            'data' => [
                'id' => $this->id,
                'name' => $this->name
            ]
        ];
    }
}
