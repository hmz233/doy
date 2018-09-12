@extends('manager.layout.master')

@section('body')
    <blockquote class="layui-elem-quote">新增管理</blockquote>

    <form class="layui-form layui-form-pane" action="" method="post">

        <div class="layui-form-item">
            <label class="layui-form-label">真实名</label>

            <div class="layui-input-inline">
                <input type="text" name="name" value="{{old('name')}}"
                       placeholder="请输入" autocomplete="off" class="layui-input">
                <div style="color:red">{{$errors->first('name')}}</div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">登录名</label>

            <div class="layui-input-inline">
                <input type="text" name="username" value="{{old('username')}}" lay-verify="required"
                       placeholder="请输入" autocomplete="off" class="layui-input">
                <div style="color:red">{{$errors->first('username')}}</div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">登录密码</label>

            <div class="layui-input-inline">
                <input type="text" name="password" value="{{old('password')}}" lay-verify="required"
                       placeholder="请输入" autocomplete="off" class="layui-input">
                <div style="color:red">{{$errors->first('password')}}</div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>

            <div class="layui-input-inline">
                <input type="text" name="password_confirmation" value="{{old('password_confirmation')}}" lay-verify="required"
                       placeholder="请再次确认密码" autocomplete="off" class="layui-input">
                <div style="color:red">{{$errors->first('password_confirmation')}}</div>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">用户角色</label>
            <div class="layui-input-inline">
                <select name="group_id">
                    <option value="">选择用户角色</option>
                    @foreach($groupList as $key=>$vo)
                        <option value="{{$vo->id}}" @if(old('group_id') == $vo->id) selected @endif>{{$vo->name}}</option>
                    @endforeach
                </select>
                <div style="color:red">{{$errors->first('group_id')}}</div>
            </div>
        </div>



        <div class="layui-form-item">
            <div class="layui-input-inline">
                {{csrf_field()}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">添 加</button>
                <button class="layui-btn layui-btn-normal" onclick="javascript:history.back(-1);return false;">返 回
                </button>
            </div>
        </div>

    </form>
@stop



@section('js')

    <script>

    </script>

@stop