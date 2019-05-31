<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <title>PFinal海报生成工具</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css?version='.random_int(1,9999))}}">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{asset('images/logo.jpg')}}" width="30" height="30" class="d-inline-block align-top"
                 alt="PFinal社区">
            PFinal
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {!! Request::getPathInfo()=='/'?'active':'' !!}">
                    <a class="nav-link" href="{{url('/')}}">首页<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {!! Request::getPathInfo()=='/poster_info'?'active':'' !!}">
                    <a class="nav-link" href="{{url('poster_info')}}">查看海报</a>
                </li>
                <li class="nav-item {!! Request::getPathInfo()=='/poster_generate'?'active':'' !!}">
                    <a class="nav-link" href="{{url("poster_generate")}}">生成海报</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">关于我们</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    @yield("content")
</div>
<footer class="footer">
    <div class="container text-center">
        <div>
            <i class="fa fa-flag" aria-hidden="true"></i> PFinal Poster vBate 0.0.1
            <span class="hide-xs">·</span>
            <br class="hide-sm hide-md hide-lg"> 更新于2019年5月29日
        </div>
        <div>
            版权所有：PFinal社区 <a href="" style="color:#ffffff" target="_blank">陇ICP备19000188号-1</a>
        </div>
    </div>
</footer>
@yield("script")
</body>
</html>