<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;

    protected $hidden = ['password', 'remember_token'];

    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0];
    }
}
