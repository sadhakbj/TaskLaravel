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
        $content = sprintf(
            'Welcome %s ! , you have successfully registered to our application. Please keep on checking the email for the latest updates',
            $user->name
        );

        Mail::raw(
            $content,
            function ($m) use ($user) {
                $m->from('admin@app.com', 'Task Laravel');

                $m->to($user->email)->subject('Welcome to TaskLaravel.');
            }
        );
    }
}
