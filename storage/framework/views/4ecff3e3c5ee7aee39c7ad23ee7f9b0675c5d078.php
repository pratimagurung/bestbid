<?php $__env->startComponent('mail::message'); ?>
# Congratulations!!

Your auction has a winner on BestBid!

Message from Winner: <?php echo e($message); ?>


<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/auction/'.$auction->id]); ?>
View Auction
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/contact/winner/'.$auction->id]); ?>
Contact Winner
<?php echo $__env->renderComponent(); ?>

Thanks,

<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
