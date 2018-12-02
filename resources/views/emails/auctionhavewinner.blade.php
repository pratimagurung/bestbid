@component('mail::message')
# Congratulations!!

Your auction has a winner on BestBid!

Message from Winner: {{ $message }}

@component('mail::button', ['url' => config('app.url').'/auction/'.$auction->id])
View Auction
@endcomponent

@component('mail::button', ['url' => config('app.url').'/contact/winner/'.$auction->id])
Contact Winner
@endcomponent

Thanks,

{{ config('app.name') }}
@endcomponent
