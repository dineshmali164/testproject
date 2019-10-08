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
                            <a class="btn btn-primary" href="{!!'subcategory/create'!!}">Add Category</a>
                    </div>
                </header>
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
                            @foreach($subcategories as $subcat)
                                <tr class="gradeC">
                                    
                                    <td><?php echo ++$i;  ?></td>
                                    <td>{{ $subcat->category }}</td>
                                    <td>{{ $subcat->subcategory }}</td>
                                    <td><img src='{{ url("subcategory/$subcat->subcategoryimage")}}' width="90" ></td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" data-id="{{$subcat->id}}"  class="subcatestatus" <?php if( $subcat->status == 1){ echo "checked"; } ?>>
                                            <span class="slider round"></span>
                                        </label>                                          
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-circle" href='{{ url("admin/subcategory/{$subcat->id}/edit") }}' >EDIT</a>
                                        <form  onclick="return confirm('Are you sure you want to delete this item?');"  action='{{ url("admin/subcategory/{$subcat->id}") }}' method="post">
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

</section>

<script type="text/javascript">
    $(document).ready(function(){
        $(".subcatestatus").change(function(){   
            var status  = $(this).is(":checked")? 1 : 0;
            var subcat_id = $(this).data('id'); 
            $.ajax({
                type: 'POST',
                url: '{{ url("admin/subcatstatus") }}',
                data: {"status":status,"subcat_id":subcat_id,"_token":"{{ csrf_token()}}"},
                success:function(responce){
                }
            });
        });
    });
</script>
