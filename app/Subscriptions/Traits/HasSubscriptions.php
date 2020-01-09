<?php

namespace App\Subscriptions\Traits;

trait HasSubscriptions
{
	public function hasSubscriptions()
   {	
   		return $this->subscribed('main');
   }

   public function isOnPlan($plan)
   {
   		return $this->subscribedToPlan($plan, 'main');
   }

   public function currentSubscription($plan)
   {
   		return $this->subscription('main');
   }
}