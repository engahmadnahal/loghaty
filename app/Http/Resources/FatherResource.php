<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FatherResource extends JsonResource
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
            'id' => $this->id,
            'email' => $this->email,
            'email_verified_at' => is_null($this->email_verified_at) ? 'inactive' : 'active',
            'plan' => $this->plan->name,
            'country_id' => $this->country->name,
            'token' => $this->token
        ];
    }
}
