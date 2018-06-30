<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];

    public function cohorts()
    {
    	return $this->belongsToMany('App\Cohort');
    }
}
