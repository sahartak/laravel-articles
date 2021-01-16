<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Returns latest created articles
     * @param int $limit
     * @return mixed
     */
    public static function getLatestArticles(int $limit = 6)
    {
        return self::latest('created_at')->limit($limit)->get();
    }

    /**
     * get article tags
     * @return mixed
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'articles_tags', 'article_id', 'tag_id');
    }

    /**
     * get article tag names
     * @return mixed
     */
    public function tagNames()
    {
        return $this->tags()->pluck('name')->toArray();
    }

    /**
     * Return the article's comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Returns comments count
     */
    public function commentsCount()
    {
        return $this->comments()->count();
    }
}
