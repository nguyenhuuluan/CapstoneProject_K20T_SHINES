
{{-- @include('beautymail::templates.widgets.articleStart', ['color' => '#0000FF'])
@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Chúc mừng',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>{{$company -> name}}</p>

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'Click me',
        	'link' => 'http://google.com'
    ])

@stop --}}

<h2>Chúc mừng công ty / doanh nghiệp: {{$company->name}} đã được chấp thuận <h2>

<hr>

<h3>{{$representative->name}} là người đại diện chính của công ty / doanh nghiệp</h3>
<p>username: {{$account->username}}</p>
{{-- <p>password: ******************* </p> --}}
<br>
Để thay đổi mật khẩu vui lòng ấn vào đây: <a href="http://localhost:9999/CapstoneProject_K20T_SHINES/source_code/public/account/reset/{{$account -> remember_token}}" >Click vào đây</a>
