<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "name" => $this->name,
            "username" => $this->username,
            "phone" => $this->phone,
            "email" => $this->email,
            "address" => $this->address,
            "role" => $this->role,
            "bio" => $this->bio,
            "dob" => $this->dob,
            "height" => $this->height,
            "weight" => $this->weight,
            "color" => $this->color,
            "gender" => $this->gender,
            "marital_status" => $this->marital_status,
            "nationality" => $this->nationality,
            "active" => $this->active,
            "profile" => $this->profile,
            "created_at" => $this->created_at->diffForHumans()
        ];
    }
}
