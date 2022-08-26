<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory;

    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function game(){
        return $this->belongsTo(Game::class);
    }
    

    public function children(){
        return $this->belongsTo(Children::class);
    }
}
