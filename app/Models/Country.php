<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory;
    
    public function admins(){
        return $this->hasMany(Admin::class);
    }


    public function childrens(){
        return $this->hasMany(Children::class);
    }

    public function teachers(){
        return $this->hasMany(Teacher::class);
    }
    public function fathers(){
        return $this->hasMany(Father::class);
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
