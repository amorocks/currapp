<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Course extends Model
{
	protected $guarded = [];

    public function type()
    {
    	return $this->belongsTo('App\Type');
    }

    public function terms()
    {
        return $this->belongsToMany('App\Term', 'schedules')->using('App\Schedule')->withTimestamps();
    }
}
