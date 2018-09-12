<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2018/1/10
 * Time: 11:02
 */

namespace App\Http\Controllers;


use App\Repositories\System;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    /**
     * 跳转提示
     *
     * @msg 提示信息
     * @type success = 成功（绿） error = 警告（红）
     * @url 跳转路由别名
     * @time 等待时间 单位秒
     * @arg 路由参数
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author 穆风杰<hcy.php@qq.com>
     */
    public function index(Request $request)
    {
        $msg = $request->get('msg') ? $request->get('msg') : '抱歉，网络异常！';
        $type = $request->get('type') ? $request->get('type') : 'success';
        $url = $request->get('url') ? $request->get('url') : 'work';
        $time = $request->get('time') ? $request->get('time') : 3;
        $arg = $request->get('arg') ? $request->get('arg') : [];
        $data = [
            'msg' => $msg,
            'type' => $type,
            'url' => $url,
            'time' => $time,
            'arg' => $arg
        ];

        return view('tips', $data);
    }
}