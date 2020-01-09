<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Plan;

class TeamSubSwapRoleController extends Controller
{
    public function store(Request $request, Team $team)
    {
    	$this->validate($request, [
    		'plan' => 'required|exists:plans,id'
    	]);
    	$plan = Plan::find($request->plan);

    	if(!$team->canDownGrade($plan)) {
    		return back();
    	}

    	$team->currentSubscription($team)->swap(
    		$plan->provider_id
    	);

    	return back();	
    }
}
