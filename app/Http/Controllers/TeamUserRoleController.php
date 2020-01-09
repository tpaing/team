<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\Teams\Roles;

class TeamUserRoleController extends Controller
{
    public function edit(Team $team, User $user)
    {
    	$roles = Roles::$roles;
    	return view('teams.roles.edit', compact('team', 'user', 'roles'));
    }

    public function update(Request $request, Team $team, User $user)
    {
    	$this->validate($request, [
    		'role' => 'required|exists:roles,name',
    	]);

    	if(!$team->users->contains($user)) {
    		return back();
    	}

    	if($user->isOnlyAdminInTeam($team)) {
    		return back();
    	}

    	$user->syncRoles([$request->role], $team->id);

    	return redirect()->route('teams.users.index', $team);
    }
}
