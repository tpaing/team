<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Subscription;

class TeamSubscription extends Subscription
{
    public function owner()
    {
    	return $this->belongsTo(Team::class, (new Team)->getForeignKey());
    }
}
