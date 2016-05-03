<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Checks if the user can edit / delete the particular article.
     * @param User    $user
     * @param Article $article
     * @return bool
     */
    public function modify(User $user, Article $article)
    {
        return $user->owns($article);
    }
}
