@extends('layout.admin')   
@section('content')
<section role="main" class="content-body"> 
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Sub Category</h2>
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
                    <form class="form-horizontal form-bordered" method="post" action="{{ url('admin/subcategory') }}"  enctype="multipart/form-data">
                    @csrf   
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Category</label>
                            <div class="col-md-6">
                                <select class="form-control" name="category" >
                                    <option>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Sub Category</label>
                            <div class="col-md-6">
                                <input type="text" autocomplete="off" class="form-control" value="{{ old('subcategory') }}" name="subcategory" required>
                                <span style="color: red;">{{ $errors->first('subcategory')}}</span> 
                             </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Sub Category Image</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="subcategoryimage" required>
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