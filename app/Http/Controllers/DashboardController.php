<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Course;
use App\Edition;

class DashboardController extends Controller
{
    public function show()
    {
    	$my_courses = Course::mine();
    	$courses_empty = Course::mine()->where('description', null);
    	$editions_empty = Edition::whereRaw("(review IS NULL OR classes_per_week IS NULL OR hours_per_class IS NULL) AND course_id IN (SELECT id FROM courses WHERE owner = ?)", Auth::user()->id)->get();

    	return view('dashboard.columns')
            ->with('user', Auth::user())
            ->with(compact('my_courses'))
            ->with(compact('courses_empty'))
            ->with(compact('editions_empty'));
    }
}
