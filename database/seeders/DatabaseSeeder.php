<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'name' => 'Muhammad Abdiel Firjatullah',
            'username' => 'muhammadabdiel',
            'email' => 'abdielfirdie@gmail.com',
            'password' => bcrypt('13122001'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Kissyin Syahbinar',
            'username' => 'kissyinsyahbinar',
            'email' => 'kisyinsyahbinar@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Sabrina Putri Maulisa',
            'username' => 'sabrinaputrimaulisa',
            'email' => 'sabrinaputrimaulisa@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // User::factory(4)->create();

        Category::create([
            'name' => 'Programming',
            'slug' => 'programming'
        ]);

        Category::create([
            'name' => 'Design',
            'slug' => 'design'
        ]);

        Category::create([
            'name' => 'Sport',
            'slug' => 'sport'
        ]);

        Category::create([
            'name' => 'Music',
            'slug' => 'music'
        ]);

        Category::create([
            'name' => 'Travel',
            'slug' => 'travel'
        ]);

        Category::create([
            'name' => 'Food',
            'slug' => 'food'
        ]);

        Category::create([
            'name' => 'Technology',
            'slug' => 'technology'
        ]);

        Category::create([
            'name' => 'News',
            'slug' => 'news'
        ]);

        Category::create([
            'name' => 'Health',
            'slug' => 'health'
        ]);

        Category::create([
            'name' => 'Fashion',
            'slug' => 'fashion'
        ]);

        Category::create([
            'name' => 'Lifestyle',
            'slug' => 'lifestyle'
        ]);

        Category::create([
            'name' => 'Art',
            'slug' => 'art'
        ]);

        Category::create([
            'name' => 'Education',
            'slug' => 'education'
        ]);

        Category::create([
            'name' => 'Business',
            'slug' => 'business'
        ]);

        Category::create([
            'name' => 'Politics',
            'slug' => 'politics'
        ]);

        Category::create([
            'name' => 'Entertainment',
            'slug' => 'entertainment'
        ]);

        Category::create([
            'name' => 'Nature',
            'slug' => 'nature'
        ]);

        Category::create([
            'name' => 'Others',
            'slug' => 'others'
        ]);

        // Post::factory(30)->create();
    }
}
