<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function level(){
        return $this->belongsTo(Level::class);
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
}
