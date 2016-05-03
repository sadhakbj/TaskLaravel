<?php
namespace App\Services;

use App\Article;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Tag;
use App\User;

class ArticleService
{
    public $articleRepository;
    public $commentRepository;
    public $tag;
    public $user;

    /**
     * ArticleService constructor.
     * @param ArticleRepositoryInterface $articleRepository
     * @param Tag                        $tag
     * @param User                       $user
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        Tag $tag,
        User $user,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->commentRepository = $commentRepository;
        $this->tag               = $tag;
        $this->user              = $user;
    }

    /**
     * Returns the paginated articles.
     */
    public function getPaginated()
    {
        return $this->articleRepository->getPaginated();
    }

    /**
     * Create new article.
     * @param array $input
     * @return static
     */
    public function create(array $input)
    {
        $article = $this->articleRepository->create($input);

        return $this->syncTags($article, $input);

    }

    /**
     * Syncs the tags for given article and array of tags provided.
     * @param Article $article
     * @param array   $input
     * @return array
     */
    private function syncTags(Article $article, array $input)
    {
        if (empty($input['tags'])) {
            $article->tags()->detach();

            return true;
        }

        $tags      = $input['tags'];
        $allTagIds = [];

        foreach ($tags as $tagId) {
            if (substr($tagId, 0, 4) == 'new:') {
                $newTag      = $this->tag->create(['name' => substr($tagId, 4)]);
                $allTagIds[] = $newTag->id;
                continue;
            }

            $allTagIds[] = $tagId;
        }

        return $article->tags()->sync($allTagIds);
    }

    /**
     * Return all the tags from tag model.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function tags()
    {
        return $this->tag->lists('name', 'id');
    }

    /**
     * Get the comments for the particular article id.
     * @param $articleId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function comments($articleId)
    {
        return $this->commentRepository->getCommentsByArticle($articleId);
    }

    /**
     * Update the given article.
     * @param Article $article
     * @param array   $input
     * @return array|void
     */
    public function update(Article $article, array $input)
    {
        $update = $this->articleRepository->update($article, $input);

        $this->syncTags($article, $input);

        return $update;
    }

    /**
     * Delete the article.
     * @param Article $article
     * @return bool|null
     */
    public function delete(Article $article)
    {
        return $this->articleRepository->delete($article);
    }

    /**
     * Get the list the of the users who needs to be notified on having comment on the post including owner.
     * @param int $articleId
     * @return array
     */
    public function getUsersToNotify($articleId)
    {
        $users        = [];
        $usersInfo    = [];
        $usersList    = [];
        $article      = $this->find($articleId);
        $usersList[]  = $article->user_id;
        $commentators = array_unique($article->comments()->lists('user_id')->all());
        $usersList    = array_unique(array_merge($usersList, $commentators));

        $currentUserIndex = array_search(auth()->user()->id, $usersList);
        unset($usersList[$currentUserIndex]);

        foreach ($usersList as $key => $userId) {
            $user                 = $this->user->find($userId);
            $users[$key]['name']  = $user->name;
            $users[$key]['email'] = $user->email;
        }

        $usersInfo['article_id'] = $articleId;
        $usersInfo['users']      = $users;

        return $usersInfo;
    }

    /**
     * Get the particular article with ID.
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->articleRepository->find($id);
    }
}
