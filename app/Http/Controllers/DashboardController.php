<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Periodisation;

class DashboardController extends Controller
{
    public function show()
    {
    	return view('dashboard.simple')
            ->with('user', Auth::user());
    }
}
