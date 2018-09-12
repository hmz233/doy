<div style="display: flex; justify-content: center;margin-top: 10px;">
    <div class="page" style="text-align: center">
        {{$list->appends(request()->all())->links()}}
        <br />
        <span class="count_span" style="margin-top: 2px;">
            共计：{{$list->total()}} 条 数据
        </span>
    </div>
</div>
<style>
    div ul{
        margin-bottom: 0px!important;
    }
</style>