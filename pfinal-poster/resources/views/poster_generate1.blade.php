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

                        <div class="btn-group btn-group-crop">
                            <button type="button" class="btn btn-success" data-method="getCroppedCanvas"
                                    data-option="{ &quot;maxWidth&quot;: 4096, &quot;maxHeight&quot;: 4096 }">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="$().cropper(&quot;getCroppedCanvas&quot;, { maxWidth: 4096, maxHeight: 4096 })">
                              Get Cropped Canvas
                            </span>
                            </button>
                            <button type="button" class="btn btn-success" data-method="getCroppedCanvas"
                                    data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 160, height: 90 })">
                              160&times;90
                            </span>
                            </button>
                            <button type="button" class="btn btn-success" data-method="getCroppedCanvas"
                                    data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }">
                            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false"
                                  title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 320, height: 180 })">
                              320&times;180
                            </span>
                            </button>
                        </div>
                        <div class="btn-group  docs-toggles">
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
                        <!-- Show the cropped image in modal -->
                        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true"
                             aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body"></div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <a class="btn btn-primary" id="download" href="javascript:void(0);"
                                           download="cropped.jpg">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.modal -->

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
                    {{--                    <div class="docs-data">--}}
                    {{--                        <div class="card text-white bg-secondary">--}}
                    {{--                            <div class="card-header">--}}
                    {{--                                <span class="fa fa-database"></span> 海报数据--}}
                    {{--                            </div>--}}
                    {{--                            <div class="card-body">--}}
                    {{--                                <form id="poster_generate_form">--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <label for="exampleFormControlInput1">标题样式:</label>--}}
                    {{--                                        <select class="form-control" id="exampleFormControlSelect1" name="poster_style">--}}
                    {{--                                            <option value="0">默认</option>--}}
                    {{--                                            <option value="1">横排</option>--}}
                    {{--                                            <option value="2">竖排</option>--}}
                    {{--                                        </select>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <div class="form-check form-check-inline">--}}
                    {{--                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"--}}
                    {{--                                                   id="inlineRadio1" value="1" checked>--}}
                    {{--                                            <label class="form-check-label" for="inlineRadio1">生成</label>--}}
                    {{--                                        </div>--}}
                    {{--                                        <div class="form-check form-check-inline">--}}
                    {{--                                            <input class="form-check-input" type="radio" name="inlineRadioOptions"--}}
                    {{--                                                   id="inlineRadio2" value="2">--}}
                    {{--                                            <label class="form-check-label" for="inlineRadio2">上传</label>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <label for="exampleFormControlInput1">二维码连接</label>--}}
                    {{--                                        <input type="url" class="form-control" id="exampleFormControlInput1"--}}
                    {{--                                               placeholder="请输入跳转的连接" name="poster_url">--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group" id="er_wei_code">--}}
                    {{--                                        <label for="exampleFormControlFile1">二维码:</label>--}}
                    {{--                                        <input type="file" class="form-control-file" name="er_wei_code"--}}
                    {{--                                               id="exampleFormControlFile1">--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <label for="formGroupExampleInput">标题:</label>--}}
                    {{--                                        <input type="text" class="form-control" id="formGroupExampleInput"--}}
                    {{--                                               placeholder="请输入标题" name="title">--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <label for="formGroupExampleInput">负标题:</label>--}}
                    {{--                                        <input type="text" class="form-control" id="formGroupExampleInput"--}}
                    {{--                                               placeholder="请输入标题" name="fv_title">--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="form-group">--}}
                    {{--                                        <label for="formGroupExampleInput">备注:</label>--}}
                    {{--                                        <input type="text" class="form-control" id="formGroupExampleInput"--}}
                    {{--                                               placeholder="请输入标题" name="desc">--}}
                    {{--                                    </div>--}}
                    {{--                                    <button type="button" id="generate_up" class="btn btn-primary">提交生成</button>--}}
                    {{--                                </form>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="docs-data">
                        <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataX">X</label>
            </span>
                            <input type="text" class="form-control" id="dataX" placeholder="x">
                            <span class="input-group-append">
              <span class="input-group-text">px</span>
            </span>
                        </div>
                        <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataY">Y</label>
            </span>
                            <input type="text" class="form-control" id="dataY" placeholder="y">
                            <span class="input-group-append">
              <span class="input-group-text">px</span>
            </span>
                        </div>
                        <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataWidth">Width</label>
            </span>
                            <input type="text" class="form-control" id="dataWidth" placeholder="width">
                            <span class="input-group-append">
              <span class="input-group-text">px</span>
            </span>
                        </div>
                        <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataHeight">Height</label>
            </span>
                            <input type="text" class="form-control" id="dataHeight" placeholder="height">
                            <span class="input-group-append">
              <span class="input-group-text">px</span>
            </span>
                        </div>
                        <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataRotate">Rotate</label>
            </span>
                            <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                            <span class="input-group-append">
              <span class="input-group-text">deg</span>
            </span>
                        </div>
                        <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataScaleX">ScaleX</label>
            </span>
                            <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                        </div>
                        <div class="input-group input-group-sm">
            <span class="input-group-prepend">
              <label class="input-group-text" for="dataScaleY">ScaleY</label>
            </span>
                            <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
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
    <script>
        $(function () {
            $("#generate_up").on("click", function () {
                //alert(123);
                //$().cropper("getCroppedCanvas", {maxWidth: 4096, maxHeight: 4096});
                //$image =
                result = $('#image').cropper(data.method, data.option, data.secondOption);
                alert(result);
            })
        })
    </script>
@endsection
