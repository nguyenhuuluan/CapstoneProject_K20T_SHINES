

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
                feedBack: {
                    text: 'Gửi phản hồi',
                    btnClass: 'btn-warning',
                    action: function(){
                        $.confirm({
                            title: 'Gửi phản hồi',
                            content: '' +
                            '<form action="" class="feedback-form">' +
                            '<div class="form-group">' +
                            '<textarea class="form-control feedback-message" rows="5" id="comment" placeholder="Nhập phản hồi ..."></textarea>' +
                            '</div>' +
                            '</form>',
                            buttons: {
                                formSubmit: {
                                    text: 'Phản hồi',
                                    btnClass: 'btn-blue',
                                    action: function () {
                                        var message = this.$content.find('.feedback-message').val();
                                        var recruitmentID = currentelement.val();
                                        if(!message){
                                            $.alert('Vui lòng nhập nội dung phản hồi');
                                            return false;
                                        }

                                        feedbackRecruitment(recruitmentID, message);


                                        // $.alert('Your name is ' + message);
                                        // $.alert('RecruitmentID ' + recruitmentID);
                                    }
                                },
                                cancel: function () {
            //close
        },
    },
    onContentReady: function () {
        // bind to events
        var jc = this;
        this.$content.find('form').on('submit', function (e) {
            // if the user submits the form by pressing enter in the field.
            e.preventDefault();
            jc.$$formSubmit.trigger('click'); // reference the button and click it
        });
    }
});
                    }    
                },
                Không: {
                    keys: ['esc'],
                    btnClass: 'btn-red'                             
                }
            }
        });
       });

        function feedbackRecruitment(recruitmentID, message){
            $('.modal-ajax-loading').fadeIn("200");
            $.ajax({
                url: '../recruitment/feedback/' + recruitmentID + '/' + message,
                type: 'GET',
                dataType: 'json',
                success: function(){
                    $('.modal-ajax-loading').fadeOut("200");
                    $.alert({
                        title: 'Thông báo!',
                        content: 'Đã gửi phản hồi',
                    });                   
           },
           error: function(){
            $('.modal-ajax-loading').hide();
            alertError();
        }            
    });
        }

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

