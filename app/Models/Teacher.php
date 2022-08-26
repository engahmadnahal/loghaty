<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasFactory,SoftDeletes,Notifiable,HasApiTokens;

    public function classes(){
        return $this->hasMany(Classe::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function imageProfile() : Attribute {
        return Attribute::make(
            get : fn() => is_null($this->avater) ? asset('assets/images/avater.png') : Storage::url($this->avater)
        );
    }

    public function emailStatus() : Attribute {
        return Attribute::make(
            get : fn() => !is_null($this->email_verified_at) ? __('dash.isactive') : __('dash.inactive')
        );
    }

    public function statusUser() : Attribute {
        return Attribute::make(
            get : fn() => $this->status == "active" ? __('dash.available') : __('dash.block')
        );
    }

    public function lastLogin() : Attribute {
        return Attribute::make(
            get : fn() => !is_null($this->last_vist)? Carbon::parse($this->last_vist)->diffForHumans() : "---"
        );
    }

    public function fullName() : Attribute {
        return Attribute::make(
            get : fn() => $this->fname ." " . $this->lname
        );
    }
}
