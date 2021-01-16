<?php
namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ArticleService
{
    /**
     * Save article comment
     * @param CommentRequest $request
     * @return int
     */
    public function saveComment(CommentRequest $request)
    {

        $postedAt = Carbon::now();
        sleep(10);
        try {
            $comment = new Comment();
            $comment->article_id = $request->article_id;
            $comment->subject = $request->subject;
            $comment->body = $request->body;
            $comment->posted_at = $postedAt;
            $comment->save();
        } catch (\Exception $e) {
            return 0;
        }
        return 1;
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
        sleep(5); //sleep for testing
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
        $article = null;
        while ($this->isArticleLocked($articleId)) { // waiting until article will be unlocked
            usleep(50);
        }
        $this->lockArticle($articleId, $fieldName);
        $article = $this->getById($articleId); // get fresh article from db, because article could be changed after unlock

        $article->{$fieldName}++;
        $article->save();
        $this->unlockArticle($articleId, $fieldName);
        return $article->$fieldName;
    }


    /**
     * check if article is locked
     * @param int $articleId
     * @return bool
     */
    private function isArticleLocked(int $articleId): bool
    {
        $lock_key = $this->getLockKey($articleId);
        return Cache::has($lock_key);
    }

    /**
     * lock article
     * @param int $articleId
     * @param string $key
     */
    private function lockArticle(int $articleId, string $key)
    {
        $lock_key = $this->getLockKey($articleId, $key);
        Cache::put($lock_key, true, 20);
    }

    /**
     * unlock article
     * @param int $articleId
     * @param string $key
     */
    private function unlockArticle(int $articleId, string $key)
    {
        $lock_key = $this->getLockKey($articleId, $key);
        Cache::forget($lock_key);
    }

    /**
     * returns lock key
     * @param int $articleId
     * @param string $key
     * @return string
     */
    private function getLockKey(int $articleId, string $key = 'like'): string
    {
        return 'article_lock_'.$key.$articleId;
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
