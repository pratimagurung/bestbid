<?php $__env->startSection('title','Profile'); ?>

<?php $__env->startSection('body'); ?>
<div class="container">
	<?php if(Session::has('message')): ?>
	<div class="alert alert-info">
		<?php echo e(Session::get('message')); ?>

	</div>
	<?php endif; ?>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					Personal Information
				</div>
				<div class="panel-body">
					<p>First Name: <?php echo e($user->firstname); ?></p>
					<hr>
					<?php if(auth()->user()->is_admin && auth()->user()->id!=$user->id): ?>
					<?php if(!$user->is_banned): ?>
					<form action="<?php echo e(url('/ban-user')); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="userid" value="<?php echo e($user->id); ?>">
						<div class="form-group">
							Reason for Ban
							<input type="text" class="form-control" name="reason" id="reason">
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="Ban User" class="btn btn-danger">
						</div>
					</form>
					<?php else: ?>
					<form action="<?php echo e(url('/unban-user')); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="userid" value="<?php echo e($user->id); ?>">
						<div class="form-group">
							Reason for ban: <?php echo e($user->ban_reason); ?>

						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="Unban User" class="btn btn-danger">
						</div>
					</form>
					<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">My Auctions</div>
				<div class="panel-body">
					<?php $__currentLoopData = $user->auctions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php echo e($auction->auctionname); ?>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">My Bids</div>
				<div class="panel-body">
					<?php $__currentLoopData = $user->bids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php echo e($bid->auction['auctionname']); ?>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partition.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>