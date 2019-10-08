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
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>
                        <div class="col-md-3">
                            <h2 class="panel-title">Category</h2>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                                <a class="btn btn-primary" href="{!!'subsubcategory/create'!!}">Add Category</a>
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
                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Sub Category image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>      
                                <?php $i=0; ?>
                                @foreach($sscat as $subsubcat)
                                    <tr class="gradeC">
                                        <td><?php echo ++$i;  ?></td>
                                        <td>{{ $subsubcat->category }}</td>
                                        <td>{{ $subsubcat->subcategory }}</td>
                                        <td>{{ $subsubcat->subsubcategory }}</td>
                                        <td><img src='{{ url("subsubcategory/$subsubcat->subsubcategoryimage")}}' width="90" ></td>
                                        {{-- <td>
                                            <input data-id="{{$subcat->id}}" class="toggle-class switch" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $subcat->status ? 'checked' : '' }} >
                                        </td> --}}
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" data-id="{{$subsubcat->id}}"  class="subsubcatstatus" <?php if($subsubcat->status == 1){ echo "checked"; } ?>>
                                                <span class="slider round"></span>
                                            </label>                                          
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-circle" href='{{ url("admin/subsubcategory/{$subsubcat->id}/edit") }}' >EDIT</a>
                                            <form  onclick="return confirm('Are you sure you want to delete this item?');"  action='{{ url("admin/subsubcategory/{$subsubcat->id}") }}' method="post">
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".subsubcatstatus").change(function(){
            var status = $(this).is(":checked")? 1 : 0 ;
            var subsubcat_id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '{{ url("admin/subsubcatstatus") }}',
                data: {"status":status,"subsubcat_id":subsubcat_id,"_token":"{{csrf_token()}}"},
                success:function(responce){
                        alert(responce);
                }
            });
        });
    });
</script>
@endsection