<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

	protected $guarded = [];

    public function type()
    {
    	return $this->belongsTo('App\TagType', 'tag_type_id');
    }

    public function courses()
    {
    	return $this->belongsToMany('App\Course');
    }
}
