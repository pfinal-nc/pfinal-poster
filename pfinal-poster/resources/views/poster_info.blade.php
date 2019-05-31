@extends('layout.layout')
@section("content")
    <div class="card mt10">
        <div class="card-header">
            <h5>PFinal海报详情</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="card col-xs-12 col-lg-6 col-md-6">
                    <div class="card-header"><i>海报图片</i></div>
                    <div class="card-body">
                        <img src="{{asset($poster->poster_image)}}" width="100%" alt="">
                    </div>
                </div>
                <div class="card col-xs-12 col-lg-6 col-md-6 text-white bg-dark">
                    <div class="card-header"><i>海报信息</i></div>
                    <div class="card-body">
                        <ol>
                            <li>海报标题: <br><br> <span style="color:red">&nbsp;&nbsp;&nbsp;{{$poster->title}}</span></li>
                            <li>海报副标题: <br><br> <span style="color:red">&nbsp;&nbsp;&nbsp;{{$poster->subheading}}</span></li>
                            <li>海报副备注: <br><br> <span style="color:red">&nbsp;&nbsp;&nbsp;{{$poster->desc}}</span></li>
                            <li>海报二维码: <br><br> &nbsp;&nbsp;&nbsp;<img src="{{asset($poster->qrcode_img)}}" width="80" height="80" alt=""></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
