

	<!doctype html>
	<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
	xmlns:o="urn:schemas-microsoft-com:office:office">

	<head>
		<title></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	</head>



	<body>
		<div style="background-color:#fff;margin:0 auto 0 auto;padding:30px 0 30px 0;color:#4f565d;font-size:13px;line-height:20px;font-family:'Helvetica Neue',Arial,sans-serif;text-align:left;">
			<center>
				<table style="width:550px;text-align:center">
					<tbody>
						<tr>
							<td style="padding:0 0 20px 0;border-bottom:1px solid #e9edee;">
								<a href="{{ route('index') }}" style="display:block; margin:0 auto;" target="_blank">
									<img style="display: block;height: auto;width: 100%;border: 0;max-width: 512px;" src="https://image.ibb.co/egY2EG/logo.png" alt="logo" border="0" />
								</a>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:30px 0;">
								<p style="color:#1d2227;line-height:28px;font-size:22px;margin:12px 10px 20px 10px;font-weight:400;">Xin chào {{$account->username}}</p>
								<p style="margin:0 10px 10px 10px;padding:0;font-weight:350;">Rất vui vì bạn đã tham gia VanLang E-Recruiting, Ấn nút phía dưới để xác nhận và cập nhật thông tin, cảm ơn.</p>
								<p>
									<a style="display:inline-block;text-decoration:none;padding:15px 20px;border:1px solid #2baaed;border-radius:3px;color:#2baaed;font-weight:bold;" href="{{Route('student.confirm', ['token' => $account -> remember_token]) }}" target="_blank">Xác nhận và Cập nhật thông tin</a>
								</p>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:30px 0 0 0;border-top:1px solid #e9edee;color:#9b9fa5">
								Nếu bạn có bất kì thắc mắc nào, đừng ngần ngại liên hệ với chúng tôi tại <a style="color:#666d74;text-decoration:none;" href="#" target="_blank">liên hệ</a>
								<br>
								<br>
								<br>
								<br>
								<br>
								<br>

								Đại Học Văn Lang
								<br>
								Số 45, Nguyễn Khắc Nhu, P. Cô Giang, Quận 1, TP. Hồ Chí Minh.
								<br>
								<p>Email được gửi bởi VanLang E-Recruiting<br>Copyrights © 2017 All Rights Reserved by VanLang E-Recruiting.</p>


							</td>
						</tr>

					</tbody>

				</table>

			</center>
		</div>

	</body>

	</html>