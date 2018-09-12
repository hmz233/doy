@extends('manager.layout.master')

@section('style')
    <style>

    </style>
@stop

@section('body')

    <blockquote class="layui-elem-quote">权限管理</blockquote>

    <!-- 工具集 -->
    <div class="my-btn-box">
    <span class="fl">
 <a class="layui-btn btn-add btn-default" href="{{route('authorityAdd')}}" id="btn-add">
     <i class="layui-icon">&#xe608;</i>添加权限组</a>
        <a class="layui-btn btn-add btn-default" id="reload"><i class="layui-icon">&#xe9aa;</i></a>
    </span>
        <span class="fr">
            <form class="layui-form layui-form-pane" action="" method="get">
                <span class="layui-form-label">搜索条件：</span>
                <div class="layui-input-inline">
                    <input type="text" name="keyword" value="{{request()->get('keyword')}}" autocomplete="off" placeholder="用户组名称" class="layui-input">
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
            <th>ID</th>
            <th>权限组</th>
            <th>描述</th>
            <th>创建时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody  id="idFrom">

        @foreach($list as $key=>$vo)
            <tr>
                <td>{{$vo->id}}</td>
                <td>{{$vo->name}}</td>
                <td>{{$vo->spk}}</td>
                <td>{{$vo->create_time or '-'}}</td>
                <td>{{$vo->update_time or '-'}}</td>
                <td>
                    <a class="layui-btn layui-btn-sm layui-btn-warm" href="{{route('authority',['groupId' => $vo->id])}}" lay-event="manager">访问授权</a>
                    <a class="layui-btn layui-btn-sm layui-btn-normal" href="{{route('authorityEdit',['id' => $vo->id])}}" lay-event="manager">编辑</a>
                    <a class="layui-btn layui-btn-sm layui-btn-danger" onclick="del('{{ route('authorityDel', ['id' => $vo->id]) }}')" lay-event="del">删除</a>
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