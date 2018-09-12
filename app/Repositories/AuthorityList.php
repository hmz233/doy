<?php

namespace App\Repositories;

use App\Models\AuthorityGroup as AuthorityModel;

/**
 * Class LineList
 *
 * @package App\Repositories
 */
class AuthorityList extends BaseList
{

    public static $model = AuthorityModel::class;

    public function keyword($keyword)
    {
        $this->getBuilder()
            ->where('name', 'like', "%$keyword%")
            ->orWhere('id', 'like', "%$keyword%")
        ;

        return $this;
    }

}
