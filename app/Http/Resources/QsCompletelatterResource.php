<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class QsCompletelatterResource extends JsonResource
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
            'title' => $this->title,
            'question' => $this->quess,
            'image' => Storage::url($this->image_one),
            'points' => $this->points,
            'answer' => $this->answer,
            'option_one' => $this->option_one,
            'option_two' => $this->option_two,
            'option_three' => $this->option_three,
        ];
    }
}
