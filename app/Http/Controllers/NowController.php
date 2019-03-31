<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qualification;

class NowController extends Controller
{
    public function index()
    {
    	return view('now.qualifications')
            ->with('qualifications', Qualification::all());
    }

    public function show(Qualification $qualification)
    {
        $schoolyear = (date('m') > 6) ? date('Y') : date('Y')-1;
        return $this->show_year($qualification, $schoolyear);
    }

    public function show_year(Qualification $qualification, $schoolyear)
    {
        $cohorts =  $qualification->cohorts()
            ->where('start_year', '<=', $schoolyear)
            ->where('exam_year', '>', $schoolyear)
            ->orderBy('start_year', 'desc')
            ->get();
         
        return view('now.show')
            ->with(compact('qualification'))
            ->with(compact('schoolyear'))
            ->with(compact('cohorts'));
    }

    public function show_hours(Qualification $qualification, $schoolyear)
    {
        $cohorts =  $qualification->cohorts()
            ->where('start_year', '<=', $schoolyear)
            ->where('exam_year', '>', $schoolyear)
            ->orderBy('start_year', 'desc')
            ->get();
         
        return view('now.hours')
            ->with(compact('qualification'))
            ->with(compact('schoolyear'))
            ->with(compact('cohorts'));
    }
}
