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
        $link      = route('articles.show', $articleId);
        $emails    = array_column($users, 'email');

        $content = sprintf(
            "There is new comment on the article you follow. Please check it here. <a href='%s'. Regards Task Laravel Team",
            $link
        );


        Mail::raw(
            $content,
            function ($m) use ($emails) {
                $m->from('admin@app.com', 'Task Laravel');

                $m->to($emails)->subject('New Comment.');
            }
        );

    }
}
