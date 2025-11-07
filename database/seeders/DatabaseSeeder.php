<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Category;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::create(['name' => 'writer']);
        Permission::create(['name' => 'create articles']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        $role->givePermissionTo(['create articles', 'edit articles', 'delete articles']);

        $role = Role::create(['name' => 'publisher']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);
        $role->givePermissionTo(['create categories', 'edit categories', 'delete categories']);

        $role = Role::create(['name' => 'administrator']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        $role->givePermissionTo(['create users', 'edit categories', 'delete users']);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $admin = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('test@example.com')
        ]);
        $admin->assignrole(['writer', 'publisher', 'administrator']);
        
        User::factory(5)->create();// random users for article author

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
            $article = Article::factory()->create([
                'image' => $imageUrl,
                'user_id' => User::inRandomOrder()->first(),
                'category_id' => Category::inRandomOrder()->first()
            ]);

            for($i = 0; $i < rand(5, 25); $i ++) {
            Comment::factory()->create([
                'article_id' => $article,
                'user_id' => User::inRandomOrder()->first(),
            ]);
            }
        }
    }
}
