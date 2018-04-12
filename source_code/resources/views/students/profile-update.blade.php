@extends('layouts.master-layout',['title' => 'Cập nhật hồ sơ sinh viên', 'isDisplaySearchHeader' => false])

@section('stylesheet')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
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
				{!! Form::open(['method'=>'POST', 'action'=> ['StudentController@editPhoto', $student->id], 'files'=>true, 'id'=>'upload_ava']) !!}
				<div class="col-xs-12 col-sm-4">
					<div class="form-group">
						{!! Form::file('photo', ['class'=>'dropify', 'data-height'=>'300', 'data-max-file-size'=>'1M' ,'data-default-file'=> asset(Auth::user()->student->photo), 'id'=>'photo' ])!!}
						<input id="studentID" type="hidden" name="id" value="{{ Auth::user()->student->id}}">
						<span class="help-block">Xin vui lòng chọn ảnh 4:6</span>
						{{-- {!! Form::submit('Cập nhật avatar', ['class'=>'btn btn-xs btn-danger pull-right upload-ava']) !!} --}}
						<small class="text-success update-ava-noti" style="display: none;">Đã cập nhật avatar thành công!</small>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
			<div>
				{!! Form::model( $student, ['method'=>'POST', 'action'=>['StudentController@editProfile', $student->id], 'id'=>'updateForm','files'=>true]) !!}

				<div class="col-xs-12 col-sm-8">
					<div class="form-group col-xs-12 col-sm-12">
						{!! Form::text('name', null, ['class'=>'form-control input-lg', 'placeholder'=> 'Họ tên', 'required']) !!}
					</div>
					<div class="form-group col-xs-12 col-sm-12">
						{!! Form::textarea('description' , null,['class'=>'form-control', 'rows'=>3, 'placeholder'=>'Mô tả ngắn về bạn']) !!}
					</div>
				</div>
				<div class="col-xs-12 col-sm-8">
					<h6 class="col-xs-12 col-sm-12">Thông tin cơ bản</h6>
					<div class="form-group col-xs-12 col-sm-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
							{!! Form::date('dateofbirth', old('dateofbirth'), ['class'=>'form-control', 'required']) !!}
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
							{!! Form::select('faculty_id', $faculties ,null, ['class'=>'form-control', 'title'=>'Chưa chọn Khoa']) !!}
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-phone"></i></span>
							{!! Form::text('phone', null, ['class'=>'form-control', 'placeholder'=> 'Số điện thoại', 'required']) !!}
						</div>
					</div>

					<div class="form-group col-xs-12 col-sm-6">
						<div class="input-group input-group-sm">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							{!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=> 'Email', ' disabled']) !!}
						</div>
					</div>

				</div>

				<div class="col-xs-12 col-sm-8">
					<h6 class="col-xs-12 col-sm-12">Danh sách tag</h6>
					<span class="col-xs-12 col-sm-12 help-block">Viết tag và nhấn enter</span>

					<div class="form-group col-xs-12 col-sm-12 {{ $errors->has('tags.*') ? ' has-error' : '' }}">

						{!! Form::text('tags', $tags, ['class'=>'tagsinput 123input tm-input form-control tm-input-info tagsinput-typeahead','data-role'=>'tagsinput', 'placeholder'=> 'Nhập tag', 'value'=> old('tags')]) !!}

						{{-- 	@if ($errors->has('tags2.*'))
							<span class="help-block">
								<strong>Tồn tại TAG không có trong hệ thống!</strong>
							</span>
							@endif --}}
						</div>
					</div>

					<div class="col-xs-12 col-sm-12">
						<hr class="hr-lg">
						<!-- Work Experience -->
						<section class="bg-alt">
							<div class="container">
								<header class="section-header">
									<br>
									<h2>Kinh nghiệm làm việc</h2>
								</header>

								<div class="row">
									@if(count($exps)>0)
									@foreach ($exps as $exp)
									<div class="col-xs-12" style="width: 97.5%;">
										<div class="item-block">
											<div class="item-form">
												<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
												<div class="row">
													<div class="col-xs-12 col-sm-12">
														<div class="form-group">
															{!! Form::text('exTitle[]', $exp->title, ['class'=>'form-control', 'placeholder'=> 'Tên công ty / Đồ án đã làm']) !!}
															{!! Form::text('position[]', $exp->role, ['class'=>'form-control', 'placeholder'=> 'Vị trí / Vai trò']) !!}
															<div class="input-group">
																<span class="input-group-addon">Từ</span>
																{!! Form::date('datestart[]', $exp->from, ['class'=>'form-control']) !!}
																{{-- <input class="form-control" type="date" name="datestart[]" value="2011-08"> --}}
																<span class="input-group-addon">Đến</span>
																{!! Form::date('dateend[]', $exp->to, ['class'=>'form-control']) !!}
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@else
									<div class="col-xs-12" style="width: 97.5%;">
										<div class="item-block">
											<div class="item-form">
												<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
												<div class="row">
													<div class="col-xs-12 col-sm-12">
														<div class="form-group">
															{!! Form::text('exTitle[]', null, ['class'=>'form-control', 'placeholder'		=> 'Tên công ty / Đồ án đã làm']) !!}
															{!! Form::text('position[]', null, ['class'=>'form-control', 'placeholder'=> 'Vị trí / Vai trò']) !!}
															<div class="input-group">
																<span class="input-group-addon">Từ</span>
																{!! Form::date('datestart[]', null, ['class'=>'form-control']) !!}
																<span class="input-group-addon">Đến</span>
																{!! Form::date('dateend[]', null, ['class'=>'form-control']) !!}
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif


									<div class="col-xs-12 duplicateable-content" style="width: 97.5%;">
										<div class="item-block">
											<div class="item-form">
												<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
												<div class="row">
													<div class="col-xs-12 col-sm-12">
														<div class="form-group">
															{!! Form::text('exTitle[]', null, ['class'=>'form-control', 'placeholder'		=> 'Tên công ty / Đồ án đã làm']) !!}
															{!! Form::text('position[]', null, ['class'=>'form-control', 'placeholder'=> 'Vị trí / Vai trò']) !!}
															<div class="input-group">
																<span class="input-group-addon">Từ</span>
																{!! Form::date('datestart[]', null, ['class'=>'form-control']) !!}
																<span class="input-group-addon">Đến</span>
																{!! Form::date('dateend[]', null, ['class'=>'form-control']) !!}
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xs-12 text-center">
										<br>
										<button class="btn btn-primary btn-duplicator">Thêm kinh nghiệm làm việc</button>
									</div>
								</div>
							</div>
						</section>
						<!-- END Work Experience -->
						<hr>
						<!-- Skills-->
						<section class="bg-alt">
							<div class="container">
								<header class="section-header">
									<br>
									<h2>Kĩ năng</h2>
								</header>
								<div class="row select-rage">

									@if(count($skills)>0)
									@foreach ($skills as $skill)
									<div class="col-xs-12" style="width: 97.5%">
										<div class="item-block">
											<div class="item-form">
												<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
												<div class="row">
													<div class="col-xs-12 col-sm-6">
														<div class="form-group">
															{!! Form::text('skills[]', $skill->name, ['class'=>'form-control', 'placeholder'=> 'Tên kĩ năng, vd. HTML']) !!}
														</div>
													</div>
													<div class="col-xs-12 col-sm-6">
														{{-- <div class="form-group">
															{{ Form::selectRangeWithInterval('rating[]', 0, 100, 5, $skill->rating, ['class' => 'form-control input-xs']) }}

														</div> --}}

														<div class="slidecontainer">
															<input name="rating[]" type="range" min="1" max="100" value="{!! $skill->rating !!}" class="slider" id="myRange" style="margin-top: 12px;">
															<center><p><span id="demo">{!! $skill->rating !!}</span>%</p></center>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
									@else
									<div class="col-xs-12" style="width: 97.5%">''
										<div class="item-block">
											<div class="item-form">
												<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
												<div class="row">
													<div class="col-xs-12 col-sm-6">
														<div class="form-group">
															{!! Form::text('skills[]', '', ['class'=>'form-control', 'placeholder'=> 'Tên kĩ năng, vd. HTML']) !!}
														</div>
													</div>
													<div class="col-xs-12 col-sm-6">
														<div class="slidecontainer">
															<input name="rating[]" type="range" min="1" max="100" value="50" class="slider" id="myRange" style="margin-top: 12px;">
															<center><p><span id="demo">50</span>%</p></center>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endif
									<div class="col-xs-12 duplicateable-content" style="width: 97.5%">
										<div class="item-block">
											<div class="item-form">
												<button class="btn btn-danger btn-float btn-remove"><i class="ti-close"></i></button>
												<div class="row">
													<div class="col-xs-12 col-sm-6">
														<div class="form-group">
															{!! Form::text('skills[]', '', ['class'=>'form-control', 'placeholder'=> 'Tên kĩ năng, vd. HTML']) !!}
														</div>
													</div>
													<div class="col-xs-12 col-sm-6">
														<div class="slidecontainer">
															<input name="rating[]" type="range" min="1" max="100" value="50" class="slider" id="myRange" style="margin-top: 12px;">
															<center><p><span id="demo">50</span>%</p></center>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xs-12 text-center">
										<br>
										<button class="btn btn-primary btn-duplicator">Thêm kĩ năng</button>
									</div>
								</div>
							</div>
						</section>
						<!-- END Skills-->
						<section class="bg-alt">
							<p class="text-center"><button class="btn btn-danger btn-xl btn-round">Cập nhật hồ sơ</button></p>
						</section>
						<hr>
					</div>
					{!! Form::close() !!}
				</div>
			</div>

			<div class="row">
				{!! Form::open(['method'=>'POST', 'action' => ['Student\StudentCvController@store', $student->id], 'enctype'=>'multipart/form-data', 'id'=>'upload_cv']) !!}
				<section class="bg-alt">
					<div class="container">
						<header class="section-header">
							<br>
							<h2>Quản lý CV</h2>
						</header>
						<div class="row">
							<div class="col-xs-12">
								<div class="table-responsive">
									<table class="table table-striped table-bordered-company">
										<thead>
											<tr>
												<th>Tên CV</th>
												<th>Ngảy tải lên</th>
												<th>Thao tác</th>
											</tr>
										</thead>
										<tbody class="cv-info">
										</tbody>
									</table>
									<small class="text-success upload-cv-noti" style="display: none;"><b>Upload CV thành công!</b></small>
									<small class="text-danger delete-cv-noti" style="display: none;"><b>Xóa CV thành công!</b></small>
								</div>
							</div>
						</div>
					</div>
					<h4>Tải lên CV</h4>
					<div class="container">
						
						<!-- COMPONENT START -->
						{!! Form::file('cv', ['class'=>'form-control', 'placeholder'=>'Chọn CV của bạn...', 'accept'=>'.pdf,.png,.jpeg,.jpg,.doc,.docx', 'id'=>'cv' ])!!}
						<span class="col-xs-12 col-sm-12 help-block">Vui lòng chọn file dung lượng dưới 2MB và đúng định dạng .pdf .docx .png .jpg .jpeg</span>
						<br>
						{!! Form::submit('Tải lên', ['class'=>'btn btn-primary pull-right upload-cv']) !!}
							{{-- <div class="modelFootr">
								<button type="submit" class="btn btn-primary pull-right upload-cv">Tải lên</button>
							</div> --}}
							{!! Form::close() !!}
							<!-- COMPONENT END -->

						</div>
					</section>
				</div>

			</div>
{{-- 			<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=https://www.leaf-vn.org/PDF-0CONVERSION-rev2.pdf' width='px' height='px' frameborder='0'>
</iframe> --}}
			
		</main>
		<button class="tooltipsave" onclick="document.getElementById('updateForm').submit(); " id="myBtn"><i class="fa fa-save" aria-hidden="true"></i><span class="tooltiptext">Lưu hồ sơ</span></button>
		@endsection

		@section('scripts')
		<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js" type="text/javascript" charset="utf-8"></script>


		<script type="text/javascript">
			showCv();

			$('#photo').bind("change", function () {
				updateAvatar();
			});

			function updateAvatar(){
				var id = $('#studentID').val();
				var photo = document.getElementById("photo").files[0];
				var urlImg = '{{ route('student.photo.edit') }}';
				var data = new FormData();
				data.append("id", id);
				data.append("photo", photo);

				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type:'POST',
					url: urlImg,
					data:data,
					cache:false,
					contentType: false,
					processData: false,
					success:function(data){
						document.getElementById('avatarAccount').src = '{{ asset('') }}'+data;
						$( ".update-ava-noti" ).fadeIn( 300 ).delay( 2000 ).fadeOut( 00 );
					},
					error: function(data){
						alert('Kiểm tra lại avatar upload đúng định dạng!');
					}
				});

			}


			$(document).ready(function (e) {
				// -----upload cv
				$('#upload_cv').on('submit',(function(e) {
					e.preventDefault();
					var formData = new FormData(this);

					$.ajax({
						type:'POST',
						url: $(this).attr('action'),
						data:formData,
						cache:false,
						contentType: false,
						processData: false,
						success:function(data){
							$( ".upload-cv-noti" ).fadeIn( 300 ).delay( 2000 ).fadeOut( 00 );
							$('.cv-info').append(data.cvs);
						},
						error: function(data){
							alert('Kiểm tra lại CV upload đúng định dạng!');
							$("#cv").val('');
						}
					});
				}));

				$('.cv-info').on('click', '#delete', function(event) {
					event.preventDefault();
					var currentelement = $(this);
					var id = $(this).attr("data-id");
					var url = '{{ route("student.cv.destroy")}}';
					var data = new FormData();
					data.append("id", id);

					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						type: 'POST',
						url: url,
						contentType: false,
						processData: false,
						cache:false,
						data: data,
						success: function (response) {
							$(".delete-cv-noti" ).fadeIn( 300 ).delay( 2000 ).fadeOut( 00 );
							currentelement.parent().parent().remove();
							console.log(response)
						},
						error: function (response) {
							alert('error');
							console.log(response)
						}
					});

			});

			});


			function showCv () {
				$.get("{{ route('student.cv.show') }}", function(data){
					$('.cv-info').empty().html(data)
				})
			}

		</script>

		<script type="text/javascript">
			$('.select-rage').on('change', '#myRange', function(event) {
				event.preventDefault();

				var value = $(this).val();	

				$(this).closest('div').find('span').html(value);
			});


			var tagnames = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace("name"),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				prefetch: {
					url:'../../tags',
					filter: function(list) {
						return $.map(list, function(tagname) {
							return { name: tagname }; });
					}
				}
			});
			tagnames.initialize();
			$('.tagsinput').tagsinput({
				typeaheadjs: {
					name: 'tags',
					displayKey: 'name',
					valueKey: 'name',
					source: tagnames.ttAdapter(),
					templates: {
						empty: [
						'<div class="list-group search-results-dropdown"><div class="list-group-item">Không có kết quả phù hợp.</div></div>'
						],
						header: [
						'<div class="list-group search-results-dropdown">'
						],
						suggestion: function (data) {
							return '<p class="list-group-item">' + data.name + '</p>'
						}
					}
				}
			});
		</script>

		<script>

			$('.dropify').dropify({
				error: {
					'fileSize': 'The file size is too big (30 max).',
					'minWidth': 'The image width is too small (30 px min).',
					'maxWidth': 'The image width is too big (30 px max).',
					'minHeight': 'The image height is too small (30 px min).',
					'maxHeight': 'The image height is too big (30 x max).',
					'imageFormat': 'The image format is not allowed (30 only).'
				}
			});


			// // When the user scrolls down 20px from the top of the document, show the button
			// window.onscroll = function() {scrollFunction()};

			// function scrollFunction() {
			// 	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			// 		document.getElementById("myBtn").style.display = "block";
			// 	} else {
			// 		document.getElementById("myBtn").style.display = "none";
			// 	}
			// }
		</script>
		@endsection