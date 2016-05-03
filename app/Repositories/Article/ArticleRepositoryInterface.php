<?php
namespace App\Repositories\Article;

use App\Article;

interface  ArticleRepositoryInterface
{

    public function getPaginated();

    public function find($id);

    public function create(array $input);

    public function update(Article $article, array $input);

    public function delete(Article $article);

    public function tagList(Article $article);

}
