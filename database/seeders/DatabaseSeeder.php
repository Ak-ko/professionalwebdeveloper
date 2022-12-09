<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Article::factory(20)->create();
        \App\Models\Comment::factory(40)->create();

        $list = ['News', 'Tech', 'Global', 'Language', 'General'];
        foreach($list as $name)
        {
            \App\Models\Category::create([
                "name" => $name
            ]);
        }

        \App\Models\User::factory([
            "name" => "Aung",
            "email" => "aung@demo.com",
        ])->create();

        \App\Models\User::factory([
            "name" => "Bob",
            "email" => "bob@demo.com",
        ])->create();
    }
}
