

@extends('layouts.admin')

@section('body')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách công ty</h1>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>

                                            <th>Tên</th>                                          
                                            <th>Điện thoại</th>
                                            <th>Website</th>
                                            <th>Email</th>                                        
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comps as $comp)
                                        <tr>
                                            <td>{{$comp->name}}</td>
                                            <td>{{$comp->phone}}</td>
                                            <td><a href="{{$comp->website}}">{{$comp->website}}</a></td>
                                            <td>{{$comp->email}}</td>
                                            <td>{{$comp->created_at}}</td>
                                            <td>                                               
                                                @if ($comp->status_id == 3)
                                                <input id="something" type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-size="mini" value="{{$comp->id}}">
                                                @else
                                                <input id="something" type="checkbox" data-toggle="toggle" data-onstyle="success" data-size="mini" value="{{$comp->id}}">
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btnreview btn-success">Xem</button>
                                            </td>
                                            
                                        </tr>
                                        @endforeach



                                    </tbody>

                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>



@endsection

@section('scripts')
<script type="text/javascript">

    $('#something').change(function() {
        var r = confirm("Are you sure");
        var valueid = $('#something').val(); 
        if (r == true) {
            confirmconpany(valueid);
        } else {
            alert('123');
        }
    });

    // getCompanies();

    function confirmconpany(id){
        $.ajax({
            url: 'localhost:9999/CapstoneProject_K20T_SHINES/source_code/public/test/' + id,
            type: 'GET',
            dataType: 'json'
            
        }
        );

    }

    function getCompanies(){

        $('#dataTables-example').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{Route('getcompanies')}}',
            columns:[
            {data:'name'},
            {data:'phone'},
            {data:'website'},
            {data:'email'},
            {data:'created_at'},

            {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    }

</script>
@endsection

