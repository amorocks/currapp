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

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function getIsSubscribedAttribute()
    {
    	return $this->whereHas('users', function ($query) {
		    $query->where('user_id', Auth::user()->id);
		    $query->where('qualification_id', $this->id);
		})->count();
    }
}
