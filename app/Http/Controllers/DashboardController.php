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
            /*

            Full example of calculations below:
        
                1 + (0 * 4) = 1
                2 + (0 * 4) = 2
                3 + (0 * 4) = 3
                4 + (0 * 4) = 4

                1 + (1 * 4) = 5
                2 + (1 * 4) = 6
                3 + (1 * 4) = 7
                4 + (1 * 4) = 8

                1 + (2 * 4) = 9
                2 + (2 * 4) = 10
                3 + (2 * 4) = 11
                4 + (2 * 4) = 12

            In other words:

                order_1-12 = order_1-4 + ((year-1) * 4)

            */

            $year = $periodisation->schoolyear - $cohort->start_year;
            if($year < 0) break;

            $order = $periodisation->term_order + $year*4;
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
