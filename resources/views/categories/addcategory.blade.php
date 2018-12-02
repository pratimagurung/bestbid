@extends('partitions.master')

@section('title','Add Category')

@section('body')
@if(Session::has('message'))
<div class="alert alert-info">
  {{ Session::get('message') }}
</div>
@endif

@if(count($errors))
<div class="alert alert-danger">
  <ul>
   @foreach($errors->all() as $error)
   <li> {{ $error }} </li>
   @endforeach 
 </ul>
</div>
@endif
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        Add Category
      </div>
      <div class="panel-body">
       <form method="post" action="{{ url('/category') }}">
        {{ csrf_field() }}
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
     <form method="post" action="{{ url('/subcategory') }}">
      {{ csrf_field() }}
      <div class="form-group">
        Sub Category Name
        <input class="form-control" type="text" name="name">
      </div>
      <div class="form-group">
        In Category:
        <select class="form-control" name="category">
          @foreach($categories as $category)
          <option value="{{ $category->id }}">{{ $category->categoryname }}</option>
          @endforeach
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
        @foreach($categories as $category)
        <tr>
          <td>{{ $category->categoryname }}</td>
          <td><a href="#" id="editCategoryBtn" data-catid="{{ $category->id }}" data-catname="{{ $category->categoryname }}" data-toggle="modal" data-target="#editCategoryModal" data- class="btn btn-warning">Edit</a><a id="deleteCategoryBtn" data-catid="{{ $category->id }}" data-catname="{{ $category->categoryname }}" data-toggle="modal" data-target="#deleteCategoryModal" href="#" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach
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
        @foreach($subCategories as $subCategory)
        <tr>
          <td>{{ $subCategory->name }}</td>
          <td>{{ $subCategory->category->categoryname }}</td>
          <td><a id="editSubCategoryBtn" href="#" data-subcatid="{{ $subCategory->id }}" data-subcatname="{{ $subCategory->name }}" data-toggle="modal" data-target="#editSubCategoryModal" class="btn btn-warning">Edit</a><a id="deleteSubCategoryBtn" href="#" data-subcatid="{{ $subCategory->id }}" data-subcatname="{{ $subCategory->name }}" data-toggle="modal" data-target="#deleteSubCategoryModal" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach
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
        <form method="post" action="{{ url('/category/edit') }}">
          {{ csrf_field() }}
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
        <form method="post" action="{{ url('/category/delete') }}">
          {{ csrf_field() }}
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
        <form method="post" action="{{ url('/subcategory/edit') }}">
          {{ csrf_field() }}
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
        <form method="post" action="{{ url('/subcategory/delete') }}">
          {{ csrf_field() }}
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
@endsection
