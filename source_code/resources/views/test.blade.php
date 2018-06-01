@extends('layouts.master-layout',['title' => 'Cập nhật hồ sơ sinh viên', 'isDisplaySearchHeader' => false])

@section('stylesheet')
<link rel="stylesheet" href="{{asset('assets/vendors/modal-confirm/jquery-confirm.min.css')}}">
<link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.3.6/cropper.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.3.6/cropper.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
<style type="text/css">
/* Tooltip container */
.tooltipsave {
	position: relative;
	display: inline-block;
	border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltipsave .tooltiptext {
	visibility: hidden;
	width: 120px;
	background-color: black;
	color: #fff;
	text-align: center;
	border-radius: 6px;
	top: -5px;
	right: 105%; 

	/* Position the tooltip text - see examples below! */
	position: absolute;
	z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltipsave:hover .tooltiptext {
	visibility: visible;
}

#myBtn {
	position: fixed;
	display: inline-block;
	bottom: 72px;
	right: 30px;
	z-index: 99;
	width: 40px;
	height: 40px;
	line-height: 40px;
	font-size: 22px;
	text-align: center;
	border: none;
	outline: none;
	background-color: red;
	color: white;

	border-radius: 4px;
	opacity: 0.5;
}

#myBtn:hover {
	background-color: red;
	opacity: 1;
}

@media (max-width:991px) {
	#myBtn {
		right:15px;
		bottom:39px;
		width:34px;
		height:34px;
		line-height:34px;
		font-size:18px;
	}
}
</style>
@endsection

@section('page-header')
<!-- Page header -->
<header class="page-header bg-img size-lg" style="background-image: url({{ asset('assets/img/O7MF5N0.jpg') }} )">
	<div class="container page-name">
		<h1 class="text-center">Thêm hồ sơ của bạn</h1>
		<p class="lead text-center">Tạo hồ sơ của bạn và cho nhà tuyển dụng nhìn thấy nó.</p>
	</div>
</header>
<!-- END Page header -->
@endsection

@section('content')	
<main>
	<div class="container">
		<div class="row">
			<div>
				
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<div>
							<img id="image" src="{{ asset('assets/1.JPG') }}" style="max-width: 100%;">
						</div>
						<span class="help-block">Xin vui lòng chọn ảnh 4:6</span>
						<button name="crop" id="crop">crop</button>
						<small class="text-success update-ava-noti" style="display: none;">Đã cập nhật avatar thành công!</small>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						<div>
							<img id="image2" src="{{ asset('assets/1.JPG') }}" style="max-width: 100%;">
						</div>
					</div>
				</div>
				
			</div>
			
		</div>

	</div>


</main>
<button class="tooltipsave" id="myBtn"><i class="fa fa-save" aria-hidden="true"></i><span class="tooltiptext">Lưu hồ sơ</span></button>
@endsection

@section('scripts')
<script type="text/javascript">
	var image = document.getElementById('image');
	var image2 = document.getElementById('image2');
	var cropper = new Cropper(image, {
		aspectRatio: 16 / 9,
		viewMode: 1,
		guides: false, // show duong net dut
		dragMode: 'move',  //di chuyen khungcanvas
		// movable: false,
		minCropBoxWidth: 80,
		minCropBoxHeight: 45,
		// cropBoxResizable: false, //ko cho phep resize khung crop
		crop: function(event) {
			console.log(event.detail.x);
			console.log(event.detail.y);
			console.log(event.detail.width);
			console.log(event.detail.height);
			console.log(event.detail.rotate);
			console.log(event.detail.scaleX);
			console.log(event.detail.scaleY);
		}
	});

	$('#crop').on('click', function(){
		// cropper.zoom();
		var tmp = cropper.getCroppedCanvas();
		cropper.getCroppedCanvas({
		  width: 160,
		  height: 90,
		  minWidth: 256,
		  minHeight: 256,
		  maxWidth: 4096,
		  maxHeight: 4096,
		  fillColor: '#fff',
		  imageSmoothingEnabled: false,
		  imageSmoothingQuality: 'high',
		});

		cropper.getCroppedCanvas().toBlob(function (blob) {
				  var formData = new FormData();

				  formData.append('croppedImage', blob);

				  // Use `jQuery.ajax` method
				  $.ajax({
				  	url: '{{ route('testupload') }}',
				    method: "POST",
				    data: formData,
				    processData: false,
				    contentType: false,
				    success: function (data) {
				      console.log(data);
				    },
				    error: function (data) {
				      console.log(data);
				    }
				  });
				});
		console.log(tmp);
	})
</script>
@endsection
