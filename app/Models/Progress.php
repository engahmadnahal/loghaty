<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Progress extends Model
{
    use HasFactory,SoftDeletes;

    
    public function level(){
        return $this->belongsTo(Level::class);
    }
}
