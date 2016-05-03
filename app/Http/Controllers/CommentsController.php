<?php
namespace App\Http\Controllers;

use App\Comment;
use App\Events\UserCommentedOnPost;
use App\Http\Requests\CommentsRequest;
use App\Services\ArticleService;
use App\Services\CommentService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Psr\Log\LoggerInterface;

/**
 * Class CommentsController
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * @var CommentService
     */
    public $comment;
    /**
     * @var LoggerInterface
     */
    public $logger;
    /**
     * @var ArticleService
     */
    public $article;

    /**
     * CommentsController constructor.
     * @param CommentService  $comment
     * @param ArticleService  $article
     * @param LoggerInterface $logger
     */
    public function __construct(CommentService $comment, ArticleService $article, LoggerInterface $logger)
    {
        $this->comment = $comment;
        $this->article = $article;
        $this->logger  = $logger;
        $this->middleware('ajax', ['except' => 'store']);
    }

    /**
     * Creating a new comment.
     * @param CommentsRequest $request
     * @param             int $articleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentsRequest $request, $articleId)
    {
        $input               = $request->all();
        $input['article_id'] = $articleId;
        $this->comment->store($input);
        $this->logger->info(
            'Comment has been successfully posted',
            ['by' => auth()->user()->name, 'article_id' => $articleId,]
        );

        $users = $this->article->getUsersToNotify($articleId);

        event(new UserCommentedOnPost($users));

        return redirect()->back()->with('message', 'Comment has been successfully posted.');
    }

    /**
     * Delete the comment.
     * @param int $id
     * @return ResponseFactory|string|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        $comment = $this->comment->find($id);
        $this->authorize('modify', $comment);
        $this->comment->destroy($comment);
        $this->logger->info(
            'Comment has been successfully deleted.',
            ['by' => auth()->user()->name, 'comment_id' => $comment->id,]
        );

        return response("Successfully deleted");
    }

    /**
     * Update the comment.
     * @param CommentsRequest $request
     * @param Comment         $comment
     * @return ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(CommentsRequest $request, Comment $comment)
    {
        $comment = $this->comment->find($comment->id);
        $this->authorize('modify', $comment);
        $response = [
            'status'  => 'Success',
            'message' => 'Comment has been successfully updated.',
        ];

        $this->comment->update($comment, $request->all());
        $this->logger->info(
            'Comment has been successfully updated.',
            ['by' => auth()->user()->name, 'comment_id' => $comment->id,]
        );

        return response(json_encode($response));
    }
}
