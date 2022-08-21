<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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

    public function name() : Attribute {
        return Attribute::make(
            get: fn() => App::isLocale('ar') ? $this->name_ar : $this->name_en,
        ); 
    }


}
