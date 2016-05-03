<?php
namespace App\Repositories\Comment;

use App\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;

    }

    /**
     * Check for the article in the model.
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->comment->findOrFail($id);
    }

    /**
     * Get all the comments for the given article.
     * @param int $articleId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCommentsByArticle($articleId)
    {
        return $this->comment->with('user')->where('article_id', $articleId)->get();
    }


    /**
     * Using the relation of user and comments create a new comment.
     * @param array $input
     */
    public function store(array $input)
    {
        return auth()->user()->comments()->create($input);
    }

    /**
     * write brief description
     * @param Comment $comment
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Comment $comment)
    {
        return $comment->delete();
    }

    /**
     * write brief description
     * @param Comment $comment
     * @param array   $input
     * @return bool|int
     */
    public function update(Comment $comment, array $input)
    {
        return $comment->update($input);
    }
}