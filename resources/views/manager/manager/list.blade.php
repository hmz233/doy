@extends('manager.layout.master')

@section('style')
    <style>

    </style>
@stop

@section('body')

    <blockquote class="layui-elem-quote">管理员列表</blockquote>

    <!-- 工具集 -->
    <div class="my-btn-box">
    <span class="fl">
 <a class="layui-btn btn-add btn-default" href="{{route('managerAdd')}}" id="btn-add">
     <i class="layui-icon">&#xe608;</i>添加管理</a>
        <a class="layui-btn btn-add btn-default" id="reload"><i class="layui-icon">&#xe9aa;</i></a>
    </span>
        <span class="fr">
            <form class="layui-form layui-form-pane" action="" method="get">
                <span class="layui-form-label">搜索条件：</span>
                <div class="layui-input-inline">
                    <input type="text" name="keyword" value="{{request()->get('keyword')}}" autocomplete="off" placeholder="管理员账户/姓名" class="layui-input">
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
            <th class="hidden-xs">管理员ID</th>
            <th>管理账户</th>
            <th class="hidden-xs">真实姓名</th>
            <th class="hidden-xs">用户角色</th>
            <th class="hidden-xs">账户状态</th>
            <th class="hidden-xs">添加人</th>
            <th class="hidden-xs">创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody  id="idFrom">

        @foreach($list as $key=>$vo)
            <tr>
                <td class="hidden-xs">{{$vo->id}}</td>
                <td>{{$vo->username}}</td>
                <td class="hidden-xs">{{$vo->name}}</td>
                <td class="hidden-xs">{{$vo->group->name}}</td>
                <td class="hidden-xs">{{$vo->statusText()}}</td>
                <td class="hidden-xs">{{$vo->auditingInfo->username}}</td>
                <td class="hidden-xs">{{$vo->create_time or '-'}}</td>
                <td>
                    @if($vo->id == 1)
                        <a class="layui-btn layui-btn-sm layui-btn-disabled ">停用</a>
                        <a class="layui-btn layui-btn-sm layui-btn-disabled">编辑/查看</a>
                        <a class="layui-btn layui-btn-sm layui-btn-disabled">删除</a>
                    @else
                        @if($vo->status == 2)
                            <a class="layui-btn layui-btn-sm layui-btn-warm " onclick="handle('{{route('managerHandle', ['id' => $vo->id])}}')" lay-event="edit">启用</a>
                        @else
                            <a class="layui-btn layui-btn-sm layui-btn-danger " onclick="handle('{{route('managerHandle', ['id' => $vo->id])}}')" lay-event="edit">停用</a>
                        @endif
                        <a class="layui-btn layui-btn-sm layui-btn-normal" href="{{route('managerEdit',['id' => $vo->id])}}" lay-event="edit">编辑/查看</a>
                        <a class="layui-btn layui-btn-sm layui-btn-danger" onclick="del('{{ route('managerDel', ['id' => $vo->id]) }}')" lay-event="del">删除</a>
                    @endif
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