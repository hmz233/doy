<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@section('title')首页 · {{$system->data->title}}@show</title>
    <link rel="stylesheet" href="{{asset('static/layui/css/layui.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/extend.css')}}">
    <link rel="icon" href="{{asset('admin/img/ico.png')}}">
    <link href="{{ asset('admin/css/plugins/bootstrap-table/bootstrap-table.min.css') }}" rel="stylesheet">
    <link href="{{ asset("admin/treegrid/css/jquery.treegrid.css") }}" rel="stylesheet">
    {{--<link rel="shortcut icon" href="http://static.runoob.com/images/favicon.ico" mce_href="//static.runoob.com/images/favicon.ico" type="image/x-icon">--}}
    @section('style')
        <style></style>
    @show
</head>
<body class="body">
@yield('body')

<script type="text/javascript" src="{{asset('static/layui/layui.all.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/vip_comm.js')}}"></script>
<script type="text/javascript" src="{{asset('static/jquery-2.0.3.min.js')}}"></script>
<script>
    if('{{$errors->has('success')}}'){
        layer.msg('{{$errors->first('success')}}', {icon: 1, time: 2000});
    }

    if('{{$errors->has('error')}}'){
        layer.msg('{{$errors->first('error')}}', {icon: 0, time: 2000});
    }

    /**
     * ajax 删除方法
     * @param url
     */
    function del(url,route,msg) {
        route = route || null;
        msg = msg || '确认删除？';
        layer.confirm(msg,{btnAlign: 'c'}, function () {
            var index=layer.load(2);
            $.ajax({
                type: 'DELETE',
                url: url,
                data: {_token: '{{ csrf_token() }}'},
                dataType: 'json',
                success: function (data) {
                    if (data.status != 1) {
                        layer.msg(data.message, {icon: 0, time: 1500});
                        layer.close(index);
                        return false;
                    } else {
                        layer.msg(data.message, {icon: 1, time: 1500});
                        if(route){
                            window.location.href=route;
                        }else{
                            location.reload();
                        }

                    }
                }
            });
        });
    }

    function handle(url,msg) {
        msg =msg || '您确认这样操作吗？';
        layer.confirm(msg,{btnAlign: 'c'}, function () {
            var index = layer.load(2);
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function (data) {
                    layer.close(index);
                    if (data.status != 1) {
                        layer.msg(data.message, {icon: 0, time: 1500});
                        return false;
                    } else {
                        layer.msg(data.message, {icon: 1, time: 1500});
                        location.reload();
                    }
                }
            });
        });
    }

    //是否确认这样操作
    function inquirySkip(url,msg,btn)
    {
        msg = msg || '您确认这样操作吗？';
        btn = btn || ['确定','取消'];
        layer.confirm(msg,{btnAlign: 'c',btn:btn}, function () {
            window.location.href = url;
        });
    }

    /**
     * 本页打开新页面
     * @param url
     * @param title
     * @author 穆风杰<hcy.php@qq.com>
     */
    function openView(url,title) {
        title = title || '{{$system->data->title}}';
        layer.open({
            title:title,
            area:['1080px','500px'],//高宽
            offset: '30px',//坐标
            type: 2,//ifr 打开类型
            content: url //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
        });
    }

    $(function(){
		//刷新
        $('#reload').click(function(){
            layer.load(2);
            location.reload();
        });

		//加载
        $('.load').click(function(){
            layer.load(2);
        });

		//form表单提交
        $('form').submit(function(){
            layer.load(2);
        });

        $('.pagination li a').click(function(){
            layer.load(2);
        });

        //日期
        layui.laydate.render({
            elem: '#time'
        });
        layui.use(['vip_tab'], function () {
            // 打开选项卡
            $('.my-nav-btn').on('click', function(){
                if($(this).attr('data-href')){
                    //vipTab.add('','标题','路径');
                    layui.vip_tab.add($(this),'<i class="layui-icon">'+$(this).find("button").html()+'</i>'+$(this).find('p:last-child').html(),$(this).attr('data-href'));
                }
            });
        });
    });

	//自定义验证规则
    layui.form.verify({
        price: [
            /^(0|[1-9][0-9]{0,9})(\.[0-9]{1,2})?$/
            ,'请输入正确的价格！（最多两位小数）'
        ],
        distance: [
            /^(0|[1-9][0-9]{0,9})(\.[0-9]{1,2})?$/
            ,'请输入正确的数字格式！（最多两位小数）'
        ]
    });



</script>

{{--合并相同数据--}}
<script>
    $(function(){
        var dayArray = [];//存储当前存在数据
        var obj = '';//存储之前需要合并的数据
        var spanNum = 1;//合并列 默认1
        $('.rowspan').each(function(){
            //查询这个数据是否已在数组中存在
            if($.inArray($(this).text(),dayArray) == '-1'){
                if(obj && spanNum > 1){obj.attr('rowspan',spanNum);}//存在对象 并且存在需要合并列
                obj = $(this);//赋值新的操作节点
                spanNum = 1;//归1合并列
                dayArray.push($(this).text());//向数组中追加最新内容
            }else{
                $(this).remove();//移除当前节点
                spanNum ++;//合并列加一
            }
        });
        if(obj && spanNum > 1){obj.attr('rowspan',spanNum);}//最后数据处理合并
    })
</script>
@yield('js')


</body>
</html>