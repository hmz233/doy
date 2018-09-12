<?php

namespace App\Repositories;

use App\Exceptions\ExceptionRepository;

use App\Models\AuthorityGroup as AuthorityModel;
use App\Models\Manager as ManagerModel;

class Authority extends Base
{

    /**
     * @var AuthorityModel
     */
    public $data;

    public static $modelName = AuthorityModel::class;



    /**
     * 获取用户组拥有权限
     *
     * @param $groupId /用户组ID
     * @return mixed
     */
    public static function getAuth($groupId)
    {
        $depInfo = AuthorityModel::select('autho')->where('id', $groupId)->first();
        return explode(',', $depInfo['autho']);
    }
}
