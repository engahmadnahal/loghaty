<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'start_subscrip_date',
        'end_subscrip_date',
        'children_id',
        'plan_id',
        'father_id',
        'expire',
    ];


    public function children(){
        return $this->belongsTo(Children::class);
    }
    public function father(){
        return $this->belongsTo(Father::class);
    }

    public function stateSubs() : Attribute {
        return Attribute::make(
            get : fn() => !is_null($this->expire) ? __('dash.expire') : __('dash.no_expire')
        );
    }

    public function start() : Attribute {
        return Attribute::make(
            get : fn() => !is_null($this->start_subscrip_date)? Carbon::parse($this->start_subscrip_date)->format('Y-m-d') : "---"
        );
    }

    public function end() : Attribute {
        return Attribute::make(
            get : fn() => !is_null($this->end_subscrip_date)? Carbon::parse($this->end_subscrip_date)->format('Y-m-d') : "---"
        );
    }
}
