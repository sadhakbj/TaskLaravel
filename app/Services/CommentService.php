<?php
namespace App\Services;

use App\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentService
{
    public $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;

    }

    /**
     * Find the comment with particular id.
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->commentRepository->find($id);
    }

    /**
     * Create new comment.
     * @param array $input
     */
    public function store(array $input)
    {
        return $this->commentRepository->store($input);
    }

    /**
     * Delete the comment.
     * @param Comment $comment
     * @return mixed
     */
    public function destroy(Comment $comment)
    {
        return $this->commentRepository->delete($comment);
    }

    /**
     * Updates the comment.
     * @param Comment $comment
     * @param         $input
     * @return mixed
     */
    public function update(Comment $comment, $input)
    {
        return $this->commentRepository->update($comment, $input);
    }
}
