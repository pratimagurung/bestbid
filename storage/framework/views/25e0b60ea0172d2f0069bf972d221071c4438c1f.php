<?php $__env->startSection('title','Add Category'); ?>

<?php $__env->startSection('body'); ?>
<?php if(Session::has('message')): ?>
<div class="alert alert-info">
  <?php echo e(Session::get('message')); ?>

</div>
<?php endif; ?>

<?php if(count($errors)): ?>
<div class="alert alert-danger">
  <ul>
   <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <li> <?php echo e($error); ?> </li>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
 </ul>
</div>
<?php endif; ?>
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        Add Category
      </div>
      <div class="panel-body">
       <form method="post" action="<?php echo e(url('/category')); ?>">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
          Category Name
          <input class="form-control" type="text" name="name">
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="panel panel-default">
    <div class="panel-heading">
      Add SubCategory
    </div>
    <div class="panel-body">
     <form method="post" action="<?php echo e(url('/subcategory')); ?>">
      <?php echo e(csrf_field()); ?>

      <div class="form-group">
        Sub Category Name
        <input class="form-control" type="text" name="name">
      </div>
      <div class="form-group">
        In Category:
        <select class="form-control" name="category">
          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($category->id); ?>"><?php echo e($category->categoryname); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>
      <div class="form-group">
        <input type="submit" name="submit" value="Add Sub Category" class="btn btn-primary">
      </div>
    </form>
  </div>
</div>
</div>
</div>
<div class="row">
  <div class="col-md-6">
    <table class="table table-striped">
      <thead>
        <th>Category</th>
        <th>Sub Categories</th>
        <th>Actions</th>
      </thead>
      <tbody>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($category->categoryname); ?></td>
          <td>
            <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($subcategory->name); ?> ,
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <td><a href="#" class="btn btn-warning">Edit</a></td>
            <td><a href="#" class="btn btn-danger">Delete</a></td>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partition.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>