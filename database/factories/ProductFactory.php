<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'productname' => $faker->text(20),
        'description' => $faker->text(55),
        'picturename' => 'default.jpg',
        'state' => 'unsold',
        'category_id' => function(){
        	return factory(App\Category::class)->create()->id;
        },
        'sub_category_id' => function(){
        	return factory(App\SubCategory::class)->create()->id;
        },
        'user_id' => function(){
        	return factory(App\User::class)->create()->id;
        }
    ];
});
