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
                <h1 class="page-header">Danh sách tin tuyển dụng</h1>
            </div>
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
                                        <th>Lượt xem</th>
                                        <th>Công ty</th>
                                        <th>Ngày tạo</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recruitments as $recruitment)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td><a href="{{ $recruitment->path() }}" target="_blank">{{ $recruitment->title }}</a></td>
                                        <td>{!! $recruitment->salary !!}</td>
                                        <td>{!! $recruitment->expire_date !!}</td>
                                        <td style="text-align: center">{!! $recruitment->number_of_view !!}</td>
                                        <td>{{ $recruitment->company->name }}</td>
                                        <td>{!! $recruitment->created_at !!}</td>
                                        {{-- <td>{!! $recruitment->is_hot ==1? 'Hot' : 'Not Hot' !!}</td> --}}
                                        
                                        <td>
                                            @if(Auth::user()->can('recruitments.update'))
                                            @if ($recruitment->status_id == 1)
                                            <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" checked value="{{$recruitment->id}}" />
                                            @elseif($recruitment->status_id == 2)                                           
                                            <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" value="{{$recruitment->id}}" />
                                            @endif
                                            @else
                                            @if ($recruitment->status_id == 1)
                                            <input type="checkbox" disabled="true" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" checked value="{{$recruitment->id}}" />
                                            @elseif($recruitment->status_id == 2)                                           
                                            <input type="checkbox" disabled="true" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" value="{{$recruitment->id}}" />
                                            @endif
                                            @endif
                                        </td>
                                        <td>
                                            <div style="display: inline-block; width: 100px ">
                                                <a href=" {{ route('admin.recruitments.show', $recruitment->slug) }}" class="btnreview btn-success" target="_blank" style="display: inline-block;">Xem</a>
                                            </div>
                                            
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
    $('.switch').bootstrapSwitch({
        size: 'mini',
        onText: 'Bật',
        offText: 'Tắt'      
    });
    $(document).ready(function() {
        var element;
        $('#dataTables-example').DataTable({
            responsive: true
        });



        $('.status-switch').on('switchChange.bootstrapSwitch', function (e, data) {

            element = $(this);

            element.bootstrapSwitch('state', !data, true);

            $.confirm({
                icon: 'fa fa-warning',
                title: 'Cảnh báo!!',
                content: 'Bạn có muốn thay đổi trạng thái của tin tuyển dụng này?',
                type: 'orange',
                buttons: {
                    Có: {
                        keys: ['enter'],
                        btnClass: 'btn-green',
                        action: function(){
                            activeRecruitment(element.val());
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
      //  $('.modal-ajax-loading').show();
      $.ajax({
        url: 'recruitments/active/' + id,
        type: 'GET',
        dataType: 'json',

        success: function(){
            element.bootstrapSwitch('toggleState', true, true);
            alertSuccess('Cập nhật trạng thái thành công...')
        },
        error: function(){
           alertError('Đã có lỗi xảy ra, vui lòng reload lại trang ...');
       }            
   });
  }

  
});
</script>
@endsection