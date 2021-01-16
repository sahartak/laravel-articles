<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' =>  Str::slug($title),
            'description' => $this->faker->paragraph(200),
            'short_description' => $this->faker->paragraph(20),
            'img' => $this->faker->imageUrl(250, 250),
            'bg_img' => $this->faker->imageUrl(1000, 250),
            'created_at' => $this->faker->dateTimeBetween('-1 year', '-10 days'),
        ];
    }
}
