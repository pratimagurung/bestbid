<?php $__env->startSection('title','Profile'); ?>

<?php $__env->startSection('body'); ?>
<div class="container">
	<?php if(Session::has('message')): ?>
	<div class="alert alert-info">
		<?php echo e(Session::get('message')); ?>

	</div>
	<?php endif; ?>
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">Personal Information</a></li>
		<li><a data-toggle="tab" href="#menu1">Auctions</a></li>
		<li><a data-toggle="tab" href="#menu2">Bids</a></li>
	</ul>

	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			<h3>Personal Information</h3>
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
		<div id="menu1" class="tab-pane fade">
			<h3>Auctions</h3>
			<?php $__currentLoopData = $user->auctions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Auction Name</th>
						<th>Current Price</th>
						<th>End Date</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $user->auctions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($auction->auctionname); ?></td>
						<td><?php echo e($auction->current_price); ?></td>
						<td><?php echo e($auction->enddate); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<div id="menu2" class="tab-pane fade">
			<h3>Bids</h3>
			<?php $__currentLoopData = $user->bids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Auction Name</th>
						<th>Bid</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = auth()->user()->bids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($bid->auction->auctionname); ?></td>
						<td><?php echo e($bid->amount); ?></td>
						<td>
							<?php if($bid->auction->auction_winner->id == $user->id): ?>
							Won
							<?php else: ?>
							Lost
							<?php endif; ?>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>