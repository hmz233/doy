<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Authority;
use App\Repositories\Manager;

class IndexController extends Controller
{
    /**
     * 登陆成功自动会跳转到这个地方
     * 主页会默认渲染工作台work
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = [
            'menuList' => Authority::getUserMenu(Manager::getAutho($this->getManager()))
        ];
        return view('manager.index', $data);
    }

    //首页工作台
    public function work()
    {
        return view('manager.work');
    }

}
