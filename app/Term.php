<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $guarded = [];

    public function cohort()
    {
    	return $this->belongsTo('App\Cohort');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'schedules')->using('App\Schedule')->withTimestamps();
    }

    public function getTitleAttribute()
	{
		return 'p' . str_pad($this->order, 2, '0', STR_PAD_LEFT);
	}

	public function getYearAttribute()
	{
		return ceil($this->order / $this->cohort->terms_per_year);
	}

	public function getOrderInYearAttribute()
	{
		return $this->order - ($this->cohort->qualification->terms_per_year * ($this->year-1));
	}
}
