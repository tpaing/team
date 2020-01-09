<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Plan extends Model
{
    public function scopeTeams(Builder $builder)
    {
    	return $builder->where('teams', true);
    }

    public function canDownGrade(Team $team)
    {
    	return $team->users->count() <= $this->teams_limit;
    }
}
