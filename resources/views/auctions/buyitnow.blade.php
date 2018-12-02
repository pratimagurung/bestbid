@extends('partitions.master')

@section('title','Buy It Now')

@section('body')
<div class="container">          
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Product</th>
				<th>Title</th>
				<th>Bids</th>
				<th>Price</th>
				<th>Time Left</th>
			</tr>
		</thead>
		<tbody>
			@foreach($auctions as $auction)
			@if(!count($auction->bids))
			<tr>
				<td><a href="{{ url('/auction/'.$auction->id) }}">{{ $auction->product->productname }}</a> <img height="150px" width="150px" src="{{ asset('images/uploads/'.$auction->product->picturename) }}"></td>
				<td>{{ $auction->product->description }}</td>
				<td>{{ count($auction->bids) }}</td>
				<td>{{ $auction->current_price }}</td>
				<td>{{ $auction->enddate->diffForHumans() }}</td>
			</tr>
			@endif
			@endforeach
		</tbody>
	</table>
	{{ $auctions->links() }}
</div>
@endsection