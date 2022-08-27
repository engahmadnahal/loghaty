<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgressResource extends JsonResource
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
            'children' => $this->children->name,
            'level' => $this->level->name,
            'level_points' => $this->level->points,
            'children_points' => $this->totalpoints,
        ];
    }

    public function totalPoints($points){

    }
}
