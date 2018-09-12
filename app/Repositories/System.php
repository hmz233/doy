<?php

namespace App\Repositories;

use App\Models\System as SystemModel;

class System extends Base
{

    /**
     * @var SystemModel
     */
    public $data;

    public static $modelName = SystemModel::class;
}
