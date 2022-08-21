<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Children extends Model
{
    use HasFactory;

    public function father(){
        return $this->belongsTo(Father::class);
    }

    public function classe(){
        return $this->belongsTo(Classe::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function settings(){
        return $this->hasMany(Setting::class);
    }

    public function subscriptions(){
        return $this->belongsTo(Subscription::class);
    }

    public function history(){
        return $this->hasMany(History::class);
    }
    
    public function imageProfile() : Attribute {
        return Attribute::make(
            get : fn() => is_null($this->avater) ? asset('assets/images/avater.png') : Storage::url($this->avater)
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
