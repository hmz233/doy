<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/25
 * Time: 10:54
 */

namespace App\Repositories;

use App\Models\System as SystemModel;


class SystemList extends BaseList
{
    public static $model=SystemModel::class;

    public function keyword($keyword)
    {
        $this->getBuilder()
            ->where('content', 'like', "%$keyword%")
        ;
        return $this;
    }
}
