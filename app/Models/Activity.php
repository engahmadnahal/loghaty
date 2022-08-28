<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Activity extends Model
{
    use HasFactory;

    public function children(){
        return $this->belongsTo(Children::class);
    }

    public function title() : Attribute {
        return Attribute::make(
            get : fn() => App::isLocale('ar') ? $this->title_ar : $this->title_en
        );
    }

    public function body() : Attribute {
        return Attribute::make(
            get : fn() => App::isLocale('ar') ? $this->body_ar : $this->body_en
        );
    }
}
