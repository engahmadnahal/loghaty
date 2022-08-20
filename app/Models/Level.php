<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Level extends Model
{
    use HasFactory;

    public function games(){
        return $this->hasMany(Game::class);
    }

    public function progress(){
        return $this->hasMany(Progress::class);
    }

    public function history(){
        return $this->hasMany(History::class);
    }
}
