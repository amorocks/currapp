<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;

class ReportsController extends Controller
{
    public function ownership()
    {

    	//The list needs to be sorted by term, then by owner. This can be done only with text sort, wich places '10' after '1', and then '2' and '20' and so on. This is prevented by replacing the term-number with a letter.

    	$termToLetter = array(
    		1 => 'a',
    		2 => 'b',
    		3 => 'c',
    		4 => 'd',
    		5 => 'e',
    		6 => 'f',
    		7 => 'g',
    		8 => 'h',
    		9 => 'i',
    		10 => 'j',
    		11 => 'k',
    		12 => 'l',
    		13 => 'm',
    		14 => 'n',
    		15 => 'o',
    		16 => 'p',
    		17 => 'q',
    		18 => 'r',
    		19 => 's',
    		20 => 't'
    	);

        $courses = Course::all()->sortBy('owner')->sortBy(function($item) use($termToLetter){
        	if(count($item->terms)){
        		return
        			$termToLetter[$item->terms->pluck('order')->min()]
        			. '-' .
        			$item->owner;
        	} 
        	return 99999;
        });

        $grouped = $courses->groupBy('owner')->sortKeys();

        return view('reports.ownership')
        	->with(compact('courses'))
        	->with(compact('grouped'));
    }
}
