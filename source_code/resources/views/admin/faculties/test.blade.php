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
<link href="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }} " rel="stylesheet">

@endsection

@section('body')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quản lý nghành đào tạo</h1>
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
                                            <th>Tên ngành</th>
                                            <th>Mô tả</th>
                                            <th>Tags</th>
                                            <th>Ngày tạo</th>
                                            <td>Thao tác</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faculties as $fac)
                                        <tr>
                                            <td>{!! $fac->id !!}</td>
                                            <td>{!! $fac->name !!}</td>
                                            <td>{!! $fac->description !!}</td>
                                            <td>
                                                @foreach ($fac->tags as $tag)
                                                <span class="label label-default">{!! $tag->name !!}</span>
                                                @endforeach
                                            </td>
                                            <td>{!! $fac->created_at !!}</td>
                                            <td>
                                                <a href="#" class="btn btn-xs btn-primary edit" id="{!!$fac->id !!}"> <i class="glyphicon glyphicon-edit"></i>Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->

                        <div id="editFaculty" class="modal fade">
                            <form class="modal-content animate" id="updateFaculty" method="post">
                                {{csrf_field()}}
                                <div class="login-block">
                                    <h2 style="color:green; font-weight: bold;" class="modal-title">Thêm mới</h2>
                                    <span id="form_output"></span>
                                    <div class="form-group">
                                        <label style="float: left; padding-left: 10px;">Tên Ngành:</label>
                                        <input type="text" name="name" id="faculty_name" class="form-control" />
                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <label style="float: left; padding-left: 10px;">Mô tả:</label>
                                        <input type="text" name="description" id="faculty_des" class="form-control" />
                                    </div>
                                    <hr>
                                    
                                    <div class="form-group">
                                        <input type="text" name="tags" class="name tagsinput-typeahead form-control" placeholder="Nhập tags" data-role="tagsinput" id="tags">
                                    </div>
                                    <br><br>
                                    <input type="hidden" name="faculty_id" id="faculty_id" value="" />
                                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                                    <input type="submit" name="submit" id="action" value="Thêm mới" class="btn btn-success" />
                                    <button class="btn btn-warning" data-dismiss="modal">Hủy</button>
                                </div>
                                <div id="#test"></div>

                            </form>
                        </div>

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
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-tagsinput/bootstrap3-typeahead.js') }}"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->

<script> 
    $('.tagsinput-typeahead').tagsinput({
        typeahead: {
            source: $.get('{{ route('tags') }}'),
            afterSelect: function() {
                this.$element[0].value = '';    
            },
        },
        trimValue: true,
        freeInput: true,
        tagClass: 'label label-default',
    })
</script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });

        //Chan event enter input tags
        $(window).keypress(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
          }
      });

        //Nhấn nút edit->show modal
        $(document).on('click', '.edit', function(){
            var id = $(this).attr("id");
            $('#form_output').html('');
            var url = '{{ route("faculties.show", ":id") }}';
            url = url.replace(':id', id);
            // console.log(url);
            $.ajax({
                url:url,
                method:'get',
                // data:{id:id},
                dataType:'json',
                success:function(data)
                {   
                    var tags = data.tags.map(function(item){return item.name});
                    var tmp = '';
                    for (var i = 0; i < tags.length; i++) {
                        tmp += tags[i] + ",";
                    } 
                    console.log(tmp)
                    $('#editFaculty').modal('show');
                    $('#faculty_name').val(data.name);
                    $('#faculty_id').val(data.id);
                    $('#faculty_des').val(data.description);
                    $('#tags').val(tmp);
                    $('#tags').tagsinput('add', tmp);
                    $('#action').val('Lưu');
                    $('.modal-title').text('Cập nhật thông tin');
                    $('#button_action').val('update');
                }
            })
        });

        $('#updateFaculty').on('submit', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('faculties.update') }}",
                data: form_data,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    if(data.error.length > 0)
                    {
                        alert('123');
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++)
                        {
                            error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                        }
                        $('#form_output').html(error_html);
                    }
                    else
                    {
                        console.log(data.success);
                        console.log($('#updateFaculty')[0]);
                        $('#form_output').html(data.success);
                        $('#updateFaculty')[0].reset();
                        $('#action').val('Add');
                        $('.modal-title').text('Add Data');
                        $('#button_action').val('insert');
                    // $('#student_table').DataTable().ajax.reload();
                }
            },
            error: function(data) {
                console.log(data);
                alert('error handing here');
            }
        });



            //end of submit
        });


    });
</script>

<!-- Confirm Button -->
<script type="text/javascript">
    $('.confirm').on('click', function() {
        $.confirm({
            title: 'Xác nhận xóa!',
            content: 'Bạn có chắc muốn xóa nghành học này!',
            buttons: {
                XacNhan: {
                    text: 'Xác nhận',
                    btnClass: 'btn-warning',
                    keys: ['enter', 'shift'],
                    action: function() {
                        $.alert('Xác nhận!');
                    },
                },
                Huy: {
                    text: 'Hủy',
                    btnClass: 'btn-success',
                    keys: ['enter', 'shift'],
                    action: function() {
                        $.alert('Hủy');
                    },
                },
            },
        });
    });
</script>
{{-- <script type="text/javascript">
    $('.example2-2').on('click', function () {
        $.confirm({
            title: 'Quản lý tag!',
            content: '' +
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<label>Nhập tên tag</label>' +
            '<input type="text" class="name tagsinput-typeahead form-control" placeholder="Nhập tags bài viết" data-role="tagsinput" value="HTML">' +
            '</div>' +
            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var name = this.$content.find('.name').val();
                        if (!name) {
                            $.alert('provide a valid name');
                            return false;
                        }
                        $.alert('Your name is ' + name);
                    }
                },
                cancel: function () {
                                                //close
                                            },
                                        },
                                        onContentReady: function () {
                                            // you can bind to the form
                                            var jc = this;
                                            this.$content.find('form').on('submit', function (e) { // if the user submits the form by pressing enter in the field.
                                                e.preventDefault();
                                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                                            });
                                        }
                                    });
    });
</script> --}}
@endsection