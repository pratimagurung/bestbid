<?php $__env->startSection('title','My Products'); ?>

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
			<tr>
				<td><a href="<?php echo e(url('/auction/'.$auction->id)); ?>"><?php echo e($auction->product->productname); ?><br><img class="img-responsive" height="200px" width="200px" src="<?php echo e(asset('images/uploads/'.$auction->product->picturename)); ?>"></a></td>
				<td><?php echo e($auction->product->description); ?></td>
				<td><?php echo e(count($auction->bids)); ?></td>
				<td><?php echo e($auction->current_price); ?></td>
				<td><?php echo e($auction->enddate->diffForHumans()); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<?php echo e($auctions->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partition.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>