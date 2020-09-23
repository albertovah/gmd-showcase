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
            'name' => 'admin',
            'admin' => 'true',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
