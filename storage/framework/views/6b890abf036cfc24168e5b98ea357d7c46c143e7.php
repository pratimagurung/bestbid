<?php if(Auth::check()): ?>
<div id="notifications" class="modal notificationModal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Notifications</h4>
			</div>
			<div class="modal-body">
				<?php $__currentLoopData = auth()->user()->latestNotifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(!$notification->seen): ?>
				<div class="bg-success">
					<?php endif; ?>
					<?php if($notification->type=="winner"): ?>
					You have won an auction! <a href="<?php echo e(url('/auction/'.$notification->auction->id)); ?>" class="btn btn-primary">View Auction</a>
					<?php elseif($notification->type=="seller"): ?>
					You auction has a winner! <a href="<?php echo e(url('/auction/'.$notification->auction->id)); ?>" class="btn btn-primary">View Auction</a>
					<?php else: ?>
					You auction has ended with no bids! <a href="<?php echo e(url('/auction/'.$notification->auction->id)); ?>" class="btn btn-primary">View Auction</a>
					<?php endif; ?>
					<?php if(!$notification->seen): ?>
				</div>
				<?php endif; ?>
				<hr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#notifications').on('shown.bs.modal',function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.post("<?php echo e(url('/notification/update')); ?>",{
			user_id: "<?php echo e(auth()->user()->id); ?>"
		},function(data,status){
			console.log('notifications updated');
		});
	});
</script>
<?php endif; ?>