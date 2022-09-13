<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionRequest extends Model
{
    use HasFactory;


    public function planTeacher(){
        return $this->belongsTo(PlanTeacher::class);
    }

    public function father(){
        return $this->belongsTo(Father::class);
    }
    public function state() : Attribute {
        return Attribute::make(
            get : function(){
                if($this->status == "accept"){
                     return __('dash.accept');
                }elseif($this->status == 'wating'){
                    return __('dash.wating');
                }
                return  __('dash.cancel');
            }
        );
    }


    public function fullName() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->fname . ' ' . $this->lname
        );
    }
}
