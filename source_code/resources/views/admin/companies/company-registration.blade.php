

@extends('layouts.admin')

@section('body')



<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách công ty đang chờ xác nhận</h1>
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

                                            <th>Tên công ty</th>
                                            <th>Website</th>
                                            <th>Tên người đại diện</th>
                                            <th>Chức Vụ</th>             
                                            <th>Email người đại diện</th>
                                            <th>SĐT</th>

                                            <th>Ngày đăng ký</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($compsRegis as $compRegis)

                                        @if ($compRegis->status_id == 9)
                                        <tr>
                                            <td>{{$compRegis->company_name}}</td>

                                            <td><a href="{{$compRegis->company_website}}">{{$compRegis->company_website}}</a></td>
                                            <td>{{$compRegis->representative_name}}</td>
                                            <td>{{$compRegis->representative_position}}</td>
                                            <td>{{$compRegis->representative_email}}</td>
                                            <td>{{$compRegis->representative_phone}}</td>
                                            
                                            <td>{{$compRegis->created_at}}</td>
                                            <td>
                                               
                                                <button type="button" class="btn btn-default btn-success btn-approve" value = "{{$compRegis->id}}">

                                                    <span class="fa fa-check"></span> Xác nhận

                                                </button>
                                                
                                                
                                            </td>   </tr>
                                        @endif
                                                                               
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



        function approveCompany(element){
            $('.modal-ajax-loading').fadeIn("200");
            $.ajax({
                url: '../company/approve/' + element.val(),
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    $('.modal-ajax-loading').fadeOut("200");
                    element.parent().parent().remove();
                    sendConfirmEmail(response.account_id, response.id, response.company_id);
                },
                error: function(){
                    $('.modal-ajax-loading').fadeOut("200");
                    alertError();
                }            
            });
        }

        function sendConfirmEmail(accID, repreID, compID){
            $.ajax({
                url: '../company/sendemailconfirm/' + accID + '/' + repreID + '/' +compID,
                type: 'GET',
                dataType: 'json',
                success: function(){
                    alert('OK');
                },
                error: function(){
                    
                }            
            });
        }


    </script>
    @endsection

