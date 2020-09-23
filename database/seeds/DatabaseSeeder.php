<?php

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
        $this->call(['UsersTableSeeder']);

        $this->command->info('User table seeded!');
    }
    /*met test data*/
    /*$this->call(['UsersTableSeeder','CategorieSeeder','ModuleSeeder','ProductSeeder']);*/
}
