<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = [];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function __toString()
    {
    	return $this->title;
    }
}
