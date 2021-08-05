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
        $this->call([
            StudySeeder::class,
            ProjectSeeder::class,
            AboutSeeder::class,
            ProjectImageSeeder::class,
            BlogSeeder::class,
        ]);
    }
}
