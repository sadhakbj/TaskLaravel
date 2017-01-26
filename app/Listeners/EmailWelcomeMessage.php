<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use Illuminate\Support\Facades\Mail;

class EmailWelcomeMessage
{
    /**
     * Handle the event.
     *
     * @param  UserWasRegistered $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        $user    = auth()->user();

        Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });

    }
}
