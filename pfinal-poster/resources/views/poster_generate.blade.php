@extends('layout.layout')
@section("content")
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css">
    <link rel="stylesheet" href="{{asset('plugin/cropper/css/main.css')}}">
    <div class="card mt10 text-white bg-dark">
        <div class="card-header">
            <h3>PFinal海报生成</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <!-- <h3>Demo:</h3> -->
                    <div class="img-container">
                        <img id="image" src="{{asset('plugin/cropper/images/picture.jpg')}}" alt="Picture">
                    </div>
                    <div class="docs-buttons">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move"
                                    title="Move">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                      title="移动">
                                  <span class="fa fa-arrows"></span>
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop"
                                    title="Crop">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="裁剪">
                              <span class="fa fa-crop"></span>
                            </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1"
                                    title="Zoom In">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="放大">
                              <span class="fa fa-search-plus"></span>
                            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1"
                                    title="Zoom Out">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="缩小">
                              <span class="fa fa-search-minus"></span>
                            </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45"
                                    title="Rotate Left">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="旋转">
                              <span class="fa fa-rotate-left"></span>
                            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="rotate" data-option="45"
                                    title="Rotate Right">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="旋转">
                              <span class="fa fa-rotate-right"></span>
                            </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1"
                                    title="Flip Horizontal">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="翻转">
                              <span class="fa fa-arrows-h"></span> 左右翻转
                            </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1"
                                    title="Flip Vertical">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="翻转">
                              <span class="fa fa-arrows-v"></span> 上线翻转
                            </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="取消裁剪">
                              <span class="fa fa-remove"></span> 取消裁剪
                            </span>
                            </button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                      title="锁定">
                                  <span class="fa fa-lock"></span> 锁定
                                </span>
                            </button>
                            <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="解锁">
                              <span class="fa fa-unlock"></span> 解锁
                            </span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="重新裁剪">
                              <span class="fa fa-refresh"></span> 重新裁剪
                            </span>
                            </button>
                            <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                <input type="file" class="sr-only" id="inputImage" name="file"
                                       accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                      title="Import image with Blob URLs">
                              <span class="fa fa-upload"></span> 上传图片
                            </span>
                            </label>
                            <a class="btn btn-primary" href="{{url('poster_generate')}}"><span
                                        class="fa fa-refresh"></span>
                                刷新页面 </a>
                        </div>
                        <div class="btn-group  docs-toggles" style="    margin-top: .5rem;">
                            <label class="btn btn-primary active">
                                <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio"
                                       value="1.7777777777777777">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                      title="裁剪比例">16:9</span>
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio"
                                       value="1.3333333333333333">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                      title="裁剪比例">4:3</span>
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                      title="裁剪比例">1:1</span>
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio"
                                       value="0.6666666666666666">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                      title="裁剪比例">2:3</span>
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                      title="裁剪比例">自由比例</span>
                            </label>
                        </div>
                        <div class="btn-group btn-group-crop">
                            <button type="button" class="btn btn-success" data-method="getCroppedCanvas"
                                    data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="$().cropper(&quot;getCroppedCanvas&quot;, { maxWidth: 4096, maxHeight: 4096 })">
                              保存图片
                            </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <!-- <h3>Preview:</h3> -->
                    <div class="docs-preview clearfix">
                        <div class="img-preview preview-lg"></div>
                        <div class="img-preview preview-md"></div>
                        <div class="img-preview preview-sm"></div>
                        <div class="img-preview preview-xs"></div>
                    </div>
                    <div class="docs-data">
                        <div class="card text-white bg-secondary">
                            <div class="card-header">
                                <span class="fa fa-database"></span> 海报数据
                            </div>
                            <div class="card-body">
                                <form id="poster_generate_form" action="{{url('poster_generate')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">标题样式:</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="poster_style">
                                            <option value="0">默认</option>
                                            <option value="1">横排</option>
                                            <option value="2">竖排</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                   id="inlineRadio1" value="1" checked>
                                            <label class="form-check-label" for="inlineRadio1">生成</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                                   id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">上传</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">二维码连接</label>
                                        <input type="url" class="form-control" id="exampleFormControlInput1"
                                               placeholder="请输入跳转的连接" name="poster_url">
                                    </div>
                                    <div class="form-group" id="er_wei_code">
                                        <label for="exampleFormControlFile1">二维码:</label>
                                        <input type="file" class="form-control-file" name="er_wei_code"
                                               id="exampleFormControlFile1">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">标题:</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                               placeholder="请输入标题" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">副标题:</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                               placeholder="请输入标题" name="subheading">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">备注:</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput"
                                               placeholder="请输入标题" name="desc">
                                    </div>
                                    <input type="hidden" name="poster_str" id="poster_str">
                                    <button type="submit" id="generate_up" class="btn btn-primary">提交生成</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script src="{{asset('plugin/cropper/js/cropper.js')}}"></script>
    <script src="{{asset('plugin/cropper/js/jquery-cropper.js')}}"></script>
    <script src="{{asset('plugin/cropper/js/main.js?version='.rand(0,10))}}"></script>
    <script src="{{asset('plugin/validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('plugin/validate/messages_zh.min.js')}}"></script>
    <script src="{{asset('plugin/jquery-form/jquery.form.js')}}"></script>
    <script src="{{asset('plugin/layer/layer.js')}}"></script>

    <script>
        $(function () {
            $("#poster_generate_form").validate({
                ignore: "",
                rules: {},
                messages: {},
                onkeyup: false,
                focusCleanup: true,
                success: "valid",
                submitHandler: function (form) {
                    var loading = layer.load(3);
                    $(form).ajaxSubmit({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success: function (res) {
                            if (res.code == 200) {

                            } else {
                                layer.close(loading);
                                layer.msg(res.msg, {icon: 2, time: 2000});
                            }
                        },
                        error: function (res) {
                            layer.msg('生成错误', {icon: 2, time: 2000});
                        }
                    });
                    return false;
                }

            });
        })
    </script>
@endsection
