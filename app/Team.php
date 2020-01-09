<?php

namespace App;

use Laratrust\Models\LaratrustTeam;
use Auth;
use Laravel\Cashier\Billable;
use App\TeamSubscription;
use App\User;
use App\Subscriptions\Traits\HasSubscriptions;

class Team extends LaratrustTeam
{
	use Billable, HasSubscriptions;

   protected $fillable = [
   		'name'
   ];

  	public function canDownGrade(Plan $plan)
    {
    	return $this->users->count() <= $plan->teams_limit;
    }

   public function path()
   {
  		return route('teams.show', $this);
   }



   public function OwnBy(User $user)
   {
   		return $this->users->find($user)->hasRole('team_admin', $this->id);
   }

   public function OwnByCurrentUser()
   {
   		return $this->OwnBy(Auth::user());
   }
   public function users()
   {
   		return $this->belongsToMany(User::class)
   			->withTimestamps();
   }

   public function subscriptions()
   {
   		return $this->hasMany(TeamSubscription::class, $this->getForeignKey())
   			->orderBy('created_at', 'desc'); 
   }

   public function plans()
   {
   		return $this->hasManyThrough(Plan::class, TeamSubscription::class, 'team_id', 'provider_id', 'id', 'stripe_plan')
   		->orderBy('team_subscriptions.created_at', 'desc');
   }

   public function getPlanAttribute	() //plan
   {
   		return $this->plans->first();
   }

   public function hasReachedLimit()
   {
   		if(!$this->hasSubscriptions()) {
   			return true;
   		}

   		return $this->users->count() >= $this->plan->teams_limit;
   }
}
