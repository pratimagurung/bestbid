<?php $__env->startSection('title','My Auctions'); ?>

<?php $__env->startSection('body'); ?>
<div class="container">
  <?php echo $__env->make('users.profile-navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php if(Session::has('message')): ?>
  <div class="alert alert-info">
    <?php echo e(Session::get('message')); ?>

  </div>
  <?php endif; ?>
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
          <?php $__currentLoopData = auth()->user()->auctions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($auction->auctionname); ?></td>
            <td><?php echo e($auction->current_price); ?></td>
            <td><?php echo e($auction->enddate); ?></td>
            <td><a href="<?php echo e(url('/products#product-'.$auction->product->id)); ?>"><?php echo e($auction->product->productname); ?></a></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>