<?php $__env->startSection('title','My Products'); ?>

<?php $__env->startSection('body'); ?>
<div class="container">
  <?php if(Session::has('message')): ?>
  <div class="alert alert-info">
    <?php echo e(Session::get('message')); ?>

  </div>
  <?php endif; ?>
  <?php if(count($errors)): ?>
  <div class="alert alert-danger">
    <ul>
     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <li> <?php echo e($error); ?> </li>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
   </ul>
 </div>
 <?php endif; ?>
 <div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      My Products
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
          <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($product->productname); ?></td>
            <td><?php echo e($product->description); ?></td>
            <td><?php echo e($product->category->categoryname); ?></td>
            <td><?php echo e($product->state); ?></td>
            <td><img height="200px" width="200px" class="img-responsive" src="<?php echo e(asset('images/uploads/'.$product->picturename)); ?>" alt="<?php echo e($product->productname); ?>"></td>
            <td>
              <?php if($product->is_in_auction): ?>
              <?php if(!$product->auction->is_active): ?>
              <?php if($product->auction->has_winner): ?>
              <a href="<?php echo e(url('/contact/winner/'.$product->auction->id)); ?>" class="btn btn-success">Contact Winner</a>
              <?php else: ?>
              <?php if(!$product->auction->is_in_future && !$product->auction->is_active): ?>
              <a id="auctionBtn" data-productname="<?php echo e($product->productname); ?>" data-productid="<?php echo e($product->id); ?>" data-productdescription="<?php echo e($product->description); ?>" class="btn btn-warning" data-toggle="modal" data-target="#startAuctionModal">Restart Auction</a>
              <?php endif; ?>
              <?php endif; ?>
              <?php endif; ?>
              <a href="<?php echo e(url('/auction/'.$product->auction->id)); ?>" class="btn btn-primary">View Auction</a>
              <?php else: ?>
              <a id="auctionBtn" data-productname="<?php echo e($product->productname); ?>" data-productid="<?php echo e($product->id); ?>" data-productdescription="<?php echo e($product->description); ?>" class="btn btn-primary" data-toggle="modal" data-target="#startAuctionModal">Start Auction</a>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
       <form action="<?php echo e(url('/auction')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

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
              <input class="form-control" type="text" name="startprice" id="startprice" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              Bid Increment
              <input class="form-control" type="text" name="bidincrement" id="bidincrement" required>
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
              <input class="form-control" type="date" name="auctionstartdate" min="<?php echo e(date('Y-m-d')); ?>">
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
              <input class="form-control" type="date" name="auctionenddate" min="<?php echo e(date('Y-m-d')); ?>">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partition.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>