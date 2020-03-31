<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->delete();
        $faker = Factory::create();

        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'slug' => 'john-doe',
                'email' => 'john@mail.com',
                'password' => bcrypt('secret'),
                'bio' => $faker->text(rand(250,300))
            ],
            [
                'name' => 'Jane Doe',
                'slug' => 'jane-doe',
                'email' => 'jane@mail.com',
                'password' => bcrypt('secret'),
                'bio' => $faker->text(rand(250,300))
            ],
            [
                'name' => 'Mudasser Hayat',
                'slug' => 'mudasser-hayat',
                'email' => 'alhayat.dev@gmail.com',
                'password' => bcrypt('secret'),
                'bio' => $faker->text(rand(250,300))
            ]
        ]);
    }
}
