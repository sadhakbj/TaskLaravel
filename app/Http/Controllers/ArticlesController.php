<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;

/**
 * Class ArticlesController
 * @package App\Http\Controllers
 */
class ArticlesController extends Controller
{
    /**
     * @var ArticleService
     */
    public $article;
    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
     * ArticlesController constructor.
     * @param ArticleService  $article
     * @param LoggerInterface $logger
     */
    public function __construct(ArticleService $article, LoggerInterface $logger)
    {
        $this->middleware('auth');
        $this->article = $article;
        $this->logger  = $logger;
    }

    /**
     * Index page of the articles.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $articles = $this->article->getPaginated();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags    = $this->article->tags();
        $tagList = [];

        return view('articles.create', compact('tags', 'tagList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest|\Illuminate\Httpx\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $this->article->create($request->all());
        $this->logger->info(
            'Successfully created new article.',
            ['by' => auth()->user()->name, 'title' => $request->input('title')]
        );

        return redirect()->route('articles.index')->with('message', 'Successfully created a new article.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article  = $this->article->find($id);
        $comments = $this->article->comments($id);

        return view('articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags    = $this->article->tags();
        $article = $this->article->find($id);
        $tagList = $article->tags->lists('id')->toArray();
        $this->authorize('modify', $article);

        return view('articles.edit', compact('article', 'tags', 'tagList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest|Request $request
     * @param  int                   $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = $this->article->find($id);
        $this->authorize('modify', $article);
        $this->article->update($article, $request->all());
        $this->logger->info('Article has been updated.', ['by' => auth()->user()->name, 'article_id' => $id]);

        return redirect()->route('articles.show', $id)->with('message', 'Article has been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = $this->article->find($id);
        $this->authorize('modify', $article);
        $this->article->delete($article);
        $this->logger->info('Article deleted', ['by' => auth()->user()->name, 'article_id' => $id]);

        return redirect()->route('articles.index')->with('message', 'Article has been successfully deleted.');
    }
}
