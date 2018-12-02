<?php $__env->startSection('title','Best Bid'); ?>

<?php $__env->startSection('body'); ?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			Contact Seller
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-4">
					<h3 class="text-center">Seller Details</h3>
					<p>Name: <?php echo e($auction->auction_seller->firstname); ?> <?php echo e($auction->auction_seller->lastname); ?></p>
					<p>Email: <?php echo e($auction->auction_seller->email); ?></p>
					<p>Contact Number: </p>
					<p>Address: <?php echo e($auction->auction_seller->address); ?></p>
				</div>
				<div class="col-md-8">
					<h3>Send a mail to the seller.</h3>
					<form action="<?php echo e(url('/contact/seller')); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="auction" value="<?php echo e($auction->id); ?>">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partition.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>