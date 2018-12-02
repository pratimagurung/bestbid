<?php $__env->startSection('title','Profile'); ?>

<?php $__env->startSection('body'); ?>

<div class="container">
	<?php echo $__env->make('users.profile-navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php if(Session::has('message')): ?>
	<div class="alert alert-info">
		<?php echo e(Session::get('message')); ?>

	</div>
	<?php endif; ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<p class="text-center">Personal Information </p>
		</div>
		<div class="modal-body">
			<form action="<?php echo e(url('/profile')); ?>" method="post">
				<?php echo e(csrf_field()); ?>

				<input type="hidden" id="userid" name="userid">
				<div class="form-group<?php echo e($errors->has('firstname') ? ' has-error' : ''); ?>">
					First Name
					<input name="firstname" class="form-control" type="text" value="<?php echo e(auth()->user()->firstname); ?>" id="firstname">
					<?php if($errors->has('firstname')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('firstname')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('lastname') ? ' has-error' : ''); ?>">
					Last Name
					<input name="lastname" class="form-control" type="text" value="<?php echo e(auth()->user()->lastname); ?>" id="lastname">
					<?php if($errors->has('lastname')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('lastname')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
					Address
					<input name="address" class="form-control" type="text" value="<?php echo e(auth()->user()->address); ?>" id="address">
					<?php if($errors->has('address')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('address')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
					Email-Address
					<input name="email" class="form-control" type="text" value="<?php echo e(auth()->user()->email); ?>" id="email">
					<?php if($errors->has('email')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('email')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
				<div class="form-group<?php echo e($errors->has('contact') ? ' has-error' : ''); ?>">
					Contact Number
					<input name="contact" class="form-control" type="text" value="<?php echo e(auth()->user()->contact); ?>" id="contact">
					<?php if($errors->has('contact')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('contact')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Submit" class="btn btn-success">
				</div>
			</form>
			<button id="changePasswordBtn" class="btn btn-warning">Change Password</button>
		</div>
	</div>

	<div id="changePasswordPanel" class="panel panel-default">
		<div class="panel-heading">Change Password</div>
		<div class="panel-body">
			<form action="<?php echo e(url('/profile/password')); ?>" method="post">
				<?php echo e(csrf_field()); ?>

				<div class="form-group" <?php echo e($errors->has('oldpassword') ? ' has-error' : ''); ?>">
					Old Password
					<input class="form-control" type="password" name="oldpassword" id="oldpassword">
					<?php if($errors->has('oldpassword')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('oldpassword')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
				<div class="form-group" <?php echo e($errors->has('newpassword') ? ' has-error' : ''); ?>">
					New Password
					<input class="form-control" type="password" name="newpassword" id="newpassword">
					<?php if($errors->has('newpassword')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('newpassword')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
				<div class="form-group" <?php echo e($errors->has('newpassword_confirmation') ? ' has-error' : ''); ?>">
					Confirm New Password
					<input class="form-control" type="password" name="newpassword_confirmation" id="newpassword_confirmation">
					<?php if($errors->has('newpassword_confirmation')): ?>
					<span class="help-block">
						<strong><?php echo e($errors->first('newpassword_confirmation')); ?></strong>
					</span>
					<?php endif; ?>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Change Password" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#changePasswordPanel').toggle();
		$('#changePasswordBtn').click(function(){
			$('#changePasswordPanel').toggle();
			location.href = "#";
			location.href = "#changePasswordPanel";
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>