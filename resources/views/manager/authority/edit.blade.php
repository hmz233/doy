@extends('manager.layout.master')

@section('body')
    <blockquote class="layui-elem-quote">编辑角色组</blockquote>

    <form class="layui-form layui-form-pane" action="" method="post">



        <div class="layui-form-item">
            <label class="layui-form-label">角色组名称</label>
            <div class="layui-input-inline">
                <input type="text" name="name" value="{{old('name') ? old('name') : $info->data->name}}" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text" style="width: 300px;">
            <label class="layui-form-label">描述</label>
            <div class="layui-input-block">
                <textarea name="spk" placeholder="请输入描述内容" class="layui-textarea">{{old('spk') ? old('spk') : $info->data->spk}}</textarea>
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-inline">
                {{csrf_field()}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提 交</button>
                <button class="layui-btn layui-btn-normal"  onclick="javascript:history.back(-1);return false;">返 回</button>
            </div>
        </div>

    </form>
@stop



@section('js')

    <script>
    </script>

@stop