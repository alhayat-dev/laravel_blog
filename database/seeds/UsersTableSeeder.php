<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@mail.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@mail.com',
                'password' => bcrypt('secret')
            ],
            [
                'name' => 'Mudasser Hayat',
                'email' => 'alhayat.dev@gmail.com',
                'password' => bcrypt('secret')
            ]
        ]);
    }
}
