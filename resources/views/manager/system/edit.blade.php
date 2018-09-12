@extends('manager.layout.master')
@section('style')
    <style>
        #product_img img {
            cursor: pointer;
            margin-top: 5px;
            width: 100%;
            height: 100%;
        }

        #product_img p {
            float: left;
            width: 20%;
            height: 100px;
            overflow: hidden;
            position: relative;
            margin-bottom: 5px;
        }

        #product_img p span {
            position: absolute;
            top: 0;
            right: 0;
            color: white;
            background: red;
            border-radius: 50%;
            display: inline-block;
            width: 15px;
            height: 15px;
            cursor: pointer;
            text-align: center;

        }

        #product_img_div:hover {
            background: grey;
        }

        #product_img_div, #car_img_div {
            background: #E5E5E5;
            width: 150px;
            height: 95px;
            color: white;
            text-align: center;
            line-height: 95px;
            font-size: 50px;
            float: left;
            cursor: pointer;
            margin-top: 5px;

        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
        }
    </style>
@endsection
@section('body')
    <blockquote class="layui-elem-quote">基本设置</blockquote>

    <form class="layui-form layui-form-pane" action="" id="base_form">
        <div class="layui-form-item">
            <label class="layui-form-label">系统名称</label>
            <div class="layui-input-inline">
                <input type="text" name="title" value="{{$info->data->title}}" lay-verify="required" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">备案号</label>
            <div class="layui-input-inline">
                <input type="text" name="internet_number" value="{{$info->data->internet_number}}" lay-verify="required"
                       placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text" style="width: 300px;">
            <label class="layui-form-label">系统简介</label>
            <div class="layui-input-block">
                <textarea name="intro" placeholder="请输入描述内容" class="layui-textarea">{{$info->data->intro}}</textarea>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" style="width:171px">客服电话</label>
            <div class="layui-input-inline">
                <input type="number" name="service_tel" value="{{$info->data->service_tel}}" lay-verify="required"
                       placeholder="请输入" autocomplete="off" class="layui-input">
                <div style="color:red">{{$errors->first('service_tel')}}</div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" style="width:171px">客服QQ</label>
            <div class="layui-input-inline">
                <input type="number" name="service_qq" value="{{$info->data->service_qq}}" lay-verify="required"
                       placeholder="请输入" autocomplete="off" class="layui-input">
                <div style="color:red">{{$errors->first('service_qq')}}</div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label" style="width:171px">邮箱</label>
            <div class="layui-input-inline">
                <input type="text" name="email" value="{{$info->data->email}}" lay-verify="required" placeholder="请输入"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item" style="">
            <label class="layui-form-label">官网Logo</label>
            <div id="product_img" class="layer-photos-demo" {{$system->logo ? 'display: none' : ''}}>
                @if($system->logo)
                    <p style="width:150px;height:95px;margin-right: 5px;">
                        <img data-id="{{$system->logo_id}}" layer-src="{{asset('upload/'.$system->logo->path)}}"
                             src="{{asset('upload/'.$system->logo->path)}}" style="margin-top: 0px;">
                        <span title="删除">X</span>
                    </p>
                @endif
            </div>
            <div id="product_img_div" style="margin: 0px;">+</div>
            <input type="hidden" name="logo_id" id="product_img_input" value="{{$system->logo_id}}"
                   lay-verify="required" placeholder="上传Logo">
        </div>

        <div class="layui-form-item">
            <div class="layui-input-inline">
                {{csrf_field()}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1" type="button"
                        onclick="ajaxSub('{{route('system')}}')">保 存
                </button>
                <button class="layui-btn layui-btn-normal" onclick="javascript:history.back(-1);return false;">返 回
                </button>
            </div>
        </div>

    </form>
@stop



@section('js')
    <script>
        //获取图片id
        function getDrivingImgId() {
            var imgIds = '';
            $('#product_img img').each(function (key, value) {
                if (key == 0) {
                    imgIds += $(this).attr('data-id');
                } else {
                    imgIds += ',' + $(this).attr('data-id');
                }

            });
            $('#product_img_input').val(imgIds);
        }

        $('#product_img').on('click', 'span', function () {
            $(this).parent().remove();
            getDrivingImgId();
        });

        var uploadInst = layui.upload.render({
            elem: '#product_img_div' //绑定元素
            , url: '{{route('uploadImg')}}' //上传接口
            , done: function (res) {
                $('#product_img').html('<p style="width:150px;height:95px;margin-right: 5px;"><img data-id="' + res.data.id + '" layer-src="' + res.data.url + '" src="' + res.data.url + '" style="margin-top: 0px;"><span title="删除">X</span></p>');
                $("input[name='logo_id']").val(res.data.id);
                getDrivingImgId();
                $("#product_img").show();
            }
            , error: function () {
                //请求异常回调
            }
        });

        //获取图片id
        function getDrivingImgId1() {
            var imgIds = '';
            $('#product_img1 img').each(function (key, value) {
                if (key == 0) {
                    imgIds += $(this).attr('data-id');
                } else {
                    imgIds += ',' + $(this).attr('data-id');
                }

            });
            $('#product_img_input1').val(imgIds);
        }

        $('#product_img1').on('click', 'span', function () {
            $(this).parent().remove();
            getDrivingImgId1();
        });

        var uploadInst1 = layui.upload.render({
            elem: '#product_img_div1' //绑定元素
            , url: '{{route('uploadImg')}}' //上传接口
            , done: function (res) {
                $('#product_img1').html('<p style="width:150px;height:95px;margin-right: 5px;"><img data-id="' + res.data.id + '" layer-src="' + res.data.url + '" src="' + res.data.url + '" style="margin-top: 0px;"><span title="删除">X</span></p>');
                $("input[name='ewm_id']").val(res.data.id);
                getDrivingImgId1();
                $("#product_img1").show();
            }
            , error: function () {
                //请求异常回调
            }
        });
    </script>
    <script>
        var clk = true;
        function ajaxSub(url) {
            if (clk) {
                clk = false;
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#base_form').serialize(),
                    dataType: 'json',
//                    headers: {
//                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//                    },
                    success: function (data) {
                        clk = true;
                        if (data.status == 1) {
                            layer.msg('修改成功');
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        } else {
                            layer.msg('修改失败,请稍后再试');
                            return false;
                        }
                    },
                    error: function (xhr, type) {
                        clk = true;
                        if (xhr.status == 422) {
                            var msg = '';
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                msg += value;
                            });
                            layer.msg(msg);
                        } else {
                            layer.msg('修改失败,请稍后重试');
                        }
                    }
                });
            }
        }
    </script>

@stop