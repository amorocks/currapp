<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Qualification;

class Cohort extends Model
{
    protected $guarded = [];

    public function qualification()
    {
    	return $this->belongsTo(Qualification::class);
    }

    public function getTitleAttribute($nospaces = false, $separator = '-')
    {
        $title = $this->start_year;
        $title .= $nospaces ? $separator : ' ' . $separator . ' ';
        $title .= $this->exam_year;

        return $title;
    }
}
