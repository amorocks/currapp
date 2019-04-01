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
        return $this->belongsToMany('App\Term', 'editions')->using('App\Edition')->withPivot('id', 'classes_per_week', 'hours_per_class', 'review');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public static function allWithMineOnTop()
    {
    	return self::all()->sortByDesc(function($course, $key){
            return (int)($course->owner == Auth::user()->id);
        })->values();
    }

    public static function mine()
    {
        return self::where('owner', Auth::user()->id)->get();
    }
}
