<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{$system->data->title}}</title>
    <link rel="stylesheet" href="{{asset('static/layui/css/layui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/top.css')}}"/>
    <link rel="icon" href="{{asset('admin/img/ico.png')}}">
</head>
<style type="text/css">
    body {
        width: 100%;
        height: 620px !important;
        overflow: hidden;
    }

    .input_move {
        background-color: white!important;
    }
</style>
<body class="landbg">

<div class="landcont">

    <div class="landlogo">
        <img src="{{asset('admin/img/ico.png')}}"/>
    </div>
    <p class="landtit" style="text-align: center;">欢迎使用{{$system->data->title}}</p>


    <form action="" method="post">

        <ul class="landUl">
            <li class="name"><input type="text" name="username" value="{{old('username')}}"
                                    placeholder="输入您的账号" class="input_out" onmousemove="this.className='input_move'" onmouseout="this.className='input_out'"/></li>
            <li class="password"><input type="password" name="password" value="" placeholder="输入您的密码" onmousemove="this.className='input_move'" onmouseout="this.className='input_out'"/></li>
        </ul>
        <p style="color: red;text-align: center;margin-bottom: 10px;">
            @if($errors->has('username'))<span>*{{$errors->first('username')}}</span>@endif
            @if($errors->has('password'))<span>*{{$errors->first('password')}}</span>@endif
        </p>
        {{ csrf_field() }}
        <a href="" class="landbtn">
            <input class="landbtns" type="submit" value="登录"/>
        </a>

    </form>


    <!--	        <a href="" class="forget">
                    <span class="forgetword1">忘记密码?</span>
                    <span class="dian">忘记密码?</span>
                </a>-->

</div>

</body>
</html>
