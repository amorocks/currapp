<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Periodisation;

class DashboardController extends Controller
{
    public function show()
    {
    	$today = date('Y-m-d');
    	$periodisation = Periodisation::whereDate('start', '<=', $today)->whereDate('end', '>=', $today)->first();

    	if($periodisation == null)
    	{
            return view('dashboard.simple')
    			->with('user', Auth::user());
    	}

    	$cohorts = Auth::user()->cohorts()->orderBy('qualification_id')->get();

        $now = array();
        foreach ($cohorts as $cohort)
        {
            //Example: it is now 17-18, looking at cohort 2015 - 2018, the sum will be:
            //      2017                       - 2015                + 1 = 3
            $year = $periodisation->schoolyear - $cohort->start_year + 1;
            if($year < 1) break;

            $order = $periodisation->term_order * $year;
            $term = $cohort->terms()->where('order', $order)->first();
            if($term != null) $now[] = $term;
        }

        if(empty($now))
        {
            return view('dashboard.simple')
                ->with('user', Auth::user());
        }

        return view('dashboard.extended')
            ->with('user', Auth::user())
            ->with('terms', $now);
    }
}
