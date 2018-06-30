<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Course extends Model
{
	protected $guarded = [];
	protected $appends = ['order'];

    public function topic()
    {
    	return $this->belongsTo('App\Topic');
    }

    public function getOrderAttribute()
    {
    	return (int)($this->owner == Auth::user()->id);
    }
}
