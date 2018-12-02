<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
	use RefreshDatabase;

    public function test_product_not_in_auction()
    {
        $product = factory(\App\Product::class)->create();
        $this->assertFalse($product->is_in_auction);
    }

        public function test_product_in_auction()
    {
        $auction = factory(\App\Auction::class)->create();
        $this->assertTrue($auction->product->is_in_auction);
    }
}
