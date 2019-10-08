@extends('layout.admin')
@section('content')
    <section role="main" class="content-body">
            <header class="page-header">
                <h2>Add Sub Sub Category</h2>
                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="index.html">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Sub Sub Category</span></li>
                        <li><span> Add</span></li>
                    </ol>
            
                    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>

            <!-- start: page -->
                <div class="row">
                    <div class="col-xs-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                    <a href="#" class="fa fa-caret-down"></a>
                                    <a href="#" class="fa fa-times"></a>
                                </div>
                                <h2 class="panel-title">Sub Sub Category Add</h2>
                            </header>
                            <div class="panel-body">
                            <form class="form-horizontal form-bordered" method="POST" action='{{ URL("admin/subsubcategory/$sscat->id") }}' enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Category</label>
                                        <div class="col-md-6">
                                            <select class="form-control populate" name="category" id="category" >
                                                <option value="">Select Category</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" <?php if($sscat->category == $cat->id) {  echo "selected"; } ?>  >{{ $cat->category }}</option>
                                                @endforeach
                                             </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-md-3 control-label">Sub Category</label>
                                            <div class="col-md-6">
                                                <select class="form-control populate" id="subcategory_records" name="subcategory" >
                                                    <option value="">Sub Category</option>
                                                    @foreach ($subcategories as $subcat)
                                                        <option value="{{ $subcat->id }}" <?php if($sscat->subcategory == $subcat->id ){ echo "selected"; } ?>>{{ $subcat->subcategory }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Sub Sub category</label>
                                        <div class="col-md-6">
                                        <input type="text" autocomplete="off" class="form-control" name="subsubcategory"  value="{{  $sscat->subsubcategory }}" placeholder="Sub SUb Category" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Sub Sub category Image</label>
                                        <div class="col-md-6">
                                            <input type="file" class="form-control" name="subsubcategoryimage"  style="margin-bottom: 30px;">
                                        <img src='{{ url("subsubcategory/$sscat->subsubcategoryimage") }}' width="120px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="inputDisabled"></label>
                                        <input type="submit" class="btn btn-primary col-md-1" name="submit"  style="margin-right: 16px;">
                                        <button  class="btn btn-primary col-md-1" name="Cancel" >Cancel</button>
                                    </div>  
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            <!-- end: page -->
        </section>
    </div> 
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change', '#category', function() 
            {
                var cat_id = $('#category').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ url("admin/get_subcategory_data") }}',
                     data: {'cat':cat_id, "_token": "{{ csrf_token() }}"},
                    success: function(responce)
                    {
                        $("#subcategory_records").html(responce);
                    }
                });
            });
        });
    </script>
@endsection