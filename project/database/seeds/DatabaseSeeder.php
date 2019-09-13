<?php

use App\Article;
use App\User;
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
        factory(User::class)->create();
        factory(Article::class)->create();
         //$this->call(UsersTableSeeder::class);
    }
}
