@extends('partitions.master')

@section('title','Auctions')

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
			@foreach($products as $product)
			@if($product->is_in_auction && $product->auction->is_active)
			<tr>
				<td><a href="{{ url('/auction/'.$product->auction->id) }}">{{ $product->productname }}<br><img class="img-responsive" height="200px" width="200px" src="{{ asset('images/uploads/'.$product->picturename) }}"></a></td>
				<td>{{ $product->description }}</td>
				<td>{{ count($product->auction->bids) }}</td>
				<td>{{ $product->auction->current_price }}</td>
				<td>{{ $product->auction->enddate->diffForHumans() }}</td>
			</tr>
			@endif
			@endforeach
		</tbody>
	</table>
</div>
@endsection