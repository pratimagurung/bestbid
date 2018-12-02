<?php $__env->startComponent('mail::message'); ?>
# Hey there <?php echo e($auction->auction_seller->firstname); ?>,

Your auction has ended on BestBid. Unfortunately, no one placed a bid and thus, your auction has no winner.

	You may consider the following strategies while creating an auction next time:
	- Describe your product with as much detail as possible.
	- Upload a clear picture of the product.

You can restart the auction at any time you like.

<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/auction/'.$auction->id]); ?>
View Auction
<?php echo $__env->renderComponent(); ?>

<?php $__env->startComponent('mail::button', ['url' => config('app.url').'/products']); ?>
View Products
<?php echo $__env->renderComponent(); ?>

Thanks,

<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
