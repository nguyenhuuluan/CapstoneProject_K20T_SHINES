

@extends('layouts.admin')

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
                                                    
                                                    <th>Tên</th>
                                         
                                                    <th>Điện thoại</th>
                                                    <th>Website</th>
                                                    <th>Email</th>
                                                    <th>Trạng thái</th>
                                                    <th>Ngày tạo</th>
                                                   <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                    <td>1</td>
                                                    <td>Sacomreal Sacomreal Sacomreal Sacomreal</td>
                                                    <td>Hồ Chí Minh</td>
                                                    <td>0123456789</td>
                                                    <td>29/12/2017</td>
                                                    <td>sacomreal@gmail.com</td>
                                                    <td><button type="button" class="btnreview btn-success">Xem</button></td>
                                                    <td>
                                                        <input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-size="mini">
                                                    </td>
                                                </tr> --}}


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
            getCompanies();

            function getCompanies(){

                $('#dataTables-example').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: 'http://localhost:9999/CapstoneProject_K20T_SHINES/source_code/public/admin/getcompanies',
                    columns:[
                    {data:'name'},
                    {data:'phone'},
                    {data:'website'},
                    {data:'email'},
                    {data:'status_id'},
                    {data:'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]

                    
                    
                });

            }

        </script>
        @endsection

