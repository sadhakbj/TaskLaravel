<?php
namespace App\Repositories\Comment;

use App\Comment;

interface CommentRepositoryInterface
{
    public function find($id);

    public function getCommentsByArticle($articleId);

    public function store(array $input);

    public function update(Comment $comment, array $input);

    public function delete(Comment $comment);
}