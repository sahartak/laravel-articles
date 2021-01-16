<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleIdRequest;
use App\Http\Requests\CommentRequest;
use App\Services\ArticleService;

class ApiController extends Controller
{
    /**
     * Add Comment
     * @param CommentRequest $request
     * @param ArticleService $articleService
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComment(CommentRequest $request, ArticleService $articleService)
    {
        $success = $articleService->saveComment($request);
        return response()->json([
            'success' => $success,
        ]);
    }

    public function addViewCount(ArticleIdRequest $request, ArticleService $articleService)
    {
        $viewsCount = $articleService->addViewCount($request->article_id);
        return response()->json([
            'views' => $viewsCount,
        ]);
    }

    public function likeArticle(ArticleIdRequest $request, ArticleService $articleService)
    {
        $likesCount = $articleService->likeArticle($request->article_id);
        return response()->json([
            'likes' => $likesCount,
        ]);
    }

}
