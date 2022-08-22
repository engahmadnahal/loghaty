<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class QsPlaying extends Model
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
}
