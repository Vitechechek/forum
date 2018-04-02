<?php

use Faker\Generator as Faker;

$factory->define(\App\Thread::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence,
        'user_id' => factory(\App\User::class)->create()->id,
        'thread' => $faker->sentence,
        'type' => $faker->word,
    ];
});
