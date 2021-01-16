<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTagSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles_tags')->truncate();

        $articles = Article::all();
        $tags = Tag::all()->toArray();
        foreach ($articles as $article) {
            $tagsToAttach = array_unique(array_rand($tags, 3));
            $article->tags()->sync($tagsToAttach);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
