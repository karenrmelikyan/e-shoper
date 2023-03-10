<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            //'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            //'age' => $this->age,
            'address' => $this->address,
            'email' => $this->email,
            //'role' => $this->role,
            'mobile' => $this->mobile,
            'country' => $this->country,
            'zip_code' => $this->zip_code,
        ];
    }
}
