<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanTeacherResource extends JsonResource
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
            'total_month' => $this->sum_month,
            'price_usd' => $this->price_usd,
            'price_aed' => $this->price_aed,
            'total_class' => $this->max_class,
            'total_children' => $this->max_children,
        ];
    }
}
