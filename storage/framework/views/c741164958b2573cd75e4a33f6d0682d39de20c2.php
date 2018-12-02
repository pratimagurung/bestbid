<?php $__env->startSection('title','Buy It Now'); ?>

<?php $__env->startSection('body'); ?>
<div class="container">          
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Product</th>
				<th>Title</th>
				<th>Bids</th>
				<th>Price</th>
				<th>Time Left</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $auctions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $auction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if(!count($auction->bids)): ?>
			<tr>
				<td><a href="<?php echo e(url('/auction/'.$auction->id)); ?>"><?php echo e($auction->product->productname); ?></a> <img height="150px" width="150px" src="<?php echo e(asset('images/uploads/'.$auction->product->picturename)); ?>"></td>
				<td><?php echo e($auction->product->description); ?></td>
				<td><?php echo e(count($auction->bids)); ?></td>
				<td><?php echo e($auction->current_price); ?></td>
				<td><?php echo e($auction->enddate->diffForHumans()); ?></td>
			</tr>
			<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<?php echo e($auctions->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>