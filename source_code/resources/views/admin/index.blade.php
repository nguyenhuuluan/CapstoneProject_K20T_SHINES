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
							<div class="huge">126</div>
							<div>Tin tuyển dụng</div>
						</div>
					</div>
				</div>
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
							<div class="huge">125</div>
							<div>Công ty</div>
						</div>
					</div>
				</div>
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
							<div class="huge">12124</div>
							<div>Ứng viên</div>
						</div>
					</div>
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
						<div class="huge">50</div>
						<div>Nhân viên</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>


	<div class="row">
		<center><h3>Số lượng tin tuyển dụng của năm: <span class="current-year">2018</span></h3></center>
		<div class="form-group col-lg-3 col-md-6 col-xs-12">
			<label>Chọn năm</label>
			<select class="form-control year-select">
				<option>2017</option>
				<option selected="">2018</option>
				<option>2019</option>
				<option>2020</option>
				<option>2021</option>
				<option>2022</option>
			</select>
		</div>
		<canvas id="bar-chart" width="100%" height="40%"></canvas>
	</div>
	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-12">
		<center><h3>Số lượng tin tuyển dụng</h3></center>
		<div class="form-group col-lg-6 col-md-6 col-xs-12">
			<label>Chọn tháng</label>
			<select class="form-control">
				<option>12/2017</option>
				<option>1/2018</option>
				<option>2/2018</option>
				<option>3/2018</option>
			</select>
		</div>
		<canvas id="chart-area"></canvas>
	</div>
	<div id="container" class="col-lg-12 col-md-12 col-xs-12">
		<center><h3>Số lượng nhà tuyển dụng theo chuyên nghành</h3></center>
		<canvas id="canvas"></canvas>
	</div>

	<!--Ứng viên theo chuyên nghành đào tạo-->
	<div class="col-lg-6 col-md-6 col-xs-12">
		<center><h3>Ứng viên theo chuyên nghành đào tạo</h3></center>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Tên Nghành</th>
						<th>Số Lượng</th>
					</tr>
				</thead>
				<tbody>
					<tr class="success">
						<td>Công Nghệ Thông Tin</td>
						<td>300</td>
					</tr>
					<tr class="info">
						<td>Ngôn Ngữ Anh</td>
						<td>530</td>
					</tr>
					<tr class="warning">
						<td>Sinh Học</td>
						<td>120</td>
					</tr>
					<tr class="danger">
						<td>Kiến Xây</td>
						<td>210</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!--End ứng viên theo chuyên nghành đào tạo-->

	<!--Ứng viên đã đk ứng tuyển theo chuyên nghành đào tạo-->
	<div class="col-lg-6 col-md-6 col-xs-12">
		<center><h3>Ứng viên đã đăng kí ứng tuyển theo chuyên nghành đào tạo</h3></center>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Tên Nghành</th>
						<th>Số Lượng</th>
					</tr>
				</thead>
				<tbody>
					<tr class="success">
						<td>Công Nghệ Thông Tin</td>
						<td>300</td>
					</tr>
					<tr class="info">
						<td>Ngôn Ngữ Anh</td>
						<td>530</td>
					</tr>
					<tr class="warning">
						<td>Sinh Học</td>
						<td>120</td>
					</tr>
					<tr class="danger">
						<td>Kiến Xây</td>
						<td>210</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!--End Ứng viên đã đk ứng tuyển theo chuyên nghành đào tạo-->

	<!--Ứng viên đã đk ứng tuyển theo chuyên nghành đào tạo-->
	<div class="col-lg-6 col-md-6 col-xs-12">
		<center><h3>Số lượng CV theo chuyên nghành đào tạo</h3></center>
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Tên Nghành</th>
						<th>Số Lượng</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Công Nghệ Thông Tin</td>
						<td>30</td>
					</tr>
					<tr>
						<td>Ngôn Ngữ Anh</td>
						<td>50</td>
					</tr>
					<tr>
						<td>Sinh Học</td>
						<td>12</td>
					</tr>
					<tr>
						<td>Kiến Xây</td>
						<td>21</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!--End Ứng viên đã đk ứng tuyển theo chuyên nghành đào tạo-->


</div>
<!-- /.row -->

</div>

@endsection

@section('scripts')
<!-- ChartJS -->
<script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/utils.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/aWapBE.js') }}"></script>
<script>
	var statisiticsRecruitmentCategoryConfig = {
		type: 'pie',
		data: {
			datasets: [{
				data: [1170,50,],
				backgroundColor: [
				window.chartColors.orange,
				window.chartColors.green,
				],
				label: 'Dataset 1'
			}],
			labels: [
			'Fulltime',
			'Parttime'
			]
		},
		options: {
			responsive: true
		}
	};

	var statisiticsRecruitmentByYearConfig =  {
		type: 'bar',
		data: {
			labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
			datasets: [
			{
				label: "Số lượng tin tuyển dụng của năm 2018",
				backgroundColor: "#3e95cd",
				data: [0,0,0,0,0,0,0,0,0,0,0,0]
			}]
		},
		options: {
			legend: { display: false }
			
		}
	};

	var myHorizontalBarConfig = {
		type: 'horizontalBar',
		data: {
			labels: ['CNTT', 'Sinh học', 'QHCC', 'Ngôn ngữ anh','Nhiệt Lạnh', 'QHCC', 'Ngôn ngữ anh','Nhiệt Lạnh'],
			datasets: [{
				label:'',
				backgroundColor: palette('tol',10).map(function(hex) {
					return '#' + hex;
				}),
				borderWidth: 2,
				data: [
				100,
				2312,
				1231,
				3443,
				34,
				323,
				1231,
				324,
				2361,
				]
			}],

		},
		options: {
			elements: {
				rectangle: {
					borderWidth: 2,
				}
			},
			responsive: true,
			title: {
				display: false,
				text: 'Số lượng nhà tuyển dụng theo chuyên nghành'
			}
		}
	};


		/*window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};*/
	</script>

	<script>

		//Muốn chạy đc chart phải có cái đoạn này
		//Cái này t để chung hết các chạy, còn muốn chạy chart riêng lẻ thì lấy cái đoạn script t comment lại nhé

		window.onload = function() {

			var ctx = document.getElementById("bar-chart");
			var statisiticsRecruitmentByYearChart = new Chart(ctx,statisiticsRecruitmentByYearConfig);

			var ctx = document.getElementById('chart-area');
			var statisiticsRecruitmentCategoryChart = new Chart(ctx, statisiticsRecruitmentCategoryConfig);

			var ctx = document.getElementById('canvas');
			var myHorizontalBar = new Chart(ctx, myHorizontalBarConfig);
		};

		$('.year-select').on("change", function(){
			$('.current-year').text($(this).val());
			statisiticsRecruitmentByYear($(this).val());
		});

		statisiticsRecruitmentByYear(2018);


		function statisiticsRecruitmentByYear(year){
			$.ajax({
				url: 'admin/statistics/statisticsNumberOfRecruitmentByYear/' + year,
				type: 'GET',
				dataType: 'json',

				success: function(data) {
					
					var arr = new Array();

					for(i = 1; i <= 12; i++ ){
						arr.push(data[i])
					}

					statisiticsRecruitmentByYearConfig.data.datasets[0].data = arr;

					var ctx = document.getElementById("bar-chart");
					var statisiticsRecruitmentByYearChart = new Chart(ctx,statisiticsRecruitmentByYearConfig);
				}

			});
		}

	</script>
	@endsection