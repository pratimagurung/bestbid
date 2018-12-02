@extends('partitions.master')

@section('title','My Products')

@section('body')
<div class="container">
  @if(Session::has('message'))
  <div class="alert alert-info">
    {{ Session::get('message') }}
  </div>
  @endif
  @if(count($errors))
  <div class="alert alert-danger">
    <ul>
     @foreach($errors->all() as $error)
     <li> {{ $error }} </li>
     @endforeach 
   </ul>
 </div>
 @endif
 @include('users.profile-navbar')
 <div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <p class="text-center">My Products </p>
    </div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>State</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
          <tr id="product-{{ $product->id }}">
            <td>{{ $product->productname }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->category->categoryname }}</td>
            <td>{{ $product->state }}</td>
            <td><img height="200px" width="200px" class="img-responsive" src="{{ asset('images/uploads/'.$product->picturename) }}" alt="{{ $product->productname }}"></td>
            <td>
              @if($product->is_in_auction)
              @if(!$product->auction->is_active)
              @if($product->auction->has_winner)
              <a href="{{ url('/contact/winner/'.$product->auction->id) }}" class="btn btn-success">Contact Winner</a>
              @else
              @if(!$product->auction->is_in_future && !$product->auction->is_active)
              <a id="auctionBtn" data-productname="{{ $product->productname }}" data-productid="{{ $product->id }}" data-productdescription="{{ $product->description }}" class="btn btn-warning" data-toggle="modal" data-target="#startAuctionModal">Restart Auction</a>
              @endif
              @endif
              @endif
              <a href="{{ url('/auction/'.$product->auction->id) }}" class="btn btn-primary">View Auction</a>
              @else
              <a id="auctionBtn" data-productname="{{ $product->productname }}" data-productid="{{ $product->id }}" data-productdescription="{{ $product->description }}" class="btn btn-primary" data-toggle="modal" data-target="#startAuctionModal">Start Auction</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- Start Auction Modal -->
<div id="startAuctionModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Start Auction</h4>
      </div>
      <div class="modal-body">
       <form action="{{ url('/auction') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" id="productid" name="productid">
        <div class="form-group">
          Product Name
          <input class="form-control" type="text" id="currentProductName" readonly>
        </div>
        <div class="form-group">
          Product Description
          <input class="form-control" type="text" id="currentProductDescription" readonly>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              Start Price
              <input class="form-control" type="number" min="1" max="999999" name="startprice" id="startprice" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              Bid Increment
              <input class="form-control" type="number" min="1" max="10000" name="bidincrement" id="bidincrement" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          Auction Name
          <input type="text" name="name" placeholder="Auction Name" class="form-control">
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              Start Date
              <input class="form-control" type="date" name="auctionstartdate" min="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-3">
              Hour
              <input class="form-control" min="1" max="12" type="number" name="starthour">
            </div>
            <div class="col-md-3">
              Minute
              <input class="form-control" min="0" max="59" type="number" name="startminute">
            </div>
            <div class="col-md-3">
              AM or PM?
              <select class="form-control" name="startampm">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-3">
              End Date
              <input class="form-control" type="date" name="auctionenddate" min="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-3">
              Hour
              <input class="form-control" min="1" max="12" type="number" name="endhour">
            </div>
            <div class="col-md-3">
              Minute
              <input class="form-control" min="0" max="59" type="number" name="endminute">
            </div>
            <div class="col-md-3">
              AM or PM?
              <select class="form-control" name="endampm">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Add Auction" class="btn btn-success">
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $(document).on('click', '#auctionBtn', function(){
    var productName = $(this).data('productname');
    var productDescription= $(this).data('productdescription');
    var productId = $(this).data('productid');
    $('#productid').val(productId);
    $('#currentProductName').val(productName);
    $('#currentProductDescription').val(productDescription);
  });
</script>
@endsection