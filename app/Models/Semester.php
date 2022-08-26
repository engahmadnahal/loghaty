<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Semester extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name_en' ,
        'name_ar',
     'teacher_id',
         'status'
    ];
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function activites(){
        return $this->hasMany(Activity::class);
    }

    public function childrens(){
        return $this->hasMany(Children::class);
    }

    public function name() : Attribute {
        return Attribute::make(
            get: fn() => App::isLocale('ar') ? $this->name_ar : $this->name_en,
        ); 
    }


    public function state() : Attribute {
        return Attribute::make(
            get:fn() => $this->status = 'active' ? __('dash.available') : __('dash.block'),
        ); 
    }
}
