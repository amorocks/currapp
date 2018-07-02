<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Qualification extends Model
{

    protected $guarded = [];

    public function cohorts()
    {
        return $this->hasMany('App\Cohort');
    }

    public function getIsSubscribedAttribute()
    {
        return $this->cohorts->filter(function ($value, $key){
        	return $value->is_subscribed;
        })->count();
    }
}
