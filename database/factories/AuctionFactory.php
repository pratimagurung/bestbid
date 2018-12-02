<?php

use Faker\Generator as Faker;

$factory->define(App\Auction::class, function (Faker $faker) {
    return [
        'auctionname' => $faker->text(20),
        'startprice' => 10000,
        'auctionstate' => 'running',
        'startdate' => \Carbon\Carbon::now(),
        'enddate' => \Carbon\Carbon::tomorrow(),
        'product_id' => function(){
        	return factory(App\Product::class)->create()->id;
        },
        'user_id' => function(array $auction){
        	return App\Product::find($auction['product_id'])->user_id;
        },
        'bidincrement' => 100
    ];
});
