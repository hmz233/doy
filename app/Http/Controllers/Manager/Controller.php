<?php

namespace App\Http\Controllers\Manager;

use App\Repositories\Manager;
use App\Repositories\System;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use Illuminate\Support\Facades\Session;

class Controller extends \App\Http\Controllers\Controller
{
    public $request;
    public $route;
    public $manager;
    public $system;
    public $type;

    public $week_array = [
        0 => '星期日',
        1 => '星期一',
        2 => '星期二',
        3 => '星期三',
        4 => '星期四',
        5 => '星期五',
        6 => '星期六',
    ];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->route = $request->route()->getAction()['as'];
        $week_time = $this->week_array[date('w', time())];
        $data = [
            'week_time' => $week_time,
            'system'=>$this->getSystem()
        ];

        return view()->share($data);
    }

    /**
     * @author xiaoze <zeasly@live.com>
     * @return Manager
     */
    public function getManager()
    {
        if (!$this->manager) {
            $user = Auth::guard('manager')->user();
            if ($user) {
                $this->manager = Manager::initByModel($user);
                $this->type = $this->manager->data->type;
            }
        }

        return $this->manager;
    }

    /**
     * @return static
     * @throws \App\Repositories\Exception
     * @author 穆风杰<hcy.php@qq.com>
     */
    public function getSystem()
    {
        if (!$this->system) {
            $system = System::initById(1);
            if ($system) {
                $this->system = System::initByModel($system);
            }
        }
        return $this->system;
    }


    public function error()
    {
        $time = Session::has('time') ? Session::get('time') : 3;
        $url = Session::has('url') ? Session::get('url') : 'work';
        $msg = Session::has('msg') ? Session::get('msg') : '抱歉！访问授权失效，请重试！';
        $data = [
            'time' => $time,
            'url' => $url,
            'msg' => $msg
        ];

        return view('manage.public.error', $data);
    }

    /**
     * 获取表格数据
     *
     * @param $filePath /表格文件路径
     * @param bool|true $is_two /是否从第二行开始 默认从第二行考试
     * @return array|null /返回获得的二维数组
     */
    public function importExcel($filePath, $is_two = true)
    {
        //$filePath = 'upload/' . iconv('UTF-8', 'GBK', 'test') . '.xls';//将文件转码
        $results = null;
        Excel::load(
            $filePath,
            function ($reader) use (&$results) {
                $reader = $reader->getSheet(0);
                //获取表中的数据
                $results = $reader->toArray();
            }
        );
        if ($is_two && $results) {
            unset($results[0]);
            $results = array_values($results);
        }

        return $results;
    }


    /**
     * 计算两个坐标之间的距离
     * @param $lng1lat1 @坐标1 30.635890,103.979360
     * @param $lng2lat2 @坐标2 30.616310,103.909970
     * @param bool|false $miles true 返回m false 返回km
     * @return float 返回距离
     */
    public function distance($lng1lat1, $lng2lat2, $miles = false)
    {
        $pi80 = M_PI / 180;
        $lng1lat1 = explode(',', $lng1lat1);
        $lng1 = $lng1lat1[1];
        $lat1 = $lng1lat1[0];
        $lng2lat2 = explode(',', $lng2lat2);
        $lng2 = $lng2lat2[1];
        $lat2 = $lng2lat2[0];
        $lat1 *= $pi80;
        $lng1 *= $pi80;
        $lat2 *= $pi80;
        $lng2 *= $pi80;
        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;
        $km = round($km, 2);//保留两位精度
        return ($miles ? ($km * 1000) : $km);
    }

}
