@component('mail::message')
# Hey there {{ $auction->auction_seller->firstname }},

Your auction has ended on BestBid. Unfortunately, no one placed a bid and thus, your auction has no winner.

	You may consider the following strategies while creating an auction next time:
	- Describe your product with as much detail as possible.
	- Upload a clear picture of the product.

You can restart the auction at any time you like.

@component('mail::button', ['url' => config('app.url').'/auction/'.$auction->id])
View Auction
@endcomponent

@component('mail::button', ['url' => config('app.url').'/products'])
View Products
@endcomponent

Thanks,

{{ config('app.name') }}
@endcomponent
