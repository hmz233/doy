<?php

namespace App\Repositories;

use Auth;

/**
 * Class Base
 *
 * @package App\Repositories
 */
abstract class Base
{
    /**
     * 基本数据模型
     *
     * @var \App\Models\Base
     */
    public $data = null;

    /**
     * 基本模型名称
     *
     * @var string
     */
    public static $modelName;

    /**
     * 初始化对象
     *
     * @param $param
     * @return Base
     * @throws Exception
     */
    public static function init($param)
    {
        if (is_int($param)) {
            return static::initById($param);
        } elseif ($param instanceof static::$modelName) {
            return static::initByModel($param);
        } else {
            throw new Exception('初始化失败,错误的参数类型.', -1);
        }
    }

    /**
     * 根据id初始化
     *
     * @param $id
     * @return static
     * @throws Exception
     */
    public static function initById($id)
    {
        $model = static::$modelName;
        return static::initByModel($model::findOrFail($id));
    }




    /**
     * 根据模型对象初始化
     *
     * @param $model
     * @return static
     */
    public static function initByModel($model)
    {
        $obj = new static();
        $obj->data = $model;

        return $obj;
    }

    /**
     * 根据id获取对象
     *
     * @param $id
     * @return static
     */
    public static function getById($id)
    {
        $model = static::$modelName;
        $data = $model::find($id);
        if (!$data) {
            return null;
        }

        $obj = new static();
        $obj->data = $data;

        return $obj;
    }

    /**
     * 新建对象
     *
     * @param array $data
     * @return static
     */
    public static function create($data = [])
    {
        $model = new static::$modelName();
        $model->fill($data);

        return static::initByModel($model);
    }

    public function fill($data = [])
    {
        $this->data->fill($data);

        return $this;
    }

    /**
     * 保存数据
     *
     * @param array $data
     * @return bool
     */
    public function save($data = [])
    {
        return $this->data->fill($data)->save();
    }


    public function delete()
    {
        return $this->data->delete();
    }

    /**
     * 获取基本模型
     */
    public function getData()
    {
        return $this->data;
    }

    public function __call($method, $parameters)
    {
        $re = $this->data->$method(...$parameters);

        if (in_array($method, [])) {
            return $re;
        } else {
            return $this;
        }
    }

    public function __get($key)
    {
        return $this->data->$key;
    }

    public function __set($key, $param)
    {
        $this->data->$key = $param;

        return $this;
    }

    public function setManager($manager)
    {
        $this->data->manager_id = $manager->id;
        return $this;
    }

    public function toApi()
    {
        return $this->data->toApi();
    }
}
