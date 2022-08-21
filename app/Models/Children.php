<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

    public function father(){
        return $this->belongsTo(Father::class);
    }

    public function class(){
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
}
