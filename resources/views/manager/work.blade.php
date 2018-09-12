@extends('manager.layout.master')

@section('style')
    <style>
        .cont_tb_body{
            /*height: 400px;*/
           /* overflow: hidden;*/
        }

        .cont_tb_left,.cont_tb_right{
            float: left;
            width: 50%;
            height: 400px;
        }
        .cont_tb_left_body,.cont_tb_right_body{
            height: 338px;
        }
    </style>
@stop


@section('body')



    <div class="layui-row layui-col-space10 my-index-main">
        <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
            <div class="my-nav-btn layui-clear" data-href="./demo/btn.html">
                <div class="layui-col-md5">
                    <button class="layui-btn layui-btn-big layui-btn-normal layui-icon">&#xe857;</button>
                </div>
                <div class="layui-col-md7 tc">
                    <p class="my-nav-text">12</p>
                    <p class="my-nav-text layui-elip">今日应刷卡人数</p>
                </div>
            </div>
        </div>
        <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
            <div class="my-nav-btn layui-clear" data-href="./demo/btn.html">
                <div class="layui-col-md5">
                    <button class="layui-btn layui-btn-big layui-icon">&#xe6af;</button>
                </div>
                <div class="layui-col-md7 tc">
                    <p class="my-nav-text">100</p>
                    <p class="my-nav-text layui-elip">已刷卡人数</p>
                </div>
            </div>
        </div>
        <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
            <div class="my-nav-btn layui-clear" data-href="./demo/btn.html">
                <div class="layui-col-md5">
                    <button class="layui-btn layui-btn-big layui-btn-danger layui-icon">&#xe69c;</button>
                </div>
                <div class="layui-col-md7 tc">
                    <p class="my-nav-text">85</p>
                    <p class="my-nav-text layui-elip">未刷卡人数</p>
                </div>
            </div>
        </div>





        <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
            <div class="my-nav-btn layui-clear" data-href="##">
                <div class="layui-col-md5">
                    <button class="layui-btn layui-btn-big layui-btn-normal layui-icon">&#xe756;</button>
                </div>
                <div class="layui-col-md7 tc">
                    <p class="my-nav-text">100</p>
                    <p class="my-nav-text layui-elip">车辆总数</p>
                </div>
            </div>
        </div>


        <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
            <div class="my-nav-btn layui-clear" data-href="##">
                <div class="layui-col-md5">
                    <button class="layui-btn layui-btn-big layui-icon">&#xe613;</button>
                </div>
                <div class="layui-col-md7 tc">
                    <p class="my-nav-text">50</p>
                    <p class="my-nav-text layui-elip">员工总数</p>
                </div>
            </div>
        </div>

        <div class="layui-col-xs4 layui-col-sm2 layui-col-md2">
            <div class="my-nav-btn layui-clear" data-href="##">
                <div class="layui-col-md5">
                    <button class="layui-btn layui-btn-big layui-btn-danger layui-icon">&#xe620;</button>
                </div>
                <div class="layui-col-md7 tc">
                    <p class="my-nav-text">100</p>
                    <p class="my-nav-text layui-elip">设备总数</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="layui-bg-green">


    <div class="cont_tb_body">
        <div class="cont_tb_left">
            <blockquote class="layui-elem-quote">当日考勤人数占比</blockquote>
            <div class="cont_tb_left_body" id="cont_tb_left_body"></div>
        </div>

        <div class="cont_tb_right">
            <blockquote class="layui-elem-quote">最近一周考勤概况</blockquote>
            <div class="cont_tb_right_body" id="cont_tb_right_body"></div>
        </div>
    </div>

    <div style="clear: both;"></div>
    <blockquote class="layui-elem-quote">消息提醒
        {{--<a class="my-nav-btn" STYLE="float: right;color: #73D5FF;" href="{{route('messageList')}}">查看跟多》</a>--}}
    </blockquote>

    <table class="layui-table">
        <thead>
        <tr>
            <th>消息类型</th>
            <th>消息标题</th>
            <th class="hidden-xs">消息内容</th>
            <th class="hidden-xs">消息时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>消息类型</td>
            <td>消息标题</td>
            <td class="hidden-xs">消息内容</td>
            <td class="hidden-xs">消息时间</td>
            <td>
                <a class="layui-btn layui-btn-sm" lay-event="detail" href="##">查看 <span class="layui-badge-dot"></span></a>
            </td>
        </tr>
        <tr>
            <td>消息类型</td>
            <td>消息标题</td>
            <td class="hidden-xs">消息内容</td>
            <td class="hidden-xs">消息时间</td>
            <td>
                <a class="layui-btn layui-btn-sm" lay-event="detail" href="##">查看 <span class="layui-badge-dot"></span></a>
            </td>
        </tr>
        </tbody>
    </table>


@stop


@section('js')
    <script type="text/javascript" src="{{asset('static/echarts/echarts.min.js')}}"></script>


    {{--获取当前访问系统--}}
    <script>
        var device = layui.device();
       // console.log(device);
    </script>

    <script>
        $(function(){

            /*最近一周折线对比图*/
            var myChart2 = echarts.init(document.getElementById('cont_tb_right_body'));
            option = {
                title: {
                    textStyle: {
                        /*color: '#FCFCFC',*/
                        fontStyle: 'normal',
                        fontWeight: '600',
                        fontFamily: '黑体',
                        fontSize: 18
                    }
                },
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data:['已刷','未刷'],
                    textStyle:{
                        /*color: '#FCFCFC',*/
                        fontStyle: 'normal',
                        fontSize: 12
                    }
                },
                textStyle:{
                    /*color: '#FCFCFC'*/
                },
                toolbox: {
                    show: true,
                    feature: {
                        /* dataView: {readOnly: false},*/ /*视图统计*/
                        magicType: {type: ['line', 'bar']},
                        restore: {},
                        saveAsImage: {}
                    }
                },
                xAxis:  {
                    type: 'category',
                    boundaryGap: false,
                    data: ['周一','周二','周三','周四','周五','周六','周日']
                },
                yAxis: {
                    type: 'value',
                    axisLabel: {
                        formatter: '{value}'
                    }
                },
                color :['#9FD99A','#F08D7F'],
                series: [
                    {
                        name:'已刷',
                        type:'line',
                        data:[11, 11, 15, 13, 12, 13, 10],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'},
                                {type: 'min', name: '最小值'}
                            ]
                        },
                        markLine: {
                            data: [
                                {type: 'average', name: '平均值'}
                            ]
                        }
                    },
                    {
                        name:'未刷',
                        type:'line',
                        data:[1, -2, 2, 5, 3, 2, 0],
                        markPoint: {
                            data: [
                                {type: 'max', name: '最大值'},
                                {type: 'min', name: '最小值'}
                            ]
                        },
                        markLine: {
                            data: [
                                {type: 'average', name: '平均值'},
                                [{
                                    symbol: 'none',
                                    x: '90%',
                                    yAxis: 'max'
                                }, {
                                    symbol: 'circle',
                                    label: {
                                        normal: {
                                            position: 'start',
                                            formatter: '最大值'
                                        }
                                    },
                                    type: 'max',
                                    name: '最高点'
                                }]
                            ]
                        }
                    }
                ]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart2.setOption(option);

            /*总量对比饼状图*/
            var myChart3 = echarts.init(document.getElementById('cont_tb_left_body'));
            option = {
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: ['已刷卡人数','未刷卡人数']
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                color :['#9FD99A','#F08D7F'],
                series : [
                    {
                        name: '访问来源',
                        type: 'pie',
                        radius : '55%',
                        center: ['50%', '60%'],
                        data:[
                            {value:'100', name:'已刷卡人数'},
                            {value:'132', name:'未刷卡人数'}
                        ],
                        itemStyle: {
                            emphasis: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                            }
                        }
                    }
                ]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart3.setOption(option);
        })
    </script>
@stop