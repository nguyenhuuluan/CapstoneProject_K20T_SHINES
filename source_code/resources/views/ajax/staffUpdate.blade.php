<div class="form-group col-lg-6 col-sm-12">
	<label>Tên:</label>
	<input type="text" name="name" id="name" class="form-control" value="{!! $staff->name !!}" required/>
</div>
<div class="form-group col-lg-6 col-sm-12">
	<label>Điện thoại:</label>
	<input type="text" name="phone" id="phone" class="form-control" value="{!! $staff->phone !!}" required/>
</div>
<div class="form-group col-lg-6 col-sm-12">
	<label>Email:</label>
	<input type="text" name="email" id="email" class="form-control" value="{!! $staff->email !!}" required/>
</div>
<div class="form-group col-lg-6 col-sm-12">
	<label>Tài khoản đăng nhập:</label>
	<input type="text" name="account" id="account" class="form-control" value="{!! $staff->account->username !!}" required/>
</div>
