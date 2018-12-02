@extends('partitions.master')

@section('title','Best Bid')

@section('body')
<div class="container">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">
                  Add Product
                </div>
                <div class="panel-body">
                  @if(count($errors))
                  <div class="alert alert-danger">
                    <ul>
                     @foreach($errors->all() as $error)
                     <li> {{ $error }} </li>
                     @endforeach 
                   </ul>
                 </div>
                 @endif
                 <form method="post" action="{{ url('/product') }}" enctype="multipart/form-data">
                  {{ csrf_field() }}
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
                          @foreach($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->categoryname }}</option>
                          @endforeach
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
      $.getJSON("{{ url('/category') }}/"+categoryId,function(data){
        $("#subcategory_id").find('option').remove();
        $.each(data,function(){
          $("#subcategory_id").append('<option value="'+this.id+'">'+this.name+'</option>');
        });
      });
    }
  });
</script>
@endsection
