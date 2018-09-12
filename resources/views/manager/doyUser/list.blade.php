@extends('manager.layout.master')

@section('style')
    <style>

    </style>
@stop

@section('body')

    <blockquote class="layui-elem-quote">成员列表</blockquote>

    <!-- 工具集 -->
    <div class="my-btn-box">
    <span class="fl">
 <a class="layui-btn btn-add btn-default" href="{{route('doyUserAdd')}}" id="btn-add">
     <i class="layui-icon">&#xe608;</i>添加成员</a>
        <a class="layui-btn btn-add btn-default" id="reload"><i class="layui-icon">&#xe9aa;</i></a>
    </span>
        <span class="fr">
            <form class="layui-form layui-form-pane" action="" method="get">
                <span class="layui-form-label">搜索条件：</span>
                <div class="layui-input-inline">
                    <select name="sex">
                        <option value="">按性别筛选</option>
                        @foreach($sexList as $k=>$v)
                            <option value="{{$k}}" {{request('sex') == $k ? 'selected' : ''}}>{{$v}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="keyword" value="{{request()->get('keyword')}}" autocomplete="off" placeholder="搜索关键字" class="layui-input">
                </div>
                <button type="submit" class="layui-btn mgl-20"><i class="layui-icon">&#xe615;</i> 查询</button>
            </form>
        </span>
    </div>


    <table class="layui-table">
        <colgroup>
            <col>
            <col>
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">ID</th>
            <th>昵称</th>
            <th class="hidden-xs">QQ</th>
            <th class="hidden-xs">性别</th>
            <th class="hidden-xs">职业</th>
            <th class="hidden-xs">添加人</th>
            <th class="hidden-xs">创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody  id="idFrom">

        @foreach($list as $key=>$vo)
            <tr>
                <td class="hidden-xs">{{$vo->id}}</td>
                <td>{{$vo->nickname}}</td>
                <td class="hidden-xs">{{$vo->qq}}</td>
                <td class="hidden-xs">{{$vo->sexText()}}</td>
                <td class="hidden-xs">{{$vo->position}}</td>
                <td class="hidden-xs">{{$vo->manager->name or '-'}}</td>
                <td class="hidden-xs">{{$vo->create_time or '-'}}</td>
                <td>
                    <a class="layui-btn layui-btn-sm layui-btn-normal" href="{{route('managerEdit',['id' => $vo->id])}}" lay-event="edit">编辑/查看</a>
                    <a class="layui-btn layui-btn-sm layui-btn-danger" onclick="del('{{ route('managerDel', ['id' => $vo->id]) }}')" lay-event="del">删除</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    @include('manager.public.pageBtn')
@stop

@section('js')



    <script>

    </script>
@stop