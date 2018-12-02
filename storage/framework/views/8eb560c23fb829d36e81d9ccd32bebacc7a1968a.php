<?php $__env->startSection('title','Best Bid'); ?>

<?php $__env->startSection('body'); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<p class="text-center">Users </p>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($user->firstname); ?></td>
					<td><?php echo e($user->lastname); ?></td>
					<td><?php echo e($user->email); ?></td>
					<td><?php echo e($user->bannedText); ?></td>
					<td><a href="<?php echo e(url('/profile/'.$user->id)); ?>" class="btn btn-primary">View Profile</button></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>