<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function __construct($user = null, string $message = null, $authorization = null)
    {
        parent::__construct($user);
        $this->message = $message;
        $this->token = $authorization['token'] ?? null;
        $this->exp = $authorization['exp'] ?? 60;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'message' => $this->message,
            'data' => [
                'user' => [
                    '_id' => $this->id,
                    'name' => $this->name,
                    'email' => $this->email
                ],
                $this->mergeWhen($this->token, [
                    'authorization' => [
                        'token' => $this->token,
                        'type' => 'Bearer',
                        'expired' => $this->exp * 60, // in seconds
                    ]
                ])
            ]
        ];
    }
}
