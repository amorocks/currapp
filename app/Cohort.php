<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Cohort extends Model
{
    protected $guarded = [];

    public function qualification()
    {
    	return $this->belongsTo('App\Qualification');
    }

    public function terms()
    {
        return $this->hasMany('App\Term');
    }

    public function topics()
    {
        return $this->belongsToMany('App\Topic');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function getTitleAttribute($nospaces = false, $separator = '-')
    {
        $title = $this->start_year;
        $title .= $nospaces ? $separator : ' ' . $separator . ' ';
        $title .= $this->exam_year;

        return $title;
    }

    public function getIsSubscribedAttribute()
    {
        return $this->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
            $query->where('cohort_id', $this->id);
        })->count();
    }
}
