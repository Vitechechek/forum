<?php

use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create()->id,
        'comment' => $faker->sentence,
        'commentable_id' => factory(\App\Thread::class)->create()->id,
        'commentable_type' => \App\Thread::class,
    ];
});
