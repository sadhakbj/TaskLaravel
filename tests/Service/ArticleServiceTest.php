<?php
namespace App\Tests\Service;

use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Services\ArticleService;
use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use \Mockery as m;
use TestCase;

/**
 * Class ArticleServiceTest
 * @package App\Tests\Service
 */
class ArticleServiceTest extends TestCase
{
    /**
     * @var
     */
    protected $articleRepository;
    /**
     * @var
     */
    protected $commentRepository;
    /**
     * @var
     */
    protected $tag;
    /**
     * @var
     */
    protected $user;
    /**
     * @var
     */
    protected $articleService;

    public function setUp()
    {
        parent::setUp();
        $this->articleRepository = m::mock(ArticleRepositoryInterface::class);
        $this->commentRepository = m::mock(CommentRepositoryInterface::class);
        $this->tag               = m::mock(Tag::class);
        $this->user              = m::mock(User::class);
        $this->articleService    = new ArticleService(
            $this->articleRepository,
            $this->tag,
            $this->user,
            $this->commentRepository
        );

    }

    public function testItShouldReturnPaginatedArticles()
    {
        $collection = m::mock(Collection::class);
        $this->articleRepository->shouldReceive('getPaginated')->once()->andReturnSelf()->andReturn($collection);
        $this->assertInstanceOf(Collection::class, $this->articleService->getPaginated());
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}