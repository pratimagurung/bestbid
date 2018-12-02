@extends('partitions.master')

@section('title') {{ $auction->auctionname }} @endsection

@section('body')

@if(Session::has('message'))
<div class="alert alert-info">
	{{ Session::get('message') }}
</div>
@endif

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading dark-primary-color">
				<h1 class="text-center text-primary-color">{{ $auction->auctionname }}</h1>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<img class="img-responsive" src="{{ asset('images/uploads/'.$auction->product->picturename) }}" alt="{{ $auction->product->productname }}">
					</div>
					<div class="col-md-8">
						<h1>{{ $auction->product->productname }}</h1>
						<h3>{{ $auction->product->description }}</h3>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<p>Current Price: {{ $auction->current_price }}</p>
										<p>Minimum Bid: {{ $auction->current_price + $auction->bidincrement }}</p>
										@if($auction->is_active)
										@if(auth()->check())
										@if(auth()->user()->id!=$auction->user_id)
										@if(!$auction->is_in_future)
										<label for="">Enter your maximum bid: </label>
										<form action="{{ url('/bid') }}" method="post">
											{{ csrf_field() }}
											<input type="hidden" name="auction_id" value="{{ $auction->id }}">
											<div class="form-inline place-bid">
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon">Rs.</span>
														<input type="number" class="form-control" id="bidAmount" name="bidAmount" aria-label="Bid Amount" required>
													</div>
													<input name="submit" type="submit" value="Place Bid" class="btn btn-success">
												</div>
											</div>
										</form>
										@endif
										@endif
										@else
										<p><a href="{{ route('login') }}" class="btn btn-success">Login to Bid!</a></p>
										@endif
										@else
										<p class="text-center bg-danger">The auction has ended!</p>
										@if(auth()->check())
										@if($auction->user->id==auth()->user()->id)
										<form action="{{ url('/auction/delete') }}" method="post">
											{{ csrf_field() }}
											<input type="hidden" name="auction_id" value="{{ $auction->id }}">
											<div class="form-group">
												<input type="submit" name="submit" value="DELETE" class="form-control btn btn-danger">
											</div>
										</form>
										@endif
										@endif
										@if($auction->has_winner)
										@if(auth()->check())
										@if($auction->auction_winner->id==auth()->user()->id)
										<a class="btn btn-success" href="{{ url('/contact/seller/'.$auction->id) }}">Contact Seller</a>
										@endif
										@endif
										@endif
										@if(count($auction->bids))
										<h3>Winner: <a href="{{ url('/profile/'.$auction->auction_winner->id) }}">{{ $auction->auction_winner->firstname }}</a></h3>
										@endif
										@endif
									</div>
									<div class="col-md-6" style="border-left:1px dashed black">
										<p>Number of Bids: {{ count($auction->bids) }}</p>
										<p>Bid Increment: {{ $auction->bidincrement }}</p>
										<p>Seller: <a href="{{ url('/profile/'.$auction->product->user->id) }}">{{ $auction->product->user->firstname }} {{ $auction->product->user->lastname }}</a></p>
										<p>Started On: {{ $auction->startdate->toDayDateTimeString() }}</p>
										<p>Ends On: {{ $auction->enddate->toDayDateTimeString() }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection