<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;


class Edition extends Pivot
{
    protected $table = 'editions';
    public $incrementing = true;
    public $timestamps = false;
}
