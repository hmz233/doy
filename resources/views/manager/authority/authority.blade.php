@extends('manager.layout.master')

@section('style')
  <style>
      .qx_ck{
          padding-left: 5px;
          margin-bottom: -10px;
      }
      .dadui{
          overflow: hidden;
          margin-top: 10px;
      }
      .zt_div input{
          cursor: pointer;
      }
      .dadui1{
          background: #869fb1;
          color: white;
          padding: 5px;
      }
      .zhongDui{
          float: left;
          margin-left: 9px;
          margin-top: 5px;
          background: white;
          width: 160px;
      }
      .zd_p{
          background:#C1C9C9 ;
      }
  </style>
@stop

@section('body')
    <form action="" method="post" enctype="multipart/form-data">
        <!--权限主体-->
        <div class="zt_div">
            <p class="qx_ck"><input type="checkbox"/>&nbsp;全选</p>
            <!--管理组-->
                @foreach($menuList as $key=>$vo)
                <div class="dadui">
                    <div class="dadui1">
                        <input type="checkbox" name="id[]" value="{{$key}}" @if(in_array($key,$userMenu)) checked @endif  />&nbsp;{{$vo['title']}}
                    </div>
                    <!--菜单栏&功能菜单-->
                        @if(array_key_exists('_child', $vo))
                            @foreach($vo['_child'] as $k=>$v)
                                <div class="zhongDui">
                                    <!--菜单栏-->
                                    <p class="zd_p"><input type="checkbox" name="id[]" value="{{$k}}" @if(in_array($k,$userMenu)) checked @endif  />&nbsp;{{$v['title']}}</p>
                                    <!--功能-->
                                    @if(array_key_exists('_child', $v))
                                    <volist name="v.list" id="v0">
                                        @foreach($v['_child'] as $k0=>$v0)
                                        <p class="group_p"><input type="checkbox" name="id[]" value="{{$k0}}" @if(in_array($k0,$userMenu)) checked @endif />&nbsp;{{$v0['title']}}</p>
                                        @endforeach
                                    </volist>
                                    @endif
                                </div>
                            @endforeach
                         @endif
                </div>
                    @endforeach
        </div>

        <div class="layui-form-item" style="margin-top: 10px;">
            <div class="layui-input-inline">
                {{csrf_field()}}
                <button class="layui-btn" lay-submit="" lay-filter="demo1">提 交 {{request()->get('groupId')}} </button>
                <button class="layui-btn layui-btn-normal"  onclick="javascript:history.back(-1);return false;">返 回</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script type="text/javascript">
        $(function(){
            /*全选操作*/
            $('.qx_ck :checkbox').change(function(){
                var msg=$(this).prop('checked');
                $('.zt_div :checkbox').prop('checked',msg);
            });
            /*管理组选择*/
            $('.dadui1 :checkbox').change(function(){
                $(this).parent().parent().find(':checkbox').prop('checked',$(this).prop('checked'));
            });
            /*菜单栏选择*/
            $('.zd_p :checkbox').change(function(){
                /*该菜单栏选中*/
                if($(this).prop('checked')){
                    /*该菜单栏下所有功能都选中*/
                    $(this).parent().parent().find(':checkbox').prop('checked',true);
                    /*改菜单栏 所属管理组也设为选中*/
                    $(this).parent().parent().parent().find('.dadui1 :checkbox').prop('checked',true);
                }else{
                    /*该菜单栏未选中 该菜单栏下所有功能设为未选中*/
                    $(this).parent().parent().find(':checkbox').prop('checked',false);
                    /*找到该菜单栏所属管理组下所有菜单栏是否选中 判断该管理组是否该选中*/
                    var floag2=2;
                    $(this).parent().parent().parent().find('.zd_p :checkbox').each(function(){
                        /*有一个选中  则不操作 跳出循环*/
                        if($(this).prop('checked')){
                            floag2=1;return;
                        }
                    });
                    /*floag=2 则该管理组下没有任何菜单栏选中  则将该管理组 设为未选中*/
                    if(floag2==2){
                        $(this).parent().parent().parent().find('.dadui1 :checkbox').prop('checked',false);
                    }

                }

            });
            /*功能变化判断菜单栏是否需要选中*/
            $('.group_p :checkbox').change(function(){
                /*该功能选中 该菜单栏直接设为选中*/
                if($(this).prop('checked')){
                    $(this).parent().parent().find('.zd_p :checkbox').prop('checked',true);
                    /*该管理组也直接选中*/
                    $(this).parent().parent().parent().find('.dadui1 :checkbox').prop('checked',true);
                }else{
                    /*该功能不选中 找到同菜单栏中所有功能判断是否还有未选中*/
                    var floag=2;
                    $(this).parent().parent().find('.group_p :checkbox').each(function(){
                        /*有一个选中  则不操作 跳出循环*/
                        if($(this).prop('checked')){
                            floag=1;return;
                        }
                    });
                    /*floag =2 则改变改菜单栏为未选中*/
                    if(floag==2){
                        $(this).parent().parent().find('.zd_p :checkbox').prop('checked',false);
                        /*找到该管理组下所有菜单栏 判断是否有选中的菜单栏来决定该管理组是否被旋转*/
                        var floag2=2;
                        $(this).parent().parent().parent().find('.zd_p :checkbox').each(function(){
                            /*有一个选中  则不操作 跳出循环*/
                            if($(this).prop('checked')){
                                floag2=1;return;
                            }
                        });
                        /*floag=2 则该管理组下没有任何菜单栏选中  则将该管理组 设为未选中*/
                        if(floag2==2){
                            $(this).parent().parent().parent().find('.dadui1 :checkbox').prop('checked',false);
                        }
                    }
                }
            })

        });
    </script>
@stop