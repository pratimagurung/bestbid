<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuctionTest extends TestCase
{
	use RefreshDatabase;

    public function test_auction_is_active()
    {
        $auction = factory(\App\Auction::class)->create();
        $this->assertTrue($auction->is_active);
    }

    public function test_auction_has_winner(){
        $auction = factory(\App\Auction::class)->create();
        $this->assertFalse($auction->has_winner);
    }
}
