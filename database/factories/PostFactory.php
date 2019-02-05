<?php

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    /**
     * Capturando lista de registros de User para generar
     * un aleatorio ID de usuario existente como autor
     * del post a generar
     */
    static $users;
    $users = User::all();

    return [
        'titulo' => $faker->sentence(mt_rand(2,4)),
        'texto' => $faker->paragraph(2),
        'user_id' => $users->random()->id,
        'activo' => $faker->numberBetween(0,1),
    ];
});
