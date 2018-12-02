@extends('partitions.master')

@section('title') Best Bid @endsection

@section('body')

<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="item active">
			<img class="img-responsive" src="images/pic/log.jpg">
			<div class="carousel-caption">
				<h3>Best Bid</h3>
				<p>Bid It To Win It!</p>
			</div>
		</div>

		<div class="item">
			<img class="img-responsive" src="images/pic/1.jpg">
			<div class="carousel-caption">
				<h3></h3>
				<p>Lets Bid!</p>
			</div>
		</div>

		<div class="item">
			<img class="img-responsive" src="{{ asset('images/pic/auc.jpg') }}">
			<div class="carousel-caption">
				<h3></h3>
				<p>Hurry Up!</p>
			</div>
		</div>
	</div>

	<!-- Left and right controls -->
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<div class="container">
	<h2>Auction Gallery</h2>
	@if(count($auctions)<=3)
	<div class="row"> 
		@foreach($auctions as $auction)
		<div class="col-md-4">
			<div class="well">
				<h4 class="text-center">{{ $auction->auctionname }}</h4>
				<img height="200px" width="200px" class="img-responsive center-block" src="{{ asset('images/uploads/'.$auction->product->picturename) }}" alt="{{ $auction->product->productname }}">
				<br>
				<p class="text-center">
					{{ $auction->enddate->diffForHumans(null,true) }} remaining
					<a href="{{ url('/auction/'.$auction->id) }}" class="btn btn-block btn-primary">View Details</a>
				</p>
			</div>
		</div>
		@endforeach
	</div>
	@else
	@foreach($auctions->chunk(3) as $chunkedAuctions)
	<div class="row">
		@foreach($chunkedAuctions as $auction)
		<div class="col-md-4">
			<div class="well">
				<h4 class="text-center">{{ $auction->auctionname }}</h4>
				<img height="200px" width="200px" class="img-responsive center-block" src="{{ asset('images/uploads/'.$auction->product->picturename) }}" alt="{{ $auction->product->productname }}">
				<br>
				<p class="text-center">
					{{ $auction->enddate->diffForHumans(null, true) }} remaining
					<a href="{{ url('/auction/'.$auction->id) }}" class="btn btn-block btn-primary">View Details</a>
				</p>
			</div>
		</div>
		@endforeach
	</div>
	@endforeach	
	@endif
</div>
@endsection