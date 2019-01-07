<?php $__env->startSection('title','Login'); ?>

<?php $__env->startSection('body'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('firstname') ? ' has-error' : ''); ?>">
                        <label for="firstname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="<?php echo e(old('firstname')); ?>" required autofocus>

                                <?php if($errors->has('firstname')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('firstname')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('lastname') ? ' has-error' : ''); ?>">
                            <label for="lastname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="<?php echo e(old('lastname')); ?>" required>

                                <?php if($errors->has('lastname')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('lastname')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="<?php echo e(old('address')); ?>" required>

                                <?php if($errors->has('address')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('address')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('contact') ? ' has-error' : ''); ?>">
                            <label for="contact" class="col-md-4 control-label">Contact Number</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact" value="<?php echo e(old('contact')); ?>" required>

                                <?php if($errors->has('contact')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('contact')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('gender') ? ' has-error' : ''); ?>">
                            <label for="gender" class="col-md-4 control-label">Gender</label>
                            <div class="col-md-6">
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input id="gender" type="radio" name="gender" value="Male" checked="checked">Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input id="gender" type="radio" name="gender" value="Female">Female
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input id="gender" type="radio" name="gender" value="Other">Others
                                    </label>
                                </div>

                                <?php if($errors->has('gender')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('gender')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>