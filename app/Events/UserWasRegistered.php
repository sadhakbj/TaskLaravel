<?php

namespace App\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

class UserWasRegistered extends Event
{
    use SerializesModels;


    /**
     * Create a new event instance.
     *
     * @param User $user
     */

}
