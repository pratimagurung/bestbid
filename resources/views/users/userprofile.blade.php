@extends('partitions.master')

@section('title','Profile')

@section('body')
<div class="container">
	@if(Session::has('message'))
	<div class="alert alert-info">
		{{ Session::get('message') }}
	</div>
	@endif
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">Personal Information</a></li>
		<li><a data-toggle="tab" href="#menu1">Auctions</a></li>
		<li><a data-toggle="tab" href="#menu2">Bids</a></li>
	</ul>

	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			<h3>Personal Information</h3>
			<p>First Name: {{ $user->firstname }}</p>
			<hr>
			@if(auth()->user()->is_admin && auth()->user()->id!=$user->id)
			@if(!$user->is_banned)
			<form action="{{ url('/ban-user') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="userid" value="{{ $user->id }}">
				<div class="form-group">
					Reason for Ban
					<input type="text" class="form-control" name="reason" id="reason">
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Ban User" class="btn btn-danger">
				</div>
			</form>
			@else
			<form action="{{ url('/unban-user') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="userid" value="{{ $user->id }}">
				<div class="form-group">
					Reason for ban: {{ $user->ban_reason }}
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Unban User" class="btn btn-danger">
				</div>
			</form>
			@endif
			@endif
		</div>
		<div id="menu1" class="tab-pane fade">
			<h3>Auctions</h3>
			@foreach($user->auctions as $auction)
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Auction Name</th>
						<th>Current Price</th>
						<th>End Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach($user->auctions as $auction)
					<tr>
						<td>{{ $auction->auctionname }}</td>
						<td>{{ $auction->current_price }}</td>
						<td>{{ $auction->enddate }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endforeach
		</div>
		<div id="menu2" class="tab-pane fade">
			<h3>Bids</h3>
			@foreach($user->bids as $bid)
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Auction Name</th>
						<th>Bid</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					@foreach(auth()->user()->bids as $bid)
					<tr>
						<td>{{ $bid->auction->auctionname }}</td>
						<td>{{ $bid->amount }}</td>
						<td>
							@if($bid->auction->auction_winner->id == $user->id)
							Won
							@else
							Lost
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endforeach
		</div>
	</div>
</div>
@endsection