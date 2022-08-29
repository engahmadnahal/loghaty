<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class GameSingleResource extends JsonResource
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
            'image' => Storage::url($this->image),
            'qs_complete_latter' => $this->qsCompleteLatter->map(function($qs){
                return [
                    'id' => $qs->id,
                    'title' => $qs->title,
                    'question' => $qs->quess,
                    'image' => Storage::url($qs->image_one),
                    'points' => $qs->points,
                    'answer' => $qs->answer,
                    'option_one' => $qs->option_one,
                    'option_two' => $qs->option_two,
                    'option_three' => $qs->option_three,
                ];
            }),

            'qs_latter_bettween_words' => $this->qsLatterBettweenWord->map(function($qs){
                return [
                    'id' => $qs->id,
                    'title' => $qs->title,
                    'question' => $qs->quess,
                    'image_one' => Storage::url($qs->image_one),
                    'image_two' => Storage::url($qs->image_two),
                    'image_three' => Storage::url($qs->image_three),
                    'points' => $qs->points,
                    'answer' => $qs->answer,
                    'option_one' => $qs->option_one,
                    'option_two' => $qs->option_two,
                    'option_three' => $qs->option_three,
                ];
            }),

            'qs_order_latters' => $this->qsOrderLatter->map(function($qs){
                return [
                    'id' => $qs->id,
                    'title' => $qs->title,
                    'body' => $qs->body,
                    'question' => $qs->quess,
                    'answer' => $qs->answer,
                    'image' => Storage::url($qs->image),
                    'points' => $qs->points,
                ];
            }),

            'qs_playings' => $this->qsPlaying->map(function($qs){
                return [
                    'id' => $qs->id,
                    'title' => $qs->title,
                    'question' => $qs->quess,
                    'points' => $qs->points,
                    'answer' => $qs->answer,
                    'option_one' => $qs->option_one,
                    'option_two' => $qs->option_two,
                    'option_three' => $qs->option_three,
                    'option_foure' => $qs->option_foure,
                ];
            }),
        ];
    }
}
