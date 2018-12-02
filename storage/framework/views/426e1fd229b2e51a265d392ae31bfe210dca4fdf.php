<?php $__env->startSection('title'); ?> <?php echo e($auction->auctionname); ?> <?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

<?php if(Session::has('message')): ?>
<div class="alert alert-info">
	<?php echo e(Session::get('message')); ?>

</div>
<?php endif; ?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h1 class="text-center"><?php echo e($auction->auctionname); ?></h1>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<img class="img-responsive" src="<?php echo e(asset('images/uploads/'.$auction->product->picturename)); ?>" alt="<?php echo e($auction->product->productname); ?>">
					</div>
					<div class="col-md-8">
						<h1><?php echo e($auction->product->productname); ?></h1>
						<h3><?php echo e($auction->product->description); ?></h3>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-6">
										<p>Current Price: <?php echo e($auction->current_price); ?></p>
										<p>Minimum Bid: <?php echo e($auction->current_price + $auction->bidincrement); ?></p>
										<?php if($auction->is_active): ?>
										<?php if(auth()->check()): ?>
										<?php if(auth()->user()->id!=$auction->user_id): ?>
										<label for="">Enter your maximum bid: </label>
										<form action="<?php echo e(url('/bid')); ?>" method="post">
											<?php echo e(csrf_field()); ?>

											<input type="hidden" name="auction_id" value="<?php echo e($auction->id); ?>">
											<div class="form-inline place-bid">
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon">Rs.</span>
														<input type="number" class="form-control" id="bidAmount" name="bidAmount" aria-label="Bid Amount" required>
													</div>
													<input name="submit" type="submit" value="Place Bid" class="btn btn-success">
												</div>
											</div>
										</form>
										<?php endif; ?>
										<?php else: ?>
										<p><a href="<?php echo e(route('login')); ?>" class="btn btn-success">Login to Bid!</a></p>
										<?php endif; ?>
										<?php else: ?>
										<p class="text-center bg-danger">The auction has ended!</p>
										<?php if($auction->user_id==auth()->user()->id): ?>
										<form action="<?php echo e(url('/auction/delete')); ?>" method="post">
											<?php echo e(csrf_field()); ?>

											<input type="hidden" name="auction_id" value="<?php echo e($auction->id); ?>">
											<div class="form-group">
												<input type="submit" name="submit" value="DELETE" class="form-control btn btn-danger">
											</div>
										</form>
										<?php endif; ?>
										<?php if($auction->has_winner): ?>
										<?php if($auction->auction_winner->id==auth()->user()->id): ?>
										<a class="btn btn-success" href="<?php echo e(url('/contact-seller/'.$auction->id)); ?>">Contact Seller</a>
										<?php endif; ?>
										<?php endif; ?>
										<?php if(count($auction->bids)): ?>
										<h3>Winner: <a href="<?php echo e(url('/profile/'.$auction->auction_winner->id)); ?>"><?php echo e($auction->auction_winner->firstname); ?></a></h3>
										<?php endif; ?>
										<?php endif; ?>
									</div>
									<div class="col-md-6" style="border-left:1px dashed black">
										<p>Number of Bids: <?php echo e(count($auction->bids)); ?></p>
										<p>Bid Increment: <?php echo e($auction->bidincrement); ?></p>
										<p>Seller: <a href="<?php echo e(url('/profile/'.$auction->product->user->id)); ?>"><?php echo e($auction->product->user->firstname); ?> <?php echo e($auction->product->user->lastname); ?></a></p>
										<p>Ends On: <?php echo e($auction->enddate->toDayDateTimeString()); ?></p>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partition.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>