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
        return $this->hasMany('App\Term')->orderBy('order');
    }

    public function getCoursesAttribute()
    {
        $result = \DB::select(\DB::raw("SELECT courses.* FROM terms INNER JOIN editions ON terms.id = editions.term_id INNER JOIN courses ON courses.id = editions.course_id WHERE terms.cohort_id=:term GROUP BY courses.id"), [
            "term" => $this->id
        ]);
        return \App\Course::hydrate($result);
    }

    public function getTitleAttribute($nospaces = false, $separator = '-')
    {
        $title = $this->start_year;
        $title .= $nospaces ? $separator : ' ' . $separator . ' ';
        $title .= $this->exam_year;

        return $title;
    }

    public function getShortTitleAttribute()
    {
        return 'C' . substr($this->start_year, 2, 2);
    }
}
