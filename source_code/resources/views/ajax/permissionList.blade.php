	<div class="col-lg-4">
		<label for="name">BLOG</label>
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
					/>{!! $permission->name !!}</label>
				</div>
			</div>
			@endif
			@endforeach
		</div>

		<div class="col-lg-4">
			<label for="name">RECRUITMENT</label>
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
						/>{!! $permission->name !!}</label>
					</div>
				</div>
				@endif
				@endforeach
			</div>


