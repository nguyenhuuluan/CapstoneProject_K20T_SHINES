@extends('layouts.admin')

@section('styles')
<link href="{{ asset('assets/vendors/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">


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
							<div class="huge">{{$recruitmentCount}}</div>
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
							<div class="huge">{{$companyCount}}</div>
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
							<div class="huge">{{$studentCount}}</div>
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
						<i class="fa fa-support fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">{{$cvCount}}</div>
						<div>CV</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<br>
	
	<div>
		
	</div>
	<hr>



	<div class="row">
		
		<div class="form-group col-lg-12 col-md-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<center>
						<h3>Số lượng tin tuyển dụng của năm: 
							<span class="current-year">2018</span>
						</h3>
					</center>
				</div>

				<div class="panel-body">
					<div  class="form-group col-lg-4 col-md-4 col-xs-12">
						<label>Chọn năm</label>
						<select class="form-control year-select year-select2">
							<option>2017</option>
							<option selected>2018</option>
						</select>
					</div>
					<canvas id="bar-chart" width="100%" height="40%"></canvas>
				</div>
				
			</div>
		</div>
		
	</div>


	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<center>
					<h3>Số lượng tin tuyển dụng theo loại</h3>
				</center>
			</div>
			{{-- <center><h3>Số lượng tin tuyển dụng của năm: <span class="current-year">2018</span></h3></center> --}}
			<div class="panel-body">
				<canvas id="chart-area"></canvas>
			</div>

		</div>
	</div>

	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<center>
					<h3>Số lượt xem tin tuyển dụng</h3>
				</center>
			</div>
			{{-- <center><h3>Số lượng tin tuyển dụng của năm: <span class="current-year">2018</span></h3></center> --}}
			<div class="panel-body">
				<canvas id="chart-area1"></canvas>
			</div>

		</div>
	</div>

	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<center>
					<h3>Số lượng tin tuyển dụng theo chuyên ngành</h3>
				</center>
			</div>
			{{-- <center><h3>Số lượng tin tuyển dụng của năm: <span class="current-year">2018</span></h3></center> --}}
			<div class="panel-body">
				<canvas id="canvas"  height="250px"></canvas>
			</div>

		</div>
	</div>

	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<center>
					<h3>Số lượng ứng viên, CV theo chuyên ngành</h3>
				</center>
			</div>
			{{-- <center><h3>Số lượng tin tuyển dụng của năm: <span class="current-year">2018</span></h3></center> --}}
			<div class="panel-body">
				<canvas id="canvas22"  height="300px"></canvas>
			</div>

		</div>
	</div>
	


	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<center>
					<h3>Tag phổ biến được ứng viên sử dụng</h3>
				</center>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="form-group col-xs-4">
						<input id='datetimepicker1' class="form-control" type="text"
						placeholder="Ngày bắt đầu"/>
					</div>

					<div class="form-group col-xs-4">
						<input id='datetimepicker2' class="form-control" type="text"
						placeholder="Ngày kết thúc"/>
					</div>

					<div class="form-group col-xs-3">
						<select class="form-control year-select" id="limit1">
							<option value="5" selected>5</option>
							<option value="10" >10</option>
							<option value="15" >15</option>
							<option value="20" >20</option>	
							{{-- <option value="" >Tất cả</option>							 --}}
						</select>
					</div>

					
				</div>

				<canvas id="canvas10" height="300px"></canvas>
			</div>

		</div>
	</div>

	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<center>
					<h3>Tag phổ biến được nhà tuyển dụng sử dụng</h3>
				</center>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="form-group col-xs-4">
						<input id='datetimepicker3' class="form-control" type="text"
						placeholder="Ngày bắt đầu"/>
					</div>

					<div class="form-group col-xs-4">
						<input id='datetimepicker4' class="form-control" type="text"
						placeholder="Ngày kết thúc"/>
					</div>

					<div class="form-group col-xs-3">
						<select class="form-control year-select" id="limit2">
							<option value="5" selected>5</option>
							<option value="10" >10</option>
							<option value="15" >15</option>
							<option value="20" >20</option>	
							{{-- <option value="" >Tất cả</option>								 --}}
						</select>
					</div>

					
				</div>

				<canvas id="canvas11" height="300px"></canvas>
			</div>

		</div>
	</div>

	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<center>
					<h3>Loại người dùng truy cập</h3>
				</center>
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Từ ngày:</label>
					<div class="col-xs-6">
						<input id='datetimepicker5' class="form-control" type="text"
						placeholder="Từ ngày"/>
					</div>
					
				</div>

				<canvas id="chart-area12"></canvas>
			</div>

		</div>
	</div>

	<div id="canvas-holder" class="col-lg-6 col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<center>
					<h3>Loại trình duyệt truy cập</h3>
				</center>
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label class="control-label col-sm-3" for="email">Từ ngày:</label>
					<div class="col-xs-6">
						<input id='datetimepicker6' class="form-control" type="text"
						placeholder="Từ ngày"/>
					</div>
					
				</div>

				<canvas id="chart-area13"></canvas>
			</div>

		</div>
	</div>


	
</div>
<!-- /.row -->

</div>

@endsection

@section('scripts')
<!-- ChartJS -->


<script src="{{ asset('assets/vendors/datetimepicker/moment.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/utils.js') }}"></script>
<script src="{{ asset('assets/vendors/chartjs/aWapBE.js') }}"></script>




<script src="{{ asset('assets/vendors/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>


<script>

	var currentDate = new Date();

	var currentYear = currentDate.getFullYear();
	var currentMonth = (currentDate.getMonth() + 1);

	var firstDay = currentYear + '/' + (currentDate.getMonth() + 1) + '/' + '1';

	var lastYear = (currentYear - 1) + '/' + (currentDate.getMonth() + 1) + '/' + currentDate.getDate();

	currentDate = currentYear + '/' + (currentDate.getMonth() + 1) + '/' + currentDate.getDate();


	$('#datetimepicker1').datetimepicker({
		format: 'YYYY/MM/DD'
	});
	$('#datetimepicker1').datetimepicker({
		useCurrent: false
	});
	$('#datetimepicker1').val(lastYear);

	$('#datetimepicker1').datetimepicker().on('dp.change', function() {
		statisticsTagsInStudentByRangeDate();	
	});


	$('#datetimepicker2').datetimepicker({
		format: 'YYYY/MM/DD'
	});
	$('#datetimepicker2').datetimepicker({
		useCurrent: false
	});
	$('#datetimepicker2').val(currentDate);
	$('#datetimepicker2').datetimepicker().on('dp.change', function() {
		statisticsTagsInStudentByRangeDate();	
	});

	$('#limit1').on('change', function() {
		statisticsTagsInStudentByRangeDate();	
	});

// ------------------------------


$('#datetimepicker3').datetimepicker({
	format: 'YYYY/MM/DD'
});
$('#datetimepicker3').val(lastYear);
$('#datetimepicker3').datetimepicker({
	useCurrent: false
});
$('#datetimepicker3').datetimepicker().on('dp.change', function() {
	statisticsTagsInRecruitmentByRangeDate();
});

$('#datetimepicker4').datetimepicker({
	format: 'YYYY/MM/DD'
});
$('#datetimepicker4').val(currentDate);
$('#datetimepicker4').datetimepicker({
	useCurrent: false
});
$('#datetimepicker4').datetimepicker().on('dp.change', function() {
	statisticsTagsInRecruitmentByRangeDate();	
});

$('#limit2').on('change', function() {
	statisticsTagsInRecruitmentByRangeDate();		
});
// ---------------------------------

$('#datetimepicker5').datetimepicker({
	format: 'YYYY/MM/DD'
});
$('#datetimepicker5').val(firstDay);
$('#datetimepicker5').datetimepicker({
	useCurrent: false
});
$('#datetimepicker5').datetimepicker().on('dp.change', function() {
	fetchUserTypes();	
});

// -----------
$('#datetimepicker6').datetimepicker({
	format: 'YYYY/MM/DD'
});
$('#datetimepicker6').val(firstDay);
$('#datetimepicker6').datetimepicker({
	useCurrent: false
});
$('#datetimepicker6').datetimepicker().on('dp.change', function() {
	fetchTopBrowsers();
});



var presets = window.chartColors;
var utils = Samples.utils;

var element = document.getElementById('bar-chart');
var abc = new Chart(element, {
	type: 'line',
	data: {
		labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
		datasets: [{
			backgroundColor: utils.transparentize(presets.blue),
			borderColor: presets.blue,
			data: [],
			label: 'Số lượng tin tuyển dụng'
		}]
	},
	options:{
		maintainAspectRatio: true,
		spanGaps: true,
		elements: {
			line: {
				tension: 0.3
			}
		}
		,
		plugins: {
			filler: {
				propagate: false
			}
		},
		scales: {
			xAxes: [{
				ticks: {
					autoSkip: false,
					maxRotation: 3
				}
			}]
		}
	},

});


// [13]
var config13 = {
	type: 'doughnut',
	data: {
		datasets: [{
			data: [],
			backgroundColor: [
			window.chartColors.orange,
			window.chartColors.green,
			window.chartColors.red,
			'#66ff33',
			'#1a75ff',
			'#ffff00',
			window.chartColors.purple,
			'#cc0000',
			'#00cccc'
			],
			label: 'Dataset 1'
		}],
		labels: []
	},
	options: {
		responsive: true,
		legend: {
			position: 'top',
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	}
};

var ctx13 = document.getElementById('chart-area13').getContext('2d');
var chart13 = new Chart(ctx13, config13);



// [12]
var config12 = {
	type: 'doughnut',
	data: {
		datasets: [{
			data: [],
			backgroundColor: [
			window.chartColors.red,
			window.chartColors.green
			],
			label: 'Dataset 1'
		}],
		labels: ['Người truy cập mới', 'Người truy cập cũ']
	},
	options: {
		responsive: true,
		legend: {
			position: 'top',
		},
		animation: {
			animateScale: true,
			animateRotate: true
		}
	}
};

var ctx12 = document.getElementById('chart-area12').getContext('2d');
var chart12 = new Chart(ctx12, config12);




var barChartData = {
	labels: ["Label1", "Label2", "Label3", "Label4", "Label5"],
	datasets: [{
		"label": "Số lượng ứng viên",
		"xAxisID": "v",
		"backgroundColor": "rgba(53,81,103,1)",
		"data": []
	}, {
		"label": "Số lượng CV",
		"xAxisID": "v",
		"backgroundColor": "rgba(255,153,0,1)",
		"data": []
	}]
}

var ctx = document.getElementById('canvas22');
var chart = new Chart(ctx, {
	type: 'horizontalBar',
	data: barChartData,
	options: {
		scales: {
			xAxes: [{
				position: "top",
				id: "v",
				type: 'linear'
			}]
		}
	}
});

	// [4] [5]
	var statisticsNumberOfViewConfig = {
		type: 'pie',
		data: {
			datasets: [{
				data: [],
				backgroundColor:
				[ 
				window.chartColors.blue,
				window.chartColors.orange
				]
			}],
			labels: []
		},
		options: {
			responsive: true
		}
	};

	var statisiticsRecruitmentCategoryConfig = {
		type: 'pie',
		data: {
			datasets: [{
				data: [],
				backgroundColor: palette('tol',10).map(function(hex) {
					return '#' + hex;
				})
			}],
			labels: [
			'Full-time',
			'Part-time',
			'Intership',
			'Full-time & Part-time',
			'Full-time & Intership',
			'Part-time & Intership',
			'Full-time & Part-time & Intership'
			]
		},
		options: {
			responsive: true
		}
	};

// [10]
var ctx10 = document.getElementById('canvas10');

var char10Config = new Chart(ctx10,{
	type: 'horizontalBar',
	data: {
		labels: [],
		datasets: [{
			label:'',
			backgroundColor:[],
			"xAxisID": "a",
			data: []
		}]
	},
	options: {
		scales: {
			xAxes: [{
				position: "top",
				id: "a",
				type: 'linear'
			}]
		},
		elements: {
			rectangle: {
				borderWidth: 2,
			}
		},
		responsive: true
	}
});


// [11]
var ctx11 = document.getElementById('canvas11');
var char11Config = new Chart(ctx11,{
	type: 'horizontalBar',
	data: {
		labels: [],
		datasets: [{
			label:'',
			backgroundColor:[],
			"xAxisID": "a",
			data: []
		}],

	},
	options: {
		scales: {
			xAxes: [{
				position: "top",
				id: "a",
				type: 'linear'
			}]
		},
		elements: {
			rectangle: {
				borderWidth: 2,
			}
		},
		responsive: true
	}
});


var myHorizontalBarConfig = {
	type: 'horizontalBar',
	data: {
		labels: [],
		datasets: [{
			label:'',
			backgroundColor: palette('tol',10).map(function(hex) {
				return '#' + hex;
			}),
			"xAxisID": "a",
			data: []
		}],

	},
	options: {
		scales: {
			xAxes: [{
				position: "top",
				id: "a",
				type: 'linear'
			}]
		},
		elements: {
			rectangle: {
				borderWidth: 2,
			}
		},
		responsive: true
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

		//window.onload = function() {

			// var ctx = document.getElementById("bar-chart");
			// var statisiticsRecruitmentByYearChart = new Chart(ctx,statisiticsRecruitmentByYearConfig);

			// var ctx = document.getElementById('chart-area');
			// var statisiticsRecruitmentCategoryChart = new Chart(ctx, statisiticsRecruitmentCategoryConfig);

			// var ctx = document.getElementById('canvas');
			// var myHorizontalBar = new Chart(ctx, myHorizontalBarConfig);
	//	};

	$('.year-select2').on("change", function(){
		$('.current-year').text($(this).val());
		statisiticsRecruitmentByYear($(this).val());
	});

	statisiticsRecruitmentByYear(2018);
	statisticsCategiesOfRecruitments();	
	statisticsNumberOfRecruitmentByAllFaculties();
	statisticsNumberOfView();
	statisticsStudentAndCVByFaculty();
	statisticsTagsInStudentByRangeDate();
	statisticsTagsInRecruitmentByRangeDate();
	fetchUserTypes();
	fetchTopBrowsers();


	//[13]
	function fetchTopBrowsers(){

		var oldDate = $('#datetimepicker6').val();

		var data = {
			"oldDate": oldDate
		}

		$.ajax({
			url: 'statistics/fetchTopBrowsers',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			data: data,
			dataType: 'json',

			success: function(data) {

				var arrdata = new Array();
				var arrlable = new Array();

				for(i = 0; i < data.length; i++ ){
					arrdata.push(data[i].sessions);
					arrlable.push(data[i].browser);				
				}
				config13.data.datasets[0].data = arrdata;
				config13.data.labels = arrlable;

				console.log(config13);

				chart13.update();
			}

		});
	}

//[12]
function fetchUserTypes(){

	var oldDate = $('#datetimepicker5').val();

	var data = {
		"oldDate": oldDate
	}

	$.ajax({
		url: 'statistics/fetchUserTypes',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'post',
		data: data,
		dataType: 'json',

		success: function(data) {

			var arrdata = new Array();
			for(i = 0; i < data.length; i++ ){
				arrdata.push(data[i].sessions);
			}
			config12.data.datasets[0].data = arrdata;
			chart12.update();
		}

	});
}

	// [10]
	function statisticsTagsInStudentByRangeDate(){

		var start = $('#datetimepicker1').val();

		var end =  $('#datetimepicker2').val();

		var limit = $('#limit1').val();

		var data = {
			"from": start,
			"to": end,
			"limit": limit
		}

		$.ajax({
			url: 'statistics/statisticsTagsInStudentByRangeDate',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'post',
			data: data,
			dataType: 'json',

			success: function(data) {

				var arrdata = new Array();
				var arrlable = new Array();

				for(i = 0; i < data.length; i++ ){
					arrdata.push(data[i].usedCount);
					arrlable.push(data[i].tagName);
				}


				char10Config.data.datasets[0].data = arrdata;
				char10Config.data.labels = arrlable;

				char10Config.data.datasets[0].backgroundColor = palette('tol',data.length).map(function(hex) {
					return '#' + hex;
				});

				char10Config.update();

				// var ctx = document.getElementById('canvas');
				// var myHorizontalBar = new Chart(ctx, myHorizontalBarConfig);
			}

		});
	}

		// [11]
		function statisticsTagsInRecruitmentByRangeDate(){

			var start = $('#datetimepicker3').val();

			var end =  $('#datetimepicker4').val();

			var limit = $('#limit2').val();

			var data = {
				"from": start,
				"to": end,
				"limit": limit
			}

			$.ajax({
				url: 'statistics/statisticsTagsInRecruitmentByRangeDate',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'post',
				data: data,
				dataType: 'json',

				success: function(data) {
					
					var arrdata = new Array();
					var arrlable = new Array();

					for(i = 0; i < data.length; i++ ){
						arrdata.push(data[i].usedCount);
						arrlable.push(data[i].tagName);
					}


					char11Config.data.datasets[0].data = arrdata;
					char11Config.data.labels = arrlable;

					char11Config.data.datasets[0].backgroundColor = palette('tol',data.length).map(function(hex) {
						return '#' + hex;
					});

					char11Config.update();
				}

			});
		}

		// [7]
		function statisticsStudentAndCVByFaculty(){
			$.ajax({
				url: 'statistics/statisticsStudentAndCVByFaculty',
				type: 'GET',
				dataType: 'json',

				success: function(data) {
					
					var arrdata1 = new Array();
					var arrdata2 = new Array();
					var arrlable = new Array();

					for(i = 0; i < data[0].length; i++ ){
						arrdata1.push(data[0][i].studentCount);
						arrdata2.push(data[1][i].cvCount);

						arrlable.push(data[0][i].facultyName);
					}

					barChartData.labels = arrlable;
					barChartData.datasets[0].data = arrdata1;
					barChartData.datasets[1].data = arrdata2;

					chart.update();


					// statisticsStudentByFacultyConfig.data.datasets[0].data = arrdata;
					// statisticsStudentByFacultyConfig.data.labels = arrlable;

					// var ctx = document.getElementById('canvas1');
					// var myHorizontalBar = new Chart(ctx, statisticsStudentByFacultyConfig);
				}

			});
		}

		// [4] [5]
		function statisticsNumberOfView(){
			$.ajax({
				url: 'statistics/statisticsNumberOfView',
				type: 'GET',
				dataType: 'json',

				success: function(data) {
					
					var arrdata = new Array();
					var arrlabel = new Array();

					for(i = 0; i < data.length; i++ ){
						arrlabel.push(data[i].viewType);
						arrdata.push(data[i].numberOfView);
					}

					statisticsNumberOfViewConfig.data.datasets[0].data= arrdata;
					statisticsNumberOfViewConfig.data.labels = arrlabel;

					var ctx = document.getElementById('chart-area1');
					var statisticsNumberOfViewChart = new Chart(ctx, statisticsNumberOfViewConfig);
				}

			});
		}

		// [3]
		function statisticsCategiesOfRecruitments(){
			$.ajax({
				url: 'statistics/statisticsCategiesOfRecruitments',
				type: 'GET',
				dataType: 'json',

				success: function(data) {
					
					var arrdata = new Array();

					for(i = 0; i < data.length; i++ ){
						arrdata.push(data[i].RecruitmentCount);
					}

					statisiticsRecruitmentCategoryConfig.data.datasets[0].data= arrdata;

					var ctx = document.getElementById('chart-area');
					var statisiticsRecruitmentCategoryChart = new Chart(ctx, statisiticsRecruitmentCategoryConfig);
				}

			});
		}

		// [2]
		function statisticsNumberOfRecruitmentByAllFaculties(){
			$.ajax({
				url: 'statistics/statisticsNumberOfRecruitmentByAllFaculties',
				type: 'GET',
				dataType: 'json',

				success: function(data) {
					
					var arrdata = new Array();
					var arrlable = new Array();

					for(i = 0; i < data.length; i++ ){
						arrdata.push(data[i].RecruitmentCount);
						arrlable.push(data[i].FacultyName);
					}


					myHorizontalBarConfig.data.datasets[0].data= arrdata;
					myHorizontalBarConfig.data.labels = arrlable;


					var ctx = document.getElementById('canvas');
					var myHorizontalBar = new Chart(ctx, myHorizontalBarConfig);
				}

			});
		}

		// [1]
		function statisiticsRecruitmentByYear(year){
			$.ajax({
				url: 'statistics/statisticsNumberOfRecruitmentByYear/' + year,
				type: 'GET',
				dataType: 'json',

				success: function(data) {


					
					var arr = new Array();

					for(i = 1; i <= 12; i++ ){
						arr.push(data[i])
					}

					abc.data.datasets[0].data = arr;
					abc.update();

					// statisiticsRecruitmentByYearConfig.data.datasets[0].data = arr;

					 // var ctx = document.getElementById("bar-chart");
					 // var statisiticsRecruitmentByYearChart = new Chart(ctx,statisiticsRecruitmentByYearConfig);
					}

				});
		}

	</script>
	@endsection