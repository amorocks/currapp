<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function show()
    {
    	return view('dashboard')
    		->with('user', Auth::user());
    }
}
