<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

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

}
