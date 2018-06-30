<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function getTitleAttribute($nospaces = false, $separator = '-')
    {
        $title = $this->start_year;
        $title .= $nospaces ? $separator : ' ' . $separator . ' ';
        $title .= $this->exam_year;

        return $title;
    }
}
