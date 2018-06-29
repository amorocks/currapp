<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Cohort;
use Auth;

class Qualification extends Model
{

    protected $guarded = [];

    public function cohorts()
    {
        return $this->hasMany(Cohort::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getIsSubscribedAttribute()
    {
    	return $this->whereHas('users', function ($query) {
		    $query->where('user_id', Auth::user()->id);
		    $query->where('qualification_id', $this->id);
		})->count();
    }
}
