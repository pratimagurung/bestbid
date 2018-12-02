<?php

use Faker\Generator as Faker;

$factory->define(App\SubCategory::class, function (Faker $faker) {
    return [
        'category_id' => \App\Category::inRandomOrder()->first()->id,
        'name' => $faker->text(8)
    ];
});
