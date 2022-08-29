<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class LevelSingleResource extends JsonResource
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
            'points' => $this->points,
            'orderd' => $this->orderd,
            'games' => $this->games->where('active',true)->map(function($g){
                return [
                    'id' => $g->id,
                    'name' => $g->name,
                    'image' => Storage::url($g->image),
                ];
            }),
        ];
    }
}
