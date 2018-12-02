<?php $__env->startSection('title','Auctions'); ?>

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
			<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($product->is_in_auction && $product->auction->is_active): ?>
			<tr>
				<td><a href="<?php echo e(url('/auction/'.$product->auction->id)); ?>"><?php echo e($product->productname); ?><br><img class="img-responsive" height="200px" width="200px" src="<?php echo e(asset('images/uploads/'.$product->picturename)); ?>"></a></td>
				<td><?php echo e($product->description); ?></td>
				<td><?php echo e(count($product->auction->bids)); ?></td>
				<td><?php echo e($product->auction->current_price); ?></td>
				<td><?php echo e($product->auction->enddate->diffForHumans()); ?></td>
			</tr>
			<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>