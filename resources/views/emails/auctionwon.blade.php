@component('mail::message')
# Congratulations!!

You have won an auction on BestBid!

Message from Seller: {{ $message }}

@component('mail::button', ['url' => config('app.url').'/auction/'.$auction->id])
View Auction
@endcomponent

@component('mail::button', ['url' => config('app.url').'/contact/seller/'.$auction->id])
Contact Seller
@endcomponent

Thanks,

{{ config('app.name') }}
@endcomponent
