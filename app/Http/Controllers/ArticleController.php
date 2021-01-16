<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::getLatestArticles();

        return view('articles.index', compact('articles'));
    }


    public function list()
    {
        $articles = Article::latest('created_at')->paginate(10);

        return view('articles.list', compact('articles'));
    }

    public function articlePage($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        return view('articles.page', compact('article'));
    }
}
