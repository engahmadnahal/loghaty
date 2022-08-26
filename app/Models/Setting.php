<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory,SoftDeletes;
   
    protected $fillable = [
        'father_id',
        'lang_text',
        'lang_voice',
        'is_music'
    ];

    public function father(){
        return $this->belongsTo(Father::class);
    }

}
