@extends('partitions.master')

@section('title','My Auctions')

@section('body')
<div class="container">
  @include('users.profile-navbar')
  @if(Session::has('message'))
  <div class="alert alert-info">
    {{ Session::get('message') }}
  </div>
  @endif
  <div class="panel panel-default">
    <div class="panel-heading"><p class="text-center">My Auctions</p></div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>My Auction Name</th>
            <th>Current Price</th>
            <th>End Date</th>
            <th>Related Product</th>
          </tr>
        </thead>
        <tbody>
          @foreach(auth()->user()->auctions as $auction)
          <tr>
            <td>{{ $auction->auctionname }}</td>
            <td>{{ $auction->current_price }}</td>
            <td>{{ $auction->enddate }}</td>
            <td><a href="{{ url('/products#product-'.$auction->product->id) }}">{{ $auction->product->productname }}</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection