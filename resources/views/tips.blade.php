<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{env('APP_NAME_STR')}}</title>
    <link rel="stylesheet" href="{{asset('static/layui/css/layui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/top.css')}}"/>

    <script type="text/javascript" src="{{asset('static/layui/layui.all.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/jquery-2.0.3.min.js')}}"></script>

</head>
<style type="text/css">

</style>
<body>
<div class="my-page-box"
     style="width: 50%;margin: 20px auto;text-align: center;font-size: 20px;    @if($type=='success')color: green;@else color: red; @endif;">
    <i class="layui-icon" style="font-size: 75px;">@if($type=='success')&#xe60c;@else&#xe69c;@endif</i>

    <p class="msg">{{$msg}} 将在 <span id="time">{{$time}}</span> 秒后跳转</p>

    <p class="text">友情提示,提示消息~~~</p>

    <div class="my-btn-box" style="margin-top: 20px;">
        <a class="layui-btn layui-btn-small" href="{{route($url)}}">立即跳转</a>
    </div>
</div>
</body>

<script>
    setInterval("window.location.href='{{route($url,$arg)}}'", '{{$time*1000}}');//刷新时间
    setInterval("time()", 1000);//刷新时间
    function time() {
        var timeObj = $('#time');
        var old = timeObj.text();
        if (old > 0) {
            timeObj.text(old - 1)
        }
    }
</script>

</html>
