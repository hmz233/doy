<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/12/18
 * Time: 17:44
 */

namespace App\Http\Controllers\Manager;

use App\Repositories\AreaList;
use App\Repositories\DoyUserList;

class DoyUserController extends Controller
{
    public function lists()
    {
        $list = new DoyUserList();

        $keyword = $this->request->get('keyword');
        if ($keyword) {
            $list->keyword($keyword);
        }
        $sex = $this->request->get('sex');
        if($sex){
            $list->getBuilder()->where('sex',$sex);
        }

        $list->paginate();
        $list->load(['province', 'city', 'area']);
        $data = [
            'sexList' => \App\Models\DoyUser::$sexList,
            'list' => $list->getItems()
        ];
        return view('manager.doyUser.list', $data);
    }

    public function add()
    {
        $areaList = AreaList::getTree();
//        dd($areaList->getItems()->toJson());
        $data = [
            'sexList'=>\App\Models\DoyUser::$sexList,
            'areaList'=>$areaList->getItems(),
        ];
        return view('manager.doyUser.add',$data);
    }
}