@extends('manager.layout.master')

@section('body')
    <blockquote class="layui-elem-quote">添加成员</blockquote>

    <form class="layui-form-pane" action="" method="post">

        <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>

            <div class="layui-input-inline">
                <input type="text" name="nickname" value=""
                       placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">QQ</label>

            <div class="layui-input-inline">
                <input type="text" name="qq" value="" lay-verify="required"
                       placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">性别</label>

            <div class="layui-input-inline">
                <select name="sex" style="height:39px;width:170px;margin-right: 2px;">
                    <option value="">请选择性别</option>
                    @foreach($sexList as $k=>$v)
                        <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">居住城市</label>
            <div class="layui-input-block" id="area">
                <select name="province_id" class="province_id" data-value="" style="height:39px;width:170px;margin-right: 2px;"></select>
                <select name="city_id" class="city_id" data-value="" style="height:39px;width:170px;margin-right: 2px;"></select>
                <select name="area_id" class="area_id" data-value="" style="height:39px;width:170px;margin-right: 2px;"></select>
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
    <script src="{{ asset("admin/cx_select/jquery.cxselect.js") }}" type="text/javascript" charset="utf-8"></script>
    <script>
        $('#area').cxSelect({
            selects: ['province_id', 'city_id', 'area_id'],
            jsonName: 'areaname',
            jsonValue: 'id',
            jsonSub: 'children',
            required: false,
            firstTitle: '请选择',
            data: {!! $areaList->toJson() !!}
        });
    </script>
@stop