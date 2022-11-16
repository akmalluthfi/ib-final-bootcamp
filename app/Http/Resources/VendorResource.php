<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($request->routeIs('vendor.add-address')) {
            return [
                'message' => 'Add vendor address successfully',
                'data' => [
                    'id' => $this->id,
                    'name' => $this->name,
                    'addresses' => $this->addresses
                ]
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'addresses' => $this->addresses
        ];
    }
}
