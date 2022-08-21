<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Father extends Authenticatable
{
    use HasFactory;

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function childrens(){
        return $this->hasMany(Children::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
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
}
