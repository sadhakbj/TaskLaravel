<?php

namespace App\Listeners;

use App\Events\UserCommentedOnPost;
use App\User;
use Illuminate\Support\Facades\Mail;

class NotifyUsers
{
    public $user;

    /**
     * Create the event listener.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  UserCommentedOnPost $event
     * @return void
     */
    public function handle(UserCommentedOnPost $event)
    {
        $articleId = $event->information['article_id'];
        $users     = $event->information['users'];
        $emails    = array_column($users, 'email');

        Mail::send('emails.postComment', ['articleId' => $articleId], function ($m) use ($emails) {
            $m->from('hello@taskLaravel.com', 'Task Laravel');

            $m->to($emails)->subject('New comment on a article you are following.!');
        });


    }
}
