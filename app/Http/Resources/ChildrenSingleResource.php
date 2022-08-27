<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ChildrenSingleResource extends JsonResource
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
            'name' => $this->name,
            'avater' => !is_null($this->avater) ? Storage::url($this->avater) : asset('assets/images/avater.png'),
            'dob' => $this->date_of_birth,
            'father' => [
                'id' =>$this->father->id,
                'email' => $this->father->email
            ],
            'country' => [
                'id' => $this->country->id,
                'name' => $this->country->name
            ],
        ];
    }
}
