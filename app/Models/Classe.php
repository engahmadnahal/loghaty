<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function activites(){
        return $this->hasMany(Activity::class);
    }

    public function childrens(){
        return $this->hasMany(Children::class);
    }
    
}
