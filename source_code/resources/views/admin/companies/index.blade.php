

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

                                                <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" 
                                                checked value="{{$comp->id}}" />
                                                @elseif($comp->status_id == 4)                                           
                                                <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" value="{{$comp->id}}" />

                                                @else

                                                <input type="checkbox" disabled="true" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" 
                                                checked value="{{$comp->id}}" />

                                                @endif
                                            </td>
                                            <td>
                                                @if ($comp->status_id == 7)
                                                <button type="button" class="btn btn-default btn-approve" value = "{{$comp->id}}">
                                                    {{-- <input type="hidden" name="" class="hidden-company-id" value="{{$comp->id}}"> --}}
                                                    <span class="glyphicon glyphicon-globe"></span> Xác nhận
                                                </button>
                                                @endif

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

    $('.switch').bootstrapSwitch({
        size: 'small',
        onText: 'Bật',
        offText: 'Tắt'      
    });

    $('.btn-approve').click(function() {

     var currentelement = $(this);

     $.confirm({
        title: 'Thông báo!!',
        content: 'Bạn có muốn xác nhận công ty này?',
        buttons: {
            Có: {
                keys: ['enter'],
                btnClass: 'btn-green',
                action: function(){
                    approveCompany(currentelement);
                }
            },
            Không: {
                keys: ['esc'],
                btnClass: 'btn-red'              
            }

        }


    });

 });


    $('.status-switch').on('switchChange.bootstrapSwitch', function (e, data) {

        var element = $(this);

        element.bootstrapSwitch('state', !data, true);

        $.confirm({
            title: 'Thông báo!!',
            content: 'Bạn có muốn thay đổi trạng thái của công ty này?',
            buttons: {
                Có: {
                    keys: ['enter'],
                    btnClass: 'btn-green',
                    action: function(){
                        activeCompany(element.val());
                        element.bootstrapSwitch('toggleState', true, true);
                    }
                },
                Không: {
                    keys: ['esc'],
                    btnClass: 'btn-red'

                }

            }
        });
    });


    function alertError(){
     $.alert({
        title: 'Thông báo!',
        content: 'Đã có lỗi xảy ra, vui lòng reload lại trang.',
    });
 }
    // getCompanies();

    function activeCompany(id){
        $('.modal-ajax-loading').show();

        $.ajax({
            url: 'company/active/' + id,
            type: 'GET',
            dataType: 'json',

            success: function(){
               $('.modal-ajax-loading').hide();

           },
           error: function(){
               $('.modal-ajax-loading').hide();
               alertError();
           }            
       });
    }

    function approveCompany(element){
        $('.modal-ajax-loading').show();
        $.ajax({
            url: 'company/approve/' + element.val(),
            type: 'GET',
            dataType: 'json',
            success: function(){
                $('.modal-ajax-loading').hide();
               // location.reload();
               element.remove();
               $("input[value='" + element.val() + "']" ).attr({
                   disabled: true
               });
           },
           error: function(){
            $('.modal-ajax-loading').hide();
            alertError();
        }            
    });
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

