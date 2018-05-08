@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.css')}}">

<!-- DataTables CSS -->
{{-- <link href="{{asset('assets/vendors/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet"> --}}

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
                <h1 class="page-header">Danh sách tài khoản Staff</h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table width="100%" class="table table-striped table-hover" id="staff_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>SĐT</th>
                                        <th>Tài khoản</th>                                       
                                        <th>Ngày tạo</th> 
                                        <th>Trạng thái</th>                                       
                                        <th>Phân quyền</th>                                       
                                        <th>Thao tác</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $staff)
                                    <tr>
                                        <td class="id" data-id="{!! $staff->id !!}">{!! $staff->id !!}</td>
                                        <td class="name" data-name="{!! $staff->name !!}">{!! $staff->name !!}</td>
                                        <td class="phone" data-phone="{!! $staff->phone !!}">{!! $staff->phone !!}</td>
                                        <td class="username" data-username="{!! $staff->account->username !!}">{!! $staff->account->username !!}</td>
                                        <td>{!! $staff->created_at !!}</td>
                                        <td>
                                            @if ($staff->account->status_id == 5)
                                            <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" checked value="{{$staff->account->status_id}}" />
                                            @else
                                            <input type="checkbox" disabled="true" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" 
                                            checked value="{{$staff->account->status_id}}" />
                                            @endif
                                        </td>
                                        <td><a href="#" class="btn btn-xs btn-warning list" id="{!! $staff->id !!}">Danh sách</a></td>
                                        <td>
                                            <a href="#" class="btn btn-xs btn-primary edit" id="{!! $staff->id !!}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                                            <a href="#" class="btn btn-xs btn-danger delete" id="{!! $staff->id !!}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#lst_permission">Open Modal</button>

                    <div class="modal fade" id="lst_permission" role="dialog">
                        <form role="form" method="post" id="update_permission">
                          {{ csrf_field() }}
                          {{ method_field('PATCH') }}
                          <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content" style="width: auto;height: auto;">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h1 class="modal-title" style="text-align: center; color:green; font-weight: bold;">Cập nhật danh sách quyền</h1>
                              </div>
                              <div class="modal-body">
                                  <div class="row" id="permission_list">

                                  </div>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" name="staff_id" id="staff_id" value="" />
                                <input type="submit" name="submit" id="action" value="Cập nhật" class="btn btn-success" />
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>
        <!-- /.panel -->
    </div>
</div>
<!-- /.col-lg-12 -->
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
<script type="text/javascript" src="{{ asset('assets/js/alert.js') }}"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->



<script type="text/javascript">

   $(document).ready(function() {
       var table = $('#staff_table').DataTable({
        responsive: true
    });
       $('.switch').bootstrapSwitch({
        size: 'mini',
        onText: 'Bật',
        offText: 'Tắt'      
    });
       var status_loading = false;
            //Nhấn nút danhsach->show modal
            $(document).on('click', '.list', function(){
                if(!status_loading)
                {
                    console.log(status_loading);
                    status_loading = true;
                    ele = $(this).parent().parent();
                    var id = $(this).attr("id");
                    $('#form_output').html('');
                    var url = '{{ route("staffs.show", ":id") }}';
                    url = url.replace(':id', id);
                    list = $('#permission_list');
                    list.empty();
                    $.ajax({
                        url:url,
                        method:'get',
                // data:{id:id},
                // dataType:'json',
                success:function(data)
                {   
                     // $('#permission_list').append(JSON.parse(data)["recruitments"]);
                     // alert('success')
                     list.append(data);
                     $('#lst_permission').modal('show');
                     $('#staff_id').val(id);
                     status_loading = false;
                 },
                 error:function()
                 {
                   status_loading = false;
               }
           });
                    //end of ajax
                }
            });
            //end of show modal

            //submit form update
            $('#update_permission').on('submit', function(event){
               event.preventDefault();
               var form_data = $(this).serialize();
               console.log(form_data);
               alert('123');
           });




            $('.status-switch').on('switchChange.bootstrapSwitch', function (e, data) {

                var element = $(this);

                element.bootstrapSwitch('state', !data, true);

                $.confirm({
                    icon: 'fa fa-warning',
                    title: 'Cảnh báo!!',
                    content: 'Bạn có muốn thay đổi trạng thái của Tài khoản này?',
                    type: 'orange',
                    buttons: {
                        Có: {
                            keys: ['enter'],
                            btnClass: 'btn-green',
                            action: function(){
                                activeRecruitment(element.val());
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

            function activeRecruitment(id){
                $('.modal-ajax-loading').show();

                $.ajax({
                    url: 'recruitments/active/' + id,
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

        });








    </script>
    @endsection