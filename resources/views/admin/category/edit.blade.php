@extends('layout.admin')   
@section('content')
<section role="main" class="content-body"> 
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Category</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" method="post" action='{{ url("admin/category/$category->id" )}}' enctype="multipart/form-data">
                    @csrf   
                    @method('put')
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Category</label>
                            <div class="col-md-6">
                                <input type="text"  autocomplete="off"  class="form-control" name="category" value="{{ $category->category}}"  required>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Category Image</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="categoryimage" required>
                                <img src='{{ url("category/$category->category_image") }}' class="p-2" width="90">
                            </div>
                        </div>  
                       
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDisabled"></label>
                            <input type="submit" class="btn btn-primary col-md-1" name="submit" >
                        </div>          
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>
 
@endsection