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
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('body')
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Danh sách tài khoản Staff
        </h1>
      </div>
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <!-- /.panel-heading -->
          <div class="panel-body">
            <div align="right"><a href="#" class="btn btn-sm btn-success add" id=""><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm mới</a></div>
            <br>
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
                  <tr data-id="{!! $staff->id !!}">
                    <td class="id">{!! $staff->id !!}</td>
                    <td class="name">{!! $staff->name !!}</td>
                    <td class="phone">{!! $staff->phone !!}</td>
                    <td class="username" data-username="{!! $staff->account->username !!}">{!! $staff->account->username !!}</td>
                    <td>{!! $staff->created_at !!}</td>
                    <td>
                      @if ($staff->account->status_id == 5)
                      <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" checked value="{{$staff->account->status_id}}" />
                      @elseif($staff->account->status_id == 6)
                      <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" value="{{$staff->account->status_id}}" />
                      @endif
                    </td>
                    <td><a href="#" class="btn btn-xs btn-info list" id="{!! $staff->id !!}">Danh sách</a></td>
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

          <div class="modal fade" id="lst_permission" role="dialog">
            <form role="form" method="post" id="update_permission">
              {{ csrf_field() }}
              {{ method_field('PATCH') }}
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="width: auto;height: auto;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title alert alert-info update" style="text-align: center; font-weight: bold;">Cập nhật danh sách quyền</h2>
                  </div>
                  <div class="modal-body">
                    <div class="row" id="permission_list">

                    </div>
                  </div>

                  <div id="form_output"></div>

                  <div class="modal-footer">
                    <input type="hidden" name="button_action" id="button_action" value="permission"/>
                    <input type="hidden" name="status_id" id="status_id" value=""/>
                    <input type="hidden" name="staff_id" id="staff_id" value="" />
                    <input type="submit" name="submit" id="action" value="Update" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </form>
          </div>

          <div class="modal fade" id="create_staff" role="dialog">
            <form role="form" method="post" id="frm_create_staff">
              {{ csrf_field() }}
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="width: auto;height: auto;">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title alert alert-info" style="text-align: center">Tạo mới tài khoản</h2>
                  </div>
                  <div class="modal-body">
                    <div class="row" id="permission_list">
                      <div class="form-group col-lg-6 col-sm-12">
                        <label>Tên:</label>
                        <input type="text" name="name" id="name" class="form-control" value=""/>
                      </div>
                      <div class="form-group col-lg-6 col-sm-12">
                        <label>Điện thoại:</label>
                        <input type="text" name="phone" id="phone" class="form-control" value=""/>
                      </div>
                      <div class="form-group col-lg-6 col-sm-12">
                        <label>Email:</label>
                        <input type="text" name="email" id="email" class="form-control" value=""/>
                      </div>
                      <div class="form-group col-lg-12 col-sm-12">
                        <label>Tài khoản đăng nhập:</label>
                        <input type="text" name="account" id="account" class="form-control" value=""/>
                      </div>
                      <div class="form-group col-lg-12 col-sm-12">
                        <label>Mật khẩu:</label>
                        <input type="password" name="password" id="password" class="form-control" value=""/>
                      </div>
                    </div>
                  </div>

                  <div id="form_output_create"></div>

                  <div class="modal-footer">
                    <input type="hidden" name="staff_id" id="staff_id" value="" />
                    <button type="submit" class="btn btn-info">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
  var ele;
  var table = $('#staff_table').DataTable({
    responsive: true
  });
  var loading = $('.modal-ajax-loading');
  $(document).ajaxStart(function () {
    loading.fadeIn();
  });

  $(document).ajaxStop(function () {
    loading.fadeOut();
  });
  loadSwitch();
  function loadSwitch(){
    $('.switch').bootstrapSwitch({
      size: 'mini',
      onText: 'Bật',
      offText: 'Tắt'      
    });
  }

  var status_loading = false;
    //Nhấn nút danhsach->show modal
    $(document).on('click', '.list', function(){
      if(!status_loading)
      {
        status_loading = true;
        ele = $(this).parent().parent();
        var id = $(this).attr("id");
        $('#form_output').html('');
        $('#button_action').val('permission');
        var url = '{{ route("staffs.show", [":id","permission"]) }}';
        url = url.replace(':id', id);
        list = $('#permission_list');
        list.empty();
        $.ajax({
          url:url,
          method:'get',
          success:function(data)
          {   
           list.append(data);
           $('.modal-title.update').html('Cập nhật danh sách quyền');
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

  //Nhấn nút edit->show modal
  $(document).on('click', '.edit', function(){
    if(!status_loading)
    {
      status_loading = true;
      ele = $(this).parent().parent();
      var id = $(this).attr("id");
      $('#form_output').html('');
      var url = '{{ route("staffs.show", [":id","profile"]) }}';
      url = url.replace(':id', id);
      list = $('#permission_list');
      list.empty();
      $.ajax({
        url:url,
        method:'get',

        success:function(data)
        {   
         list.append(data);
         $('#button_action').val('profile');
         $('.modal-title.update').html('Cập nhật hồ sơ nhân viên');
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

  //Nhấn nút create->show modal
  $(document).on('click', '.add', function(){
    $('#create_staff').modal('show');

  });
  //end of show modal

  //Nhấn nút delete->confirm
  $(document).on('click', '.delete', function(){
    ele = $(this).parent().parent();
    var id = $(this).attr("id");
    var url = '{{ route("staffs.destroy", ":id") }}';
    url = url.replace(':id', id);
    var currentelement = $(this);
    $.confirm({
      icon: 'fa fa-warning',
      title: 'Cảnh báo!!',
      content: 'Bạn có chắc muốn xóa tài khoản này!',
      type:'red',
      buttons: {
        XacNhan: {
          text: 'Xác nhận',
          btnClass: 'btn-danger',
          keys: ['enter', 'shift'],
          action: function() {
            $.ajax({
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'delete',
            success: function(data){
              alertSuccess('Xóa thành công...')
              table.row(currentelement.parent().parent()).remove().draw();
            },
            error: function(data){
             alertError('Xóa không thành công ...');
           }            
         });
          },
        },
        Huy: {
          text: 'Hủy',
          btnClass: 'btn-default',
          keys: ['esc'],
        },
      },
    });
    //end of confirm
  });

    //submit form create
    $('#frm_create_staff').on('submit', function(event){
      event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "{{ route('staffs.store') }}",
        data: form_data,
        dataType: "json",
        success: function(data){
         if(data.error!=null && data.error.length > 0)
         {
          var error_html = '<div class="alert alert-danger">';
          for(var count = 0; count < data.error.length; count++)
          {
            error_html += '<ul><strong>'+data.error[count]+'</strong></ul>';
          }
          error_html += '</div>'
          $('#form_output_create').html(error_html);
        }
        else
        { 
          table.row.add( [
            data.success.id,
            data.success.name,
            data.success.phone,
            data.success.username,
            data.success.created_at,
            '<input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" checked value="'+data.success.id+'" />',
            '<a href="#" class="btn btn-xs btn-info list" id="'+data.success.id+'">Danh sách</a>',
            '<a href="#" class="btn btn-xs btn-primary edit" id="'+data.success.id+'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a> <a href="#" class="btn btn-xs btn-danger delete" id="'+data.success.id+'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>',
            ] ).node().id = data.success.id;
          table.draw(false);
          loadSwitch();
          $('#lst_permission').modal('hide');
          alertSuccess('Tạo mới tài khoản thành công!');
        }
      },
      error:function(data){
        alertError('Tạo mới tài khoản thất bại!');
      }
    });
    });

    //submit form update
    $('#update_permission').on('submit', function(event){
     event.preventDefault();
     var form_data = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "{{ route('staffs.update') }}",
      data: form_data,
      dataType: "json",
      success: function(data) {
        if(data.error!=null && data.error.length > 0)
        {
          var error_html = '<div class="alert alert-danger">';
          for(var count = 0; count < data.error.length; count++)
          {
            error_html += '<ul><strong>'+data.error[count]+'</strong></ul>';
          }
          error_html += '</div>'
          $('#form_output').html(error_html);
        }
        else
        {
          if(data.type =='profile')
          {
            ele.find("td.name").text(data.success.name);
            ele.find("td.phone").text(data.success.phone);
            ele.find("td.username").text(data.success.account.username);
            $('#lst_permission').modal('hide');
            alertSuccess('Cập nhật thông tin tài khoản thành công!');
          }else if(data.type == 'active')
          {
            ele.find("td input.status-switch").bootstrapSwitch('toggleState', true, true);
            alertSuccess('Cập nhật trạng thái tài khoản thành công!');

          }else if(data.type =='permission')
          {
            $('#lst_permission').modal('hide');
            alertSuccess('Cập nhật quyền tài khoản nhân viên thành công!');
          }
        }
      },
      error: function(data) {
       alertError('Cập nhật thất bại!');
     }
   });
    //end of ajax
  });
  //end of form submit


  $('#staff_table').on('switchChange.bootstrapSwitch','.status-switch',function (e, data) {
    var element = $(this);
    $('#status_id').val(element.val());
    ele = $(this).parent().parent().parent().parent();
    var id= $(this).parent().parent().parent().parent().data('id');
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
            activeAccount(id);
          }
        },
        Không: {
          keys: ['esc'],
          btnClass: 'btn-red'
        }
      }
    });
  });

  function activeAccount(id){
    $('#staff_id').val(id);
    $('#button_action').val('active');
    $('#update_permission').submit();
  }


});



</script>
@endsection