<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SemesterResource extends JsonResource
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
            'teacher' => [
                'id' => $this->teacher->id,
                'name' => $this->teacher->full_name
            ]
        ];;
    }
}
