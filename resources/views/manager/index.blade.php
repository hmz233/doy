@extends('manager.layout.master')


@section('body')
    <!-- layout admin -->
    <div class="layui-layout layui-layout-admin"> <!-- 添加skin-1类可手动修改主题为纯白，添加skin-2类可手动修改主题为蓝白 -->
        <!-- header -->
        <div class="layui-header my-header">
            <a href="{{route('manager')}}">
                {{--<img class="my-header-logo" style="width: 270px;height: 45px;" src="{{asset('static/manager/img/logo.png')}}">--}}
                <div class="my-header-logo">{{$system->data->title}}</div>
            </a>
            <div class="my-header-btn">
                <button class="layui-btn layui-btn-small btn-nav"><i class="layui-icon">&#xe65f;</i></button>
            </div>

            <!-- 顶部左侧添加选项卡监听 -->
{{--            <ul class="layui-nav" lay-filter="side-top-left">
                <li class="layui-nav-item"><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></li>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon">&#xe621;</i>基础</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" href-url="demo/btn.html"><i class="layui-icon">&#xe621;</i>按钮</a></dd>
                        <dd><a href="javascript:;" href-url="demo/form.html"><i class="layui-icon">&#xe621;</i>表单</a></dd>
                    </dl>
                </li>
            </ul>--}}

            <!-- 顶部右侧添加选项卡监听 -->
            <ul class="layui-nav my-header-user-nav" lay-filter="side-top-right">

                <li class="layui-nav-item" style="margin-right: 10px;">
                    {{date('Y年m月d日')}} {{$week_time}} <span id="nowTime">{{date('H:i:s',time())}}</span>
                </li>

                {{--<li class="layui-nav-item" style="width: 100px;">--}}
                    {{--<a style="display: inline-block;width: 100%" href="javascript:;" href-url="{{route('messageList',['status' =>1])}}"><i class="layui-icon">&#xe63a;</i>消息记录</a>--}}
                {{--</li>--}}

                <li id="messageNum" class="layui-nav-item" style="margin-right: 30px;display: none;">
                    <span class="layui-badge">0</span>
                </li>


                <li class="layui-nav-item">
                    <a class="name" href="javascript:;"><i class="layui-icon">&#xe629;</i>主题</a>
                    <dl class="layui-nav-child">
                        <dd data-skin="0"><a href="javascript:;">默认</a></dd>
                        {{--<dd data-skin="1"><a href="javascript:;">纯白</a></dd>--}}
                        <dd data-skin="2"><a href="javascript:;">蓝白</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a class="name" href="javascript:;"><img src="{{asset('admin/img/ico.png')}}" alt="logo"> {{request()->user('manager')->username}}  </a>
                    <dl class="layui-nav-child" style="cursor: pointer;">
                      <dd><a onclick="layer.confirm('您确认退出'+'{{$system->data->title}}？',{btnAlign: 'c',btn:['退出','取消'],title:'提示',icon:3,closeBtn: 0}, function () {window.location.href = '{{ route('manageLogout') }}';})"><i class="layui-icon">&#x1006;</i>退出</a></dd>
                    </dl>
                </li>
            </ul>

        </div>


        <!-- side -->
        <div class="layui-side my-side">
            <div class="layui-side-scroll">
                <!-- 左侧主菜单添加选项卡监听 -->
                <ul class="layui-nav layui-nav-tree" lay-filter="side-main">
                    {{--循环用户菜单栏--}}
                    @foreach($menuList as $key=>$vo)
                        <li class="layui-nav-item">
                            <a href="javascript:;"><i class="layui-icon">{{$vo['icon']}}</i>{{$vo['title']}}</a>
                        @if(array_key_exists('_child',$vo))
                                <dl class="layui-nav-child">
                                    @foreach($vo['_child'] as $k => $v)
                                        <dd><a href="javascript:;" href-url="{{ route($v['url']) }}"><i class="layui-icon">{{$v['icon']}}</i>{{$v['title']}}</a></dd>
                                    @endforeach
                                </dl>
                        @endif
                        </li>
                    @endforeach

                    <li class="layui-nav-item">
                        <a href="javascript:;"><i class="layui-icon">&#xe614;</i>系统设置</a>
                        <dl class="layui-nav-child">
                            <dd><a href="javascript:;" href-url="{{route('system')}}"><i class="layui-icon">&#xe621;</i>基本设置</a></dd>
                        </dl>
                    </li>


                </ul>

            </div>
        </div>


        <!-- body -->
        <div class="layui-body my-body">
            <div class="layui-tab layui-tab-card my-tab" lay-filter="card" lay-allowClose="true">
                <ul class="layui-tab-title">
                    <li class="layui-this" lay-id="1"><span><i class="layui-icon">&#xe629;</i>工作台</span></li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <iframe id="iframe" src="{{route('work')}}" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <div class="layui-footer my-footer">
            <p><a href="http://vip-admin.com" target="_blank"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javaScript:void(0)" target="_blank">{{$system->data->title}}</a></p>
            <p>备案号：{{$system->data->internet_number}}</p>
        </div>


    </div>

    <!-- 右键菜单 -->
    <div class="my-dblclick-box none">
        <table class="layui-tab dblclick-tab">
            <tr class="card-refresh">
                <td><i class="layui-icon">&#x1002;</i>刷新当前标签</td>
            </tr>
            <tr class="card-close">
                <td><i class="layui-icon">&#x1006;</i>关闭当前标签</td>
            </tr>
            <tr class="card-close-all">
                <td><i class="layui-icon">&#x1006;</i>关闭所有标签</td>
            </tr>
        </table>
    </div>
@stop

@section('js')
    <script>
        $(function(){
            nowTime();
            setInterval("nowTime()",1000);//刷新时间
            _util();
        });
        function nowTime()
        {
            var myDate = new Date();
            $('#nowTime').text(myDate.toLocaleTimeString());
        }
        // 工具
        function _util() {
            var bar = $('.layui-fixbar');
            // 分辨率小于1023  使用内部工具组件
            if ($(window).width() < 992) {
                layui.util.fixbar({
                    bar1: '&#xe602;'
                    , css: {left: 10, bottom: 54}
                    , click: function (type) {
                        if (type === 'bar1') {
                            //iframe层
                            layer.open({
                                type: 1,                        // 类型
                                title: false,                   // 标题
                                offset: 'l',                    // 定位 左边
                                closeBtn: 0,                    // 关闭按钮
                                anim: 0,                        // 动画
                                shadeClose: true,               // 点击遮罩关闭
                                shade: 0.8,                     // 半透明
                                area: ['150px', '100%'],        // 区域
                                skin: 'my-mobile',              // 样式
                                content: $('body .my-side').html() // 内容
                            });
                        }
                        layui.element.init();
                    }
                });
                bar.removeClass('layui-hide');
                bar.addClass('layui-show');
            } else {
                bar.removeClass('layui-show');
                bar.addClass('layui-hide');
            }
        };
    </script>
@stop

