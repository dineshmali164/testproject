@extends('layout.admin')   
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- start: page -->
<section role="main" class="content-body"> 
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
                            <a class="btn btn-primary" href="{!!'category/create'!!}">Add Category</a>
                    </div>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Category</th>
                                <th>Category image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>      
                            <?php $i=0; ?>
                            @foreach($categories as $cat)
                                <tr class="gradeC">
                                    <td><?php echo ++$i;  ?></td>
                                    <td>{{ $cat->category }}</td>
                                    <td><img src='{{ url("category/$cat->category_image") }}' width="90"></td>
                                    <td>
                                        <input data-id="{{$cat->id}}" class="toggle-class switch" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $cat->status ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-circle" href='{{ url("admin/category/{$cat->id}/edit") }}' >EDIT</a>
                                        <form  onclick="return confirm('Are you sure you want to delete this item?');"  action='{{ url("admin/category/{$cat->id}") }}' method="post">
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
<script>
     
    $(function(){
        $('.toggle-class').change(function() {
             var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
          
            $.ajax({
                type:'POST',
                url:'categorystatus',
                data: {"status":status,"user_id":user_id,"_token": "{{ csrf_token() }}"},
                success:function(data) {
                    // alert(data);
                    // console.log(data);
                    // $("#msg").html(data.msg);
                }
            });
        });
    });	
</script>
@endsection