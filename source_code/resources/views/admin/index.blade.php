@extends('layouts.admin')

@section('styles')

@endsection

@section('body')
<div id="page-wrapper">
	
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Bảng điều khiển</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-newspaper-o fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">26</div>
							<div>Tin tuyển dụng</div>
						</div>
					</div>
				</div>
				<a href="list-recruitment.html">
					<div class="panel-footer">
						<span class="pull-left">Xem chi tiết</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-green">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-building fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">12</div>
							<div>Công ty</div>
						</div>
					</div>
				</div>
				<a href="list-company.html">
					<div class="panel-footer">
						<span class="pull-left">Xem chi tiết</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-yellow">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-users fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">124</div>
							<div>Ứng viên</div>
						</div>
					</div>
				</div>
				<a href="list-account-candidate.html">
					<div class="panel-footer">
						<span class="pull-left">Xem chi tiết</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-3 col-md-6">
			<div class="panel panel-red">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-user fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<div class="huge">7</div>
							<div>Nhân viên</div>
						</div>
					</div>
				</div>
				<a href="list-account-staff.html">
					<div class="panel-footer">
						<span class="pull-left">Xem chi tiết</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<div class="row">
		<canvas id="bar-chart" width="100%" height="40%"></canvas>
	</div>
	<!-- /.row -->
	
</div>

@endsection

@section('scripts')
<!-- ChartJS -->
<script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/data/dataChartjs.js') }}"></script>
@endsection