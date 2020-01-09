<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams\Roles;
use App\Team;

class TeamController extends Controller
{
    /**
        * [__construct description]
        * @param Request $request [description]
        */
    public function __construct(Request $request)
    {
        //$this->middleware(['in_team:' . $request->team]);
        
        $this->middleware(['permission:delete team,' . $request->team])
            ->only(['delete', 'destroy']);

        //$this->middleware(['permission:view team dashboard,'. $request->team])
        //    ->only(['show']);
    }

    public function index(Request $request)
    {
        $teams = $request->user()->teams;
    	return view('teams.index', compact('teams'));
    }

    public function show(Team $team)
    {
    	return view('teams.show', compact('team'));
    }

    public function store(Request $request)
    {
    	$request->validate([
            'name' => 'required'
        ]);

        $user = $request->user();
        $team = $user->teams()->create($request->only('name'));
        $user->attachRole(Roles::$roleWhenCreatingTeam, $team->id);
        
        return redirect()->route('teams.index');
    }
    /**
     * [delete description]
     * @param  Team   $team [description]
     * @return [type]       [description]
     */
    public function delete(Team $team)
    {
        return view('teams.delete', compact('team'));
    }

    /**
     * [destroy description]
     * @param  Team   $team [description]
     * @return [type]       [description]
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index');
    }
}
