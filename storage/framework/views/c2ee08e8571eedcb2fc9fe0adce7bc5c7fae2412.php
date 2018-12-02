<?php $__env->startSection('title','Best Bid'); ?>

<?php $__env->startSection('body'); ?>
<div class="container">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Add Product
                </div>
                <div class="panel-body">
                  <?php if(count($errors)): ?>
                  <div class="alert alert-danger">
                    <ul>
                     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <li> <?php echo e($error); ?> </li>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                   </ul>
                 </div>
                 <?php endif; ?>
                 <form method="post" action="<?php echo e(url('/product')); ?>" enctype="multipart/form-data">
                  <?php echo e(csrf_field()); ?>

                  <div class="form-group">
                    Product Name
                    <input class="form-control" type="text" name="name">
                  </div>
                  <div class="form-group">
                    Description
                    <input class="form-control" type="text" name="description">
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        Category
                        <select id="category_id" name="category_id" class="form-control">
                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($category->id); ?>"><?php echo e($category->categoryname); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        Sub Category
                        <select id="subcategory_id" name="subcategory_id" class="form-control">
                          <option></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    Product Image 
                    <input type="file" name="image" class="form-control">
                  </div>
                  <div class="form-group">
                    <input type="submit" name="submit" value="Add Product" class="btn btn-primary">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    getSubCategories();

    $("#category_id").change(function(){
      getSubCategories();
    });

    function getSubCategories(){
      var categoryId = $("#category_id option:selected").val();
      $.getJSON("<?php echo e(url('/category')); ?>/"+categoryId,function(data){
        $("#subcategory_id").find('option').remove();
        $.each(data,function(){
          $("#subcategory_id").append('<option value="'+this.id+'">'+this.name+'</option>');
        });
      });
    }
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>