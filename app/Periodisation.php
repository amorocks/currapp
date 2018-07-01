<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodisation extends Model
{

	protected $guarded = [];
	protected $dates = ["start", "end"];

    public function getTitleAttribute()
    {
    	$year = substr($this->schoolyear, 2);
    	return $year. ($year+1) . " - p0" . $this->term_order;
    }

}
