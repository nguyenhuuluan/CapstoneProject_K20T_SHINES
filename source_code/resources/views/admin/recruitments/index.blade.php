@extends('layouts.admin')

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
                                        <td>{!! $recruitment->id !!}</td>
                                        <td>{!! $recruitment->title !!}</td>
                                        <td>{!! $recruitment->salary !!}</td>
                                        <td>{!! $recruitment->expire_date !!}</td>
                                        <td style="text-align: center">{!! $recruitment->number_of_view !!}</td>
                                        <td>{{ $recruitment->company->name }}</td>
                                        <td>{!! $recruitment->created_at !!}</td>
                                        {{-- <td>{!! $recruitment->is_hot ==1? 'Hot' : 'Not Hot' !!}</td> --}}

                                        <td>
                                            @if ($recruitment->status_id == 1)
                                            <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" checked value="{{$recruitment->id}}" />
                                            @elseif($recruitment->status_id == 2)                                           
                                            <input type="checkbox" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" value="{{$recruitment->id}}" />
                                            @else

                                            <input type="checkbox" disabled="true" class="switch status-switch" id="myswitch" data-backdrop="static" data-keyboard="false" 
                                            checked value="{{$recruitment->id}}" />

                                            @endif
                                        </td>
                                        <td>
                                            <div style="display: inline-block; width: 100px ">
                                                <a href=" {{ route('admin.recruitments.show', $recruitment->slug) }}" class="btnreview btn-success" target="_blank" style="display: inline-block;">Xem</a>
                                                {!! Form::open(['method'=>'PATCH', 'action'=>['Admin\AdminRecruitmentController@update',$recruitment->id], 'style'=>'display: inline-block']) !!}
                                            </div>
                                            
                                        </td>
                                        {!! Form::close() !!} 
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
<script type="text/javascript">

    $('.switch').bootstrapSwitch({
        size: 'mini',
        onText: 'Bật',
        offText: 'Tắt'      
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
                    approveRecruitment(currentelement);
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
            content: 'Bạn có muốn thay đổi trạng thái của tin tuyển dụng này?',
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


    function alertError(){
     $.alert({
        title: 'Thông báo!',
        content: 'Đã có lỗi xảy ra, vui lòng reload lại trang.',
    });
 }
    // getCompanies();

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

    function approveRecruitment(element){
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