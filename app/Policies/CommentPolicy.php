<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Check if the user can edit / delete the comment.
     * @param User    $user
     * @param Comment $comment
     * @return bool
     */
    public function modify(User $user, Comment $comment)
    {
        return $user->owns($comment);
    }
}
