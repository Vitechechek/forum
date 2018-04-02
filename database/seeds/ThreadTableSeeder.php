<?php

use Illuminate\Database\Seeder;

class ThreadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        /*DB::table('threads')->insert([
            'subject' => $faker->sentence,
            'thread' => $faker->paragraph,
            'type' => $faker->word,
            'user_id'=> \App\User::all()->random()->first()->id,
        ]);*/
    }
}
