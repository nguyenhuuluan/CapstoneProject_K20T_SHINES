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
                                        <th>Title</th>
                                        <th>Salary</th>
                                        <th>Expire_date</th>                                       
                                        <th>number_of_view</th>
                                        <th>Company</th>
                                        <th>created_at</th>
                                        <th>updated_at</th>
                                        <th>is_hot</th>
                                        <th>Preview</th>
                                        <th>Status</th>
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
                                        <td>{!! $recruitment->updated_at !!}</td>
                                        <td>{!! $recruitment->is_hot !!}</td>
                                        <td><a href=" {{ route('adminpreviewrecruitment', $recruitment->id) }}" class="btnreview btn-success">Xem</a></td>
                                        {!! Form::open(['method'=>'PATCH', 'action'=>['RecruitmentController@status',$recruitment->id]]) !!}
                                        @if ($recruitment->status_id ==1)
                                        {{-- <td>{!! Form::checkbox('status_id', $recruitment->status_id, true,['data-toggle'=>'toggle', 'data-onstyle'=>'success', 'data-size'=>'mini' ]) !!}</td> --}}                                        
                                        <td>
                                            <input type="hidden" name="status_id" value="2">   
                                            {!! Form::submit('Active', ['class'=>'btn btn-success']) !!}
                                        </td>
                                        @else
                                        {{-- <td>{!! Form::checkbox('status_id', $recruitment->status_id, false,['data-toggle'=>'toggle', 'data-onstyle'=>'success', 'data-size'=>'mini' ]) !!}</td> --}}
                                        <td>
                                            <input type="hidden" name="status_id" value="1">       
                                            {!! Form::submit('InActive', ['class'=>'btn btn-primary btn-danger']) !!}
                                        </td>
                                        
                                        @endif
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