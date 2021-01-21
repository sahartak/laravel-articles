<?php
namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Jobs\AddComment;
use App\Models\Article;
use Carbon\Carbon;

class ArticleService
{
    /**
     * Save article comment
     * @param CommentRequest $request
     * @return int
     */
    public function saveComment(CommentRequest $request)
    {
        dispatch((new AddComment($request->article_id, $request->subject, $request->body, Carbon::now()))->delay(10));
    }

    /**
     * add article view count
     * @param int $articleId
     * @return int
     */
    public function addViewCount(int $articleId): int
    {
        return $this->incrementArticleCounter('views', $articleId);
    }

    /**
     * returns article likes count
     * @param int $articleId
     * @return int
     */
    public function likeArticle(int $articleId): int
    {
        sleep(3); //sleep for testing
        return $this->incrementArticleCounter('likes', $articleId);
    }

    /**
     * add article count field value with +1
     * @param string $fieldName
     * @param int $articleId
     * @return int
     */
    public function incrementArticleCounter(string $fieldName, int $articleId): int
    {
       if($articleId){
           $article = $this->getById($articleId); // get fresh article from db, because article could be changed after unlock
            if (!$article){
                return 0;
            }
           $article->increment($fieldName);
           $article->save();
           return $article->$fieldName;
       }else{
           return 0;
       }
    }

    /**
     * returns article by id
     * @param int $id
     * @return Article|null
     */
    public function getById(int $id): ?Article
    {
        $article = Article::query()->find($id);
        /* @var Article $article*/
        return $article;
    }
}
