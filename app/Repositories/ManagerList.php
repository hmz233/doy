<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/25
 * Time: 10:54
 */

namespace App\Repositories;

use App\Models\Manager as ManagerModel;
use Maatwebsite\Excel\Facades\Excel;

class ManagerList extends BaseList
{
    public static $model = ManagerModel::class;

    public function keyword($keyword)
    {
        $this->getBuilder()
            ->where('username', 'like', "%$keyword%")
            ->orWhere('name', 'like', "%$keyword%");

        return $this;
    }
}
