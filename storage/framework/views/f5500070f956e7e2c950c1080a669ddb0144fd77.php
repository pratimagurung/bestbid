<?php $__env->startComponent('mail::message'); ?>
# Congratulations!!

You have won an auction on BestBid!

Message from Seller: <?php echo e($message); ?>


<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/auction/'.$auction->id]); ?>
View Auction
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/contact/seller/'.$auction->id]); ?>
Contact Seller
<?php echo $__env->renderComponent(); ?>

Thanks,

<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
