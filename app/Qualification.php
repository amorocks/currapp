<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class Qualification extends Model
{

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getIsSubscribedAttribute()
    {
    	return $this->whereHas('users', function ($query) {
		    $query->where('user_id', Auth::user()->id);
		    $query->where('qualification_id', $this->id);
		})->count();
    }
}
