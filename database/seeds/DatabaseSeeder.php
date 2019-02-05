<?php

use App\Post;
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
        // $this->call(UsersTableSeeder::class);

        //Como Post depende de User:
        //  -> primero, se crean los users
        //  -> segundo, se crean los posts

        //Para la creación de usuarios
        //  >> usuarios genéricos fijos (admin|author|user)
        $this->call(UsersTableSeeder::class);
        //  >> otros usuarios aleatorios
        factory(User::class, 25)->create();

        //Para la creación de posts
        factory(Post::class, 74)->create();
    }
}
