<?php

namespace App\Repositories;

use App\Models\DoyUser as DoyUserModel;

class DoyUser extends Base
{
    public $data;

    public static $modelName = DoyUserModel::class;
}
