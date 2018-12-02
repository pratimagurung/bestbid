<?php echo $__env->make('partition.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('partition.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('body'); ?>

<?php echo $__env->make('partition.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>