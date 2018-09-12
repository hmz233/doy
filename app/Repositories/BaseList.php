<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\ExceptionRepository;

abstract class BaseList
{
    /**
     * @var Collection|null|\Illuminate\Pagination\LengthAwarePaginator
     */
    protected $items;

    /**
     * @var \Illuminate\Database\Query\Builder
     */
    protected $builder;


    public static $model;

    /**
     * @param $items
     * @return static
     */
    public static function initByItems($items)
    {
        $obj = new static();
        $obj->items = $items;

        return $obj;
    }

    public static function initByBuilder($builder)
    {
        $obj = new static();
        $obj->builder = $builder;

        return $obj;
    }

    /**
     * @param bool $new
     * @return \Illuminate\Database\Query\Builder
     */
    public function getBuilder($new = false)
    {
        if ($new || $this->builder == null) {
            $model = static::$model;
            $this->builder = $model::query();
        }

        return $this->builder;
    }

    protected function defaultOrderBy()
    {
        return $this->getBuilder()->orderBy('id', 'desc');
    }


    /**
     * @param array $where
     * @param int $pagesize
     * @param string $pageName
     * @param null $page
     * @return static
     */
    public static function getList($where = [], $pagesize = 15, $pageName = null, $page = null)
    {
        $obj = new static();
        $obj->where($where);

        if (is_null($pageName)) {
            $pageName = 'page';
        }
        $obj->paginate($pagesize, $pageName, $page);

        return $obj;
    }



    public static function getAll($where = [], $builder = null)
    {
        $obj = new static();
        $obj->where($where);

        if ($builder instanceof \Closure) {
            $builder($obj->getBuilder());
        }

        $obj->all();

        return $obj;
    }

    public function paginate($pagesize = 15, $pageName = 'page', $page = null)
    {
        $this->defaultOrderBy();
        $this->items = $this->getBuilder()->paginate($pagesize, ['*'], $pageName, $page);

        return $this;
    }

    public function all()
    {
        $this->defaultOrderBy();
        $this->items = $this->getBuilder()->get();

        return $this;
    }


    public function load($relations)
    {
        return $this->getItems()->load(...func_get_args());
    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator|Collection
     */
    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    public function __call($method, $parameters)
    {
        $re = $this->getBuilder()->$method(...$parameters);

        if (in_array($method, ['count'])) {
            return $re;
        } else {
            return $this;
        }
    }


    public static function __callStatic($method, $parameters)
    {
        $obj = new static;
        $re = $obj->$method(...$parameters);

        if (in_array($method, [])) {
            return $re;
        } else {
            return $obj;
        }
    }

    public function toApi()
    {
        $re = [];
        foreach ($this->getItems() as $v) {
            $re[] = $v->toApi();
        }

        return $re;
    }

}
