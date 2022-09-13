<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class PlanTeacher extends Model
{
    use HasFactory;

    public function promotions(){
        return $this->hasMany(PromotionRequest::class);
    }

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
    public function name() : Attribute {
        return Attribute::make(
            get: fn() => App::isLocale('ar') ? $this->name_ar : $this->name_en,
        ); 
    }

    public function state() : Attribute {
        return Attribute::make(
            get:fn() => boolval($this->active)? __('dash.available') : __('dash.block'),
        ); 
    }
}
