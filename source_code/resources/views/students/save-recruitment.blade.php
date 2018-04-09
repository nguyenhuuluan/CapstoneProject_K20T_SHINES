@extends('layouts.master-layout',['title' => 'Jobee- Việc làm đã lưu', 'isDisplaySearchHeader' => false])

@section('stylesheet')
<link href="{{ asset('assets/vendors/datatables-plugins/dataTables.bootstrap.css') }} " rel="stylesheet">
<link href="{{ asset('assets/vendors/datatables-responsive/dataTables.responsive.css') }} " rel="stylesheet">

@endsection
@section('page-header')
<!-- Page header -->
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/O7MF5N0.jpg') }} )">
	<div class="container page-name">
		<h1 class="text-center">Danh sách việc làm đã ứng tuyển</h1>
	</div>
</header>
<!-- END Page header -->
@endsection

@section('content')
<main>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-body">
						<div class="table-responsive">
							<table width="100%" id="dataTables-example" class="table table-striped table-hover table-bordered-company">
								<thead>
									<tr>
										<th>Tên việc làm</th>
										<th>Địa điểm</th>
										<th>Ngày đăng tin</th>
										<th>Công ty</th>
										<th>Xóa</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($recruitments as $recruitment)
									<tr>
										<td><a href="{!! route('detailrecruitment', $recruitment->slug) !!}" target="_blank">{!! $recruitment->title !!}</a></td>
										<td>{!! $recruitment->company['address']['district']['city']->name !!}</td>
										<td>{!! date("d-m-Y | H:i:s", strtotime($recruitment->pivot->created_at))  !!}</td>
										<td><a href="{!! route('company.details', $recruitment->company->slug) !!}" target="_blank">{!! $recruitment->company->name !!}</a></td>
										<td>
											<center>
												<a href="#"><abbr title="Xóa khỏi danh sách"><i class="fa fa-trash" aria-hidden="true"></i></abbr></a>
											</center>
										</td>
									</tr>
									@endforeach

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


</main>
@endsection

@section('scripts')

<script src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/vendors/datatables-plugins/dataTables.bootstrap.min.js') }} "></script>
<script src="{{ asset('assets/vendors/datatables-responsive/dataTables.responsive.js') }} "></script>
<script>
	$(document).ready(function() {
		$('#dataTables-example').DataTable({
			responsive: true
		});
	});
</script>

@endsection