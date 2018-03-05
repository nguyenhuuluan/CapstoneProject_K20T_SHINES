

@extends('layouts.admin')

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
    <script type="text/javascript">


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

