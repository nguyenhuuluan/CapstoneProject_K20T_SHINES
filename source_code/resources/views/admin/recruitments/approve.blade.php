@extends('layouts.admin')


@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.css')}}">
<!-- DataTables Responsive CSS -->
<link href="{{asset('assets/vendors/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">
<!-- Toggle CSS Button -->
<link href="{{asset('assets/dist/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
{{-- bootstrap switch --}}
<link href="{{asset('assets/vendors/bootstrap-switch/bootstrap-switch.css')}}" rel="stylesheet">
@endsection


@section('body')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách tin tuyển dụng đang chờ xác nhận</h1>
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

                                            <th>ID</th>
                                            <th>Tiêu đề</th>
                                            <th>Lương</th>
                                            <th>Ngày hết hạn</th>
                                            <th>Công ty</th>             
                                            <th>Ngày tạo</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recruitments as $recruitment)
                                        <tr>
                                            <td>{{$recruitment->id}}</td>
                                            <td>{{$recruitment->title}}</td>
                                            <td>{{$recruitment->salary}}</td>
                                            <td>{{$recruitment->expire_date}}</td>
                                            <td>{{$recruitment->company->name}}</td>
                                            <td>{{$recruitment->created_at}}</td>
                                            <td>
                                                <button type="button" class="btn btn-default btn-xs btn-approve" value = "{{$recruitment->id}}">
                                                    <span class="glyphicon glyphicon-globe"></span> Xác nhận
                                                </button>
                                                <a href=" {{ route('admin.recruitments.show', $recruitment->slug) }}" class="btnreview btn-success" target="_blank" style="display: inline-block;">Xem</a>
                                            </td>                                          
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


    <!-- DataTables JavaScript -->
    <script src="{{asset('assets/vendors/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables-responsive/dataTables.responsive.js')}}"></script>
    {{-- boostrap switch --}}
    <script src="{{asset('assets/vendors/bootstrap-switch/bootstrap-switch.js')}}"></script>
    <!-- Toggle JavaScript Button -->
    <script src="{{asset('assets/js/bootstrap-toggle.min.js')}}"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    {{-- using jquery modal confirm JS --}}
    <script src="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.js')}}"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script type="text/javascript">

       $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
       
       $('.btn-approve').click(function() {

           var currentelement = $(this);

           $.confirm({
            title: 'Thông báo!!',
            content: 'Bạn có muốn xác nhận tin tuyển dụng này?',
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

       function approveCompany(element){
        $('.modal-ajax-loading').fadeIn("200");
        $.ajax({
            url: '../recruitments/approve/' + element.val(),
            type: 'GET',
            dataType: 'json',
            success: function(){
                $('.modal-ajax-loading').fadeOut("200");
                $.alert({
                    title: 'Thông báo!',
                    content: 'Xác nhận thành công',
                });
                element.parent().parent().remove();

               //location.reload();
               //element.remove();
               // $("input[value='" + element.val() + "']" ).attr({
               //     disabled: true
               // });
           },
           error: function(){
            $('.modal-ajax-loading').hide();
            alertError();
        }            
    });
    }


</script>
@endsection

