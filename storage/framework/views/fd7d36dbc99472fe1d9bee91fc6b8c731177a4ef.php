<?php echo $__env->make('partitions.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partitions.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('body'); ?>

<?php echo $__env->make('partitions.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>