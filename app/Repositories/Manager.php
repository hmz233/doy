<?php

namespace App\Repositories;

use Auth;
use App\Models\Manager as ManagerModel;
use App\Models\AuthorityGroup as AuthorityModel;

/**
 * Class Base
 *
 * @package App\Repositories
 */
class Manager extends Base
{
    public static $modelName = ManagerModel::class;

    /**
     * @var ManagerModel
     */
    public $data;

    public static function getByUsername($username)
    {
        $data = ManagerModel::where('username', $username)->first();
        if (!$data) {
            return null;
        }

        return static::initByModel($data);
    }


    public static function getAutho($manager)
    {
        if (is_numeric($manager)) {
            $manager = ManagerModel::find($manager);
        }
        if ($manager->group_id == 0) {
            return '*';
        } else {
            $depInfo = AuthorityModel::select('autho')->where('id', $manager->group_id)->first();
            return explode(',', $depInfo['autho']);
        }
    }


    public function active()
    {
        $this->data->status = 1;

        return $this;
    }

    public function lowerUsername()
    {
        $this->data->username = mb_strtolower($this->data->username);

        return $this;
    }

    public function setPassword($pwd)
    {
        $this->data->setPassword($pwd);

        return $this;
    }

    public function checkPassword($pwd)
    {
        return $this->data->checkPassword($pwd);
    }

    public static function getLoginManager()
    {
        static $manager;
        if (!$manager) {
            $manager = static::initByModel(Auth::user());
        }

        return $manager;
    }

    public function handle()
    {
        if ($this->data->status == 1) {
            $this->data->status = 2;
        } else {
            $this->data->status = 1;
        }
        return $this->data->save();
    }

}
