<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)->create();  // Seeder untuk 10 users
        Category::insert([
            ['name' => 'Technology'],
            ['name' => 'Health'],
            ['name' => 'Sports'],
            ['name' => 'Politics'],
        ]);

        Article::factory(20)->create(); // Seeder untuk 20 artikel
    }
}
