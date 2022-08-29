<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class QsOrderLatter extends Model
{
    use HasFactory;

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function title() : Attribute {
        return Attribute::make(
            get: fn() => App::isLocale('ar') ? $this->title_ar : $this->title_en,
        ); 
    }

    public function quess() : Attribute {
        return Attribute::make(
            get: fn() => App::isLocale('ar') ? $this->quess_ar : $this->quess_en,
        ); 
    }


    public function answer() : Attribute {
        return Attribute::make(
            get: fn() => App::isLocale('ar') ? $this->answer_ar : $this->answer_en,
        ); 
    }

    

    public function body() : Attribute {
        return Attribute::make(
            get: fn() => App::isLocale('ar') ? $this->body_ar : $this->body_en,
        ); 
    }


}
