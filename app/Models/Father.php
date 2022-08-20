<?php

namespace App\Models;

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
}
