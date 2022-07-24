<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'username' => 'User',
            'email' => 'User@co.jp',
            'password' => bcrypt('password'),
            'admin_role' => 1,
        ]);
    }
}
