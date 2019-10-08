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
                    <li><span>Producty</span></li>
                    <li><span> View</span></li>
                </ol>
        
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                         
                        <div class="col-md-3">
                            <h2 class="panel-title">Product</h2>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                                <a class="btn btn-primary" href="{!!'product/create'!!}">Add Product</a>
                        </div>
                    </header>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="panel-body">
                        <table class="table table-bordered table-striped mb-none"  style="overflow-y: auto;" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Product Name</th>
                                    <th>Product image</th>
                                    <th>Product Price</th>
                                    <th>Product Offer Price</th>
                                    <th>Product Qty</th>
                                    <th>Product Weight</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Sub Category image</th>
                                    <th>type</th>
                                    <th>Brand</th>
                                    <th>Product Description</th>
                                    <th>Product Gst</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>      
                                <?php $i=0;  ?>
                                @foreach($products as $product)
                                    <tr class="gradeC">
                                        <td><?php echo ++$i;  ?></td>
                                        <td>{{ $product->product_name }}</td>
                                        <td><img src='{{ url("product/$product->product_image")}}' width="90" ></td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->product_offer_price }}</td>
                                        <td>{{ $product->product_qty }}</td>
                                        <td>{{ $product->product_weight }}</td>
                                        <td>{{ $product->category }}</td>
                                        <td>{{ $product->subcategory }}</td>
                                        <td>{{ $product->subsubcategory }}</td>
                                        <td>{{ $product->type }}</td>
                                        <td>{{ $product->brand }}</td>
                                        <td>{{ $product->product_description }}</td>
                                        <td>{{ $product->product_gst }}</td>
                                         {{-- <td>
                                            <input data-id="{{$type->id}}" class="toggle-class switch" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $subcat->status ? 'checked' : '' }} >
                                        </td> --}}
                                        <td>
                                            <a class="btn btn-success btn-circle" href='{{ url("admin/product/{$product->id}/edit") }}' >EDIT</a>
                                            <form  onclick="return confirm('Are you sure you want to delete this item?');"  action='{{ url("admin/product/{$product->id}") }}' method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
@endsection