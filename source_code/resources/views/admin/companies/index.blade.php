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
                                            <th>ID</th>                                          
                                            <th>Tên</th>                                          

                                            <th>Website</th>
                                            <th>Email</th> 
                                                                                  
                                            <th>Ngày tạo</th>
                                            <th>Hiện thị trang chủ</th>
                                            <th>Trạng thái</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comps as $comp)
                                        <tr>
                                            <td>{{$comp->id}}</td>
                                            <td>{{$comp->name}}</td>

                                            <td><a href="{{$comp->website}}">{{$comp->website}}</a></td>
                                            <td>{{$comp->email}}</td>

                                            <td>{{$comp->created_at}}</td>
                                             <td> @if ($comp->is_hot == false)
                                                <input type="checkbox" class="switch is-hot-switch" id="myswitch" data-backdrop="static" data-keyboard="false" 
                                                value="{{$comp->id}}" />                                              
                                                @else

                                                <input type="checkbox" class="switch is-hot-switch" id="myswitch" data-backdrop="static" data-keyboard="false" 
                                                checked value="{{$comp->id}}" />

                                                @endif
                                            </td>

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
                                                
                                                <a class="btn btnreview btn-success" target="_blank" href="{{ route('company.details', $comp->slug ) }}">Xem</a>
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

    $('.switch').bootstrapSwitch({
        size: 'mini',
        onText: 'Bật',
        offText: 'Tắt',
        onColor: 'success',
        offColor: 'danger'     
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

     $('.is-hot-switch').on('switchChange.bootstrapSwitch', function (e, data) {

        var element = $(this);
        element.bootstrapSwitch('state', !data, true);
        $.confirm({
            title: 'Thông báo!!',
            content: 'Bạn có muốn thiết lập hiển thị ở trang chủ cho công ty này?',
            buttons: {
                Có: {
                    keys: ['enter'],
                    btnClass: 'btn-green',
                    action: function(){
                        setIsHotCompany(element.val(), element);
                        
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
        $('.modal-ajax-loading').fadeIn("200");
        $.ajax({
            url: 'company/active/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(){
             $('.modal-ajax-loading').fadeOut("200");
         },
         error: function(){
             $('.modal-ajax-loading').fadeOut("200");
             alertError();
         }            
     });
    }

    function setIsHotCompany(id, element){
        $('.modal-ajax-loading').fadeIn("200");
        $.ajax({
            url: 'company/setishot/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response){
             $('.modal-ajax-loading').fadeOut("200");
             if(response == false){
                $.alert({
                    title: 'Thông báo!',
                    content: 'Đã vượt quá số lượng hiển thị ở trang chủ là 8',
                });
             }else{
                 $.alert({
                    title: 'Thông báo!',
                    content: 'Đã thiết lập thành công',
                });

                element.bootstrapSwitch('toggleState', true, true);
             }
         },
         error: function(){
             $('.modal-ajax-loading').fadeOut("200");
             alertError();
         }            
     });
    }
</script>
@endsection
