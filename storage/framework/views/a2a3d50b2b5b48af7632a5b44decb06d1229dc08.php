<?php $__env->startSection('title','My Bids'); ?>

<?php $__env->startSection('body'); ?>

<div class="container">
  <?php echo $__env->make('users.profile-navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php if(Session::has('message')): ?>
  <div class="alert alert-info">
    <?php echo e(Session::get('message')); ?>

  </div>
  <?php endif; ?>

  <div class="panel panel-default">
    <div class="panel-heading"><p class="text-center">My Bids</p></div>
    <div class="panel-body">
      <?php if(count(auth()->user()->bids)): ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Auction Name</th>
            <th>My Bid</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
         <?php $__currentLoopData = auth()->user()->bids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr>
          <td><?php echo e($bid->auction->auctionname); ?></td>
          <td><?php echo e($bid->amount); ?></td>
          <td>
            <?php if($bid->auction->auction_winner->id == auth()->user()->id): ?>
            Won <a href="<?php echo e(url('/contact/seller/'.$bid->auction->id)); ?>" class="btn btn-success">Contact Seller</a>
            <?php else: ?>
            Lost
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>