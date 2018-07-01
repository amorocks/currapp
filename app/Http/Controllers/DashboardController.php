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
    	$schoolyear = $periodisation->schoolyear;
    	$term_order = $periodisation->term_order;
    	$qualifications = Auth::user()->qualifications;

    	$now = array();
    	foreach($qualifications as $q)
    	{
    		//Voor ieder jaar dat de kwalificatie duurt...
    		for($i = 0; $i < $q->duration; $i++)
    		{
    			//...haal het cohort op wat bij het huidige jaar 1, 2 of 3 hoort
    			$cohort = $q->cohorts()->where('start_year', $schoolyear-$i)->first();

    			if($cohort != null)
    			{
	    			//zoek de periode die nu loopt in jaar 1, 2 of 3
	    			$term = $cohort->terms()->where('order', ($term_order*($i+1)))->first();
	    			if($term != null)
	    			{
	    				$now[$q->id][] = $term;
	    			}
	    		}
    		}
    	}

    	return view('dashboard')
    		->with('user', Auth::user())
    		->with('terms', $now);
    }
}
