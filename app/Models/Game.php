<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory;

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }



    public function history(){
        return $this->hasMany(History::class);
    }

    public function qsCompleteLatter(){
        return $this->hasMany(QsCompleteLatter::class);
    }

    public function qsLatterBettweenWord(){
        return $this->hasMany(QsLatterBettweenWord::class);
    }

    public function qsOrderLatter(){
        return $this->hasMany(QsOrderLatter::class);
    }

    public function qsPlaying(){
        return $this->hasMany(QsPlaying::class);
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
