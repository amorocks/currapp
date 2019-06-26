<?php

namespace App\Http\Controllers;

use App\Edition;
use Illuminate\Http\Request;

class EditionController extends Controller
{

    public function update(Edition $edition, Request $request)
    {
        $this->validate(request(), [
            'classes_per_week' => 'nullable|integer',
            'hours_per_class' => 'nullable|numeric',
            'review' => 'nullable'
        ]);

        $edition->classes_per_week = $request->classes_per_week;
        $edition->hours_per_class = $request->hours_per_class;
        $edition->review = $request->review;
        $edition->save();
        
        return redirect()->back();
    }
}
