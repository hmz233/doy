<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/11/23
 * Time: 9:59
 */

namespace App\Http\Middleware;

use App\Repositories\Manager;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Authority as AuthorityController;

class Authority
{
    public $manager;

    //不需要做权限判断的路由别名
    public $exception = [
        'staffCountPrice',
        'getDepList',
        'getStationList',
        'messageNum1',
        'getDistance',
    ];

    //固定方法 前置操作 逻辑先处理 在响应
    public function handle($request, Closure $next)
    {
        if (!Session::get('menuArray')) {
            $userAuth = Manager::getAutho($this->getManager()->id);
            AuthorityController::getUserMenu($userAuth);
        }

//        || $this->getManager()->group_id === 0
        if (in_array($request->route()->getAction()['as'], $this->exception) || $this->getManager()->group_id === 0) {
            return $next($request);//不需要做权限判断的路由别名
        }

        $menuArray = Session::get('menuArray');
        if (!in_array($request->route()->getAction()['as'], $menuArray)) {
            if ($request->ajax()) {
                return $this->returnJson(2, '抱歉，您未授权访问');
            }
            return redirect()->route('tips', ['msg' => '抱歉，您未授权访问']);
        }
        return $next($request);//时间满足 正常执行
    }


    public function getManager()
    {
        if (!$this->manager) {
            $user = Auth::guard('manager')->user();
            if ($user) {
                $this->manager = Manager::initByModel($user);
            }
        }
        return $this->manager;
    }

    public function returnJson($status = 1, $message = '', $data = [])
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data]);
    }
}
