<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Course extends Model
{
	protected $guarded = [];

    public function topic()
    {
    	return $this->belongsTo('App\Topic');
    }

    public function terms()
    {
        return $this->belongsToMany('App\Term', 'schedules')->using('App\Schedule');
    }
}
