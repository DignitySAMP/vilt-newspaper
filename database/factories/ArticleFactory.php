<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' =>  $this->faker->unique()->sentence(6),
            'content' => $this->faker->paragraphs(6, true),
            'summary' => $this->faker->paragraph(),
        ];
    }
}


