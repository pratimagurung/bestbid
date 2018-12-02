@extends('partitions.master')

@section('title','My Bids')

@section('body')

<div class="container">
  @include('users.profile-navbar')
  @if(Session::has('message'))
  <div class="alert alert-info">
    {{ Session::get('message') }}
  </div>
  @endif

  <div class="panel panel-default">
    <div class="panel-heading"><p class="text-center">My Bids</p></div>
    <div class="panel-body">
      @if(count(auth()->user()->bids))
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Auction Name</th>
            <th>My Bid</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
         @foreach(auth()->user()->bids as $bid)
         <tr>
          <td>{{ $bid->auction->auctionname }}</td>
          <td>{{ $bid->amount }}</td>
          <td>
            @if($bid->auction->auction_winner->id == auth()->user()->id)
            Won <a href="{{ url('/contact/seller/'.$bid->auction->id) }}" class="btn btn-success">Contact Seller</a>
            @else
            Lost
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
</div>

@endsection