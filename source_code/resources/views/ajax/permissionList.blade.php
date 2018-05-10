<div class="row" style="margin-left: 10px">
	<div class="col-lg-6 col-sm-6">
	<label>BLOG</label>
	@foreach ($permissions as $permission)
	@if($permission->for == 'blog')
	<div class="form-group">
		<div class="checkbox">
			<label class="col-lg-12"><input type="checkbox" name="permission[]" value="{!! $permission->id !!}"
				@foreach ($staff->account->permissions as $acc_permission)
				@if ($acc_permission->id == $permission->id)
				checked
				@endif
				@endforeach
				/>{!! $permission->name !!}
			</label>
		</div>
	</div>
	@endif
	@endforeach
</div>
<div class="col-lg-6 col-sm-6">
	<label>RECRUITMENT</label>
	@foreach ($permissions as $permission)
	@if($permission->for == 'recruitment')
	<div class="form-group">
		<div class="checkbox">
			<label class="col-lg-12"><input type="checkbox" name="permission[]" value="{!! $permission->id !!}"
				@foreach ($staff->account->permissions as $acc_permission)
				@if ($acc_permission->id == $permission->id)
				checked
				@endif
				@endforeach
				/>{!! $permission->name !!}
			</label>
		</div>
	</div>
	@endif
	@endforeach
</div>
</div>
<hr>
<div class="row" style="margin: 10px 0 0 10px;">
	<div class="col-lg-6 col-sm-6" >
	<label>FACULTY</label>
	@foreach ($permissions as $permission)
	@if($permission->for == 'faculty')
	<div class="form-group">
		<div class="checkbox">
			<label class="col-lg-12"><input type="checkbox" name="permission[]" value="{!! $permission->id !!}"
				@foreach ($staff->account->permissions as $acc_permission)
				@if ($acc_permission->id == $permission->id)
				checked
				@endif
				@endforeach
				/>{!! $permission->name !!}
			</label>
		</div>
	</div>
	@endif
	@endforeach
</div>
<div class="col-lg-6 col-sm-6">
	<label>COMPANY</label>
	@foreach ($permissions as $permission)
	@if($permission->for == 'company')
	<div class="form-group">
		<div class="checkbox">
			<label class="col-lg-12"><input type="checkbox" name="permission[]" value="{!! $permission->id !!}"
				@foreach ($staff->account->permissions as $acc_permission)
				@if ($acc_permission->id == $permission->id)
				checked
				@endif
				@endforeach
				/>{!! $permission->name !!}
			</label>
		</div>
	</div>
	@endif
	@endforeach
</div>
</div>








