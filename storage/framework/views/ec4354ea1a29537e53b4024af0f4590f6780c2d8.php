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
        <th>Actions</th>
      </thead>
      <tbody>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($category->categoryname); ?></td>
          <td><a href="#" id="editCategoryBtn" data-catid="<?php echo e($category->id); ?>" data-catname="<?php echo e($category->categoryname); ?>" data-toggle="modal" data-target="#editCategoryModal" data- class="btn btn-warning">Edit</a><a id="deleteCategoryBtn" data-catid="<?php echo e($category->id); ?>" data-catname="<?php echo e($category->categoryname); ?>" data-toggle="modal" data-target="#deleteCategoryModal" href="#" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
    <table class="table table-striped">
      <thead>
        <th>Sub Category</th>
        <th>In Category</th>
        <th>Actions</th>
      </thead>
      <tbody>
        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($subCategory->name); ?></td>
          <td><?php echo e($subCategory->category->categoryname); ?></td>
          <td><a id="editSubCategoryBtn" href="#" data-subcatid="<?php echo e($subCategory->id); ?>" data-subcatname="<?php echo e($subCategory->name); ?>" data-toggle="modal" data-target="#editSubCategoryModal" class="btn btn-warning">Edit</a><a id="deleteSubCategoryBtn" href="#" data-subcatid="<?php echo e($subCategory->id); ?>" data-subcatname="<?php echo e($subCategory->name); ?>" data-toggle="modal" data-target="#deleteSubCategoryModal" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </div>
</div>
<div id="editCategoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Category</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo e(url('/category/edit')); ?>">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="catId" id="catId" value="">
          <div class="form-group">
            <label>Current Category Name</label>
            <input type="text" id="oldCatName" value="" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label>New Category Name</label>
            <input type="text" id="newCatName" name="newCatName" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Edit" class="btn btn-success">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="deleteCategoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Category</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo e(url('/category/delete')); ?>">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="catId" id="catId" value="">
          <div class="form-group">
            <p>Are you sure you want to delete this category (<span id="oldCatName"></span>) ?</p> <p class="text-danger">WARNING: All sub categories under this category will be deleted!</p>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="editSubCategoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Sub Category</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo e(url('/subcategory/edit')); ?>">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="subCatId" id="subCatId" value="">
          <div class="form-group">
            <label>Current Sub Category Name</label>
            <input type="text" id="oldSubCatName" value="" class="form-control" disabled>
          </div>
          <div class="form-group">
            <label>New Sub Category Name</label>
            <input type="text" id="newSubCatName" name="newSubCatName" class="form-control">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Edit" class="btn btn-success">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="deleteSubCategoryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Sub Category</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo e(url('/subcategory/delete')); ?>">
          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="subCatId" id="subCatId" value="">
          <div class="form-group">
            <label>Are you sure you want to delete this sub category (<span id="oldSubCatName"></span>) ?</label>
          </div>
          <div class="form-group">
            <input type="submit" name="submit" value="Delete" class="btn btn-danger">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).on('click', '#editCategoryBtn', function(){
    var catName = $(this).data('catname');
    var catId = $(this).data('catid');
    $('#catId').val(catId);
    $('#oldCatName').val(catName);
  });
  $(document).on('click', '#deleteCategoryBtn', function(){
    var catName = $(this).data('catname');
    var catId = $(this).data('catid');
    $('#deleteCategoryModal #catId').val(catId);
    $('#deleteCategoryModal #oldCatName').text(catName);
  });
  $(document).on('click', '#editSubCategoryBtn', function(){
    var subCatName = $(this).data('subcatname');
    var subCatId = $(this).data('subcatid');
    $('#subCatId').val(subCatId);
    $('#oldSubCatName').val(subCatName);
  });
  $(document).on('click', '#deleteSubCategoryBtn', function(){
    var subCatName = $(this).data('subcatname');
    var subCatId = $(this).data('subcatid');
    $('#deleteSubCategoryModal #subCatId').val(subCatId);
    $('#deleteSubCategoryModal #oldSubCatName').text(subCatName);
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('partitions.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>