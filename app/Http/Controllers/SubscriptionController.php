<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Qualification;

class SubscriptionController extends Controller
{
    public function toggle(Request $request, Qualification $qualification)
    {
    	$user = $request->user();
    	$status = $user->qualifications()->toggle($qualification);
    	return count($status['attached']);
    }
}
