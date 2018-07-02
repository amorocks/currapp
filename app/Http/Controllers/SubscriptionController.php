<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cohort;

class SubscriptionController extends Controller
{
    public function toggle(Request $request, Cohort $cohort)
    {
    	$user = $request->user();
    	$status = $user->cohorts()->toggle($cohort);
    	return count($status['attached']);
    }
}
