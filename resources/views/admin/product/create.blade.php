@extends('layout.admin')
@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Product</h2>
            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="index.html">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Product</span></li>
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
                            <h2 class="panel-title">Product Add</h2>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal form-bordered" method="POST" action='{{ url("admin/product") }}' enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="product_name"><b>Product Name</b></label>
                                    <div class="col-md-6">
                                            <input type="text" autocomplete="off" id="product_name" class="form-control" name="product_name"   value="{{ old('product_name') }}"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="product_price">Product Price</label>
                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" id="product_price" class="form-control" name="product_price"   value="{{ old('product_price') }}"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Product Offer Price</label>
                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" class="form-control" name="product_offer_price"   value="{{ old('product_offer_price') }}"  required>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Category</label>
                                    <div class="col-md-6">
                                        <select class="form-control populate" name="category" id="category" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                            @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sub Category</label>
                                    <div class="col-md-6">
                                        <select class="form-control populate" id="subcategory_records" name="subcategory" required>
                                            <option value="">Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Sub Sub Category</label>
                                    <div class="col-md-6">
                                        <select class="form-control populate" id="subsubcategory" name="subsubcategory" required>
                                            <option value="">Sub Sub Category</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Brand</label>
                                    <div class="col-md-6">
                                        <select class="form-control populate" id="brand" name="brand" required>
                                            <option value=""> Brand </option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Type</label>
                                    <div class="col-md-6">
                                        <select class="form-control populate" id="type" name="type" required >
                                            <option value=""> Type </option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Product Qty</label>
                                    <div class="col-md-6">
                                    <input type="text" autocomplete="off" class="form-control" name="product_qty"   value="{{ old('product_qty') }}"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Product Weight</label>
                                    <div class="col-md-6">
                                    <input type="text" autocomplete="off" class="form-control" name="product_weight"   value="{{ old('product_weight') }}"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Product Description</label>
                                    <div class="col-md-6">
                                    <textarea type="text" autocomplete="off" class="form-control" name="product_description"  required>{{ old('product_description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Product gst</label>
                                    <div class="col-md-6">
                                        <input type="text" autocomplete="off" class="form-control" name="product_gst"  required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">product Image</label>
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" name="product_image" required>
                                    </div>
                                </div>
                                {{--   <div class="form-group">
                                    <label class="col-md-3 control-label">product Multiple Image </label>
                                    <div class="col-md-6">
                                        <input type="file" class="form-control" name="productmimage" required multiple>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="inputDisabled"></label>
                                    <input type="submit" class="btn btn-primary col-md-1" name="submit"  style="margin-right: 16px;">
                                <a href='{{ url("admin/product") }}'  class="btn btn-primary col-md-1" name="Cancel" >Cancel</a>
                                </div>  
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        <!-- end: page -->
    </section>
</div>
    
    <script product="text/javascript">
         
        $(document).ready(function(){
            $(document).on('change', '#category', function() 
            {
                var cat_id = $('#category').val();
                 $.ajax({
                    type: 'POST',
                    url: '{{ url("admin/product_subcategory_data") }}',
                    data: {'cat':cat_id, "_token": "{{ csrf_token() }}"},
                    success: function(responce)
                    { 
                        // alert(responce);
                        $("#subcategory_records").html(responce);
                    }
                });
            });
            $(document).on('change','#subcategory_records',function()
            {
                var subcat_id  = $('#subcategory_records').val();
                $.ajax({
                    type: 'POST',
                    url: '{{ url("admin/product_subsubcategory_data") }}',
                    data: {'subcat':subcat_id, "_token":"{{ csrf_token() }}"},
                    success: function(responce)
                    {
                        // alert(responce);
                        $('#subsubcategory').html(responce);
                    }
                });
            });
        });
    </script>
@endsection