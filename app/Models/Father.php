<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Father extends Authenticatable
{
    use HasFactory,HasRoles,Notifiable,HasApiTokens,SoftDeletes;


    protected $fillabel = [
        'email',
        'password',
        'plan_id',
        'country_id',
        'status',
    ];

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function childrens(){
        return $this->hasMany(Children::class);
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
        
    }

    public function country(){
        return $this->belongsTo(Country::class);
        
    }

    public function setting(){
        return $this->hasOne(Setting::class);
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



    public function findForPassport($username){
        return $this->where('email',$username)->first();
    }
}
