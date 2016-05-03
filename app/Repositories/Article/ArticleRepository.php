<?php
namespace App\Repositories\Article;

use App\Article;
use App\User;

class ArticleRepository implements ArticleRepositoryInterface
{
    public $article;
    public $user;

    /**
     * ArticleRepository constructor.
     * @param Article $article
     * @param User    $user
     */
    public function __construct(Article $article, User $user)
    {
        $this->article = $article;
        $this->user    = $user;
    }

    /**
     * Get all the articles.
     */
    public function getPaginated()
    {
        return $this->article->orderBy('id', 'desc')->paginate(5);
    }

    /**
     * Creates New Article
     * @param array $input
     * @return Article
     */
    public function create(array $input)
    {
        return auth()->user()->articles()->create($input);
    }

    /**
     * Get the tag list for the given article.
     * @param Article $articleModel
     * @return
     */
    public function tagList(Article $articleModel)
    {
        return $this->article->tags->lists('id')->toArray();
    }

    /**
     * Update the article contents.
     * @param Article $article
     * @param array   $input
     * @return bool|int
     */
    public function update(Article $article, array $input)
    {
        return $article->update($input);
    }

    /**
     * Delete the article.
     * @param Article $article
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Article $article)
    {
        return $article->delete();
    }

    /**
     * Find the Article by Id.
     * @param int $id
     */
    public function find($id)
    {
        return $this->article->findOrFail($id);
    }
}
