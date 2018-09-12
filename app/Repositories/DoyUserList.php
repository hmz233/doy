<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/25
 * Time: 10:54
 */

namespace App\Repositories;

use App\Models\DoyUser as DoyUserModel;


class DoyUserList extends BaseList
{
    public static $model=DoyUserModel::class;

    public function keyword($keyword)
    {
        $this->getBuilder()
            ->where('nickname', 'like', "%$keyword%")
            ->where('qq',$keyword)
            ->where('position','like','%'.$keyword.'%');
        return $this;
    }
}
