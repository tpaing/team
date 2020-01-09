<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\Plan;

class TeamSubscriptionController extends Controller
{
    public function index(Team $team)
    {	
    	$plans = Plan::teams()->get();
    	return view('teams.subscriptions.index', compact('team', 'plans'));
    }

    public function store(Request $request, Team $team)
    {
    	$this->validate($request, [
    		'token' => 'required',
    		'plan' => 'required|exists:plans,id', //table, column
    	]);

    	
    	$plan = Plan::find($request->plan);

    	$team->newSubscription('main', $plan->provider_id)
    		->create($request->token);

    	return back();
    }
}
