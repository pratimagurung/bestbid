@extends('partitions.master')

@section('title','Best Bid')

@section('body')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Contact Winner
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<h3 class="text-center">Winner Details</h3>
					<p>Name: {{ $auction->auction_winner->firstname }} {{ $auction->auction_winner->lastname }}</p>
					<p>Email: {{ $auction->auction_winner->email }}</p>
					<p>Contact Number: {{ $auction->auction_winner->contact }} </p>
					<p>Address: {{ $auction->auction_winner->address }}</p>
				</div>
				<div class="col-md-8">
					<h3>Send a mail to the winner.</h3>
					<form action="{{ url('/contact/winner') }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="auction" value="{{ $auction->id }}">
						<div class="form-group">
							<label>Message</label>
							<textarea class="form-control" name="message"></textarea>
						</div>
						<div class="form-group">
							<input class="form-control btn btn-success" type="submit" name="submit" value="Send Mail">
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection