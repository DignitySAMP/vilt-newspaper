<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();// random users for article author

        User::factory()->create([
            'name' => 'Webteam Datalink',
            'email' => 'webteam@datalink.be',
            'password' => Hash::make('webteam@datalink.be')
        ]);
        
        Category::factory()->create([ 'title' => 'World' ]);
        Category::factory()->create([ 'title' => 'Technology' ]);
        Category::factory()->create([ 'title' => 'Business' ]);
        Category::factory()->create([ 'title' => 'Culture' ]);
        Category::factory()->create([ 'title' => 'Opinion' ]);

        $tmpArticleImages = [
            'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1611273426858-450d8e3c9fce?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1594818379496-da1e345b0ded?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1614728894747-a83421e2b9c9?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1518005068251-37900150dfca?w=600&h=400&fit=crop',
            'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1561214115-f2f134cc4912?w=400&h=300&fit=crop',
            'https://images.unsplash.com/photo-1579532537598-459ecdaf39cc?w=400&h=300&fit=crop',
        ];

        foreach ($tmpArticleImages as $imageUrl) {
            Article::factory()->create([
                'image' => $imageUrl,
                'user_id' => User::inRandomOrder()->first(),
                'category_id' => Category::inRandomOrder()->first()
            ]);
        }
    }
}
