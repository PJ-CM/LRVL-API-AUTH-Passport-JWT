<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  >> usuarios genéricos fijos (admin|author|user)
        $tot_users = 3;
        $faker = Factory::create();
        for ($i = 0; $i < $tot_users; $i++) {

            //A diferencia de lo que pasa en los registros generados por el archivo de Factory,
            //en los generados por este Seeder, los campos de timestamp (created_at y update_at)
            //no son rellenados automáticamente, por ello es necesario establecer un valor por defecto
            //si se desea que aparezcan con un volor inicial y no un NULL
            $timestamp = mt_rand(1, time());
            $randomDate = date('Y-m-d H:i:s', $timestamp);

            if ($i == 0) {
                DB::table('users')->insert([
                    'name' => 'admin',

                    'username' => 'admin',
                    'direction' => $faker->streetAddress,
                    'phone' => '+34 943-741174',
                    'country' => $faker->country,

                    'email' => 'admin@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('admin'),

                    //posibles ('admin','author','user')
                    'perfil' => 'admin',

                    'remember_token' => str_random(10),

                    'activo' => 1,

                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);

            } else if ($i == 1) {
                DB::table('users')->insert([
                    'name' => 'aut',

                    'username' => 'aut',
                    'direction' => $faker->streetAddress,
                    'phone' => '+34 943-987654',
                    'country' => $faker->country,

                    'email' => 'aut@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('xxxxxx'),

                    //posibles ('admin','author','user')
                    'perfil' => 'author',

                    'remember_token' => str_random(10),

                    'activo' => 1,

                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);

            } else if ($i == 2) {
                DB::table('users')->insert([
                    'name' => 'usu',

                    'username' => 'usu',
                    'direction' => $faker->streetAddress,
                    'phone' => '+34 943-987654',
                    'country' => $faker->country,

                    'email' => 'usu@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('xxxxxx'),

                    //posibles ('admin','author','user')
                    'perfil' => 'user',

                    'remember_token' => str_random(10),

                    'activo' => 1,

                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,
                ]);

            }

        }
    }
}
