<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; 
use App\Models\Article;  
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=>Hash::make('123')
        ]);

        // Create Sample Categories
        $categories = [
            ['name' => 'Politics', 'description' => 'Latest political news'],
            ['name' => 'Technology', 'description' => 'Tech innovations'],
            ['name' => 'Sports', 'description' => 'Sports updates'],
            ['name' => 'Entertainment', 'description' => 'Movies & Shows'],
        ];

        foreach ($categories as $data) {
            Category::create($data);
        }

        // Create Sample Tags
        $tags = ['Breaking', 'Exclusive', 'Trending', 'Opinion'];
        foreach ($tags as $tagName) {
            Tag::create(['name' => $tagName]);
        }

        // Create Sample Articles
        Article::create([
            'title' => 'Breaking News: Major Political Shift',
            'content' => 'Lorem ipsum dolor sit amet...',
            'category_id' => 1,
            'user_id' => 1,
            'image' => 'news1.jpg',
            'meta_title' => 'Breaking Political News',
            'meta_description' => 'Read the latest political shifts',
            'status' => 'published',
            'views' => 100,
            'published_at' => now(),
        ]);

        // Attach tags to articles
        $article = Article::first();
        $article->tags()->attach([1, 2]);
    }
}
