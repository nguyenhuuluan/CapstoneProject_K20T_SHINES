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
							<a href="https://www.xero.com/us/" style="display:block; margin:0 auto;" target="_blank">
								<img src="https://image.ibb.co/egY2EG/logo.png" width="300" height="75" alt="VLU" style="border: 0px;">
							</a>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="padding:30px 0; border-bottom:1px solid #e9edee;">
							<p style="color:#1d2227;line-height:28px;font-size:24px;margin:12px 10px 20px 10px;font-weight:400;">
								Xin chào: <strong>{{$representative->name}}</strong>
							</p>
							<p style="color:#1d2227;line-height:28px;font-size:24px;margin:12px 10px 20px 10px;font-weight:400;">
								Người đại diện của doanh nghiệp / công ty:  <strong>{{$company->name}}</strong>
							</p>
							<p style="font-size: 20px; margin:0 10px 10px 10px;padding:0;">Tin tuyển dụng <strong> <a class="item-block"  target="_blank" href="{!! route('detailrecruitment', $recruitment->slug) !!}">{{$recruitment->title}} </a> </strong> đã được chấp thuận,<a class="item-block"  target="_blank" href="{!! route('detailrecruitment', $recruitment->slug) !!}"> xem ngay </a></p>
							
						</td>
					</tr>

					<tr>
						<td colspan="2" style="padding:30px 0 0 0;border-top:1px solid #e9edee;color:#9b9fa5">
							Nếu bạn có bất kì thắc mắc nào, đừng ngần ngại liên hệ với chúng tôi tại <a style="color:#666d74;text-decoration:none;" href="#" target="_blank">jobee0210@gmail.com hoặc điện thoại: P.Tổng hợp: 028. 3836 7933</a>

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