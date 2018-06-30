<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;


class Schedule extends Pivot
{
    protected $table = 'schedules';
}
