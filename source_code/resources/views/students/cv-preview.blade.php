<!DOCTYPE>
<html lang="en">
<head>
	<title>Tuyển dụng Văn Lang - {!! $cv->name !!}</title>
</head>
<body>
<iframe src="https://docs.google.com/viewer?url={!! base_path().'\\public_html\\'.'\\cvs\\'.$cv->file !!}&embedded=true" style="width:100%; height:100vh;" frameborder="0"></iframe>
{{-- <iframe src="https://docs.google.com/viewer?url=https://www.leaf-vn.org/PDF-0CONVERSION-rev2.pdf&embedded=true" style="width:100%; height:100vh;" frameborder="0"></iframe> --}}
</body>
</html>