<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Base extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    const DELETED_AT = 'delete_time';

    protected $guarded = [
        'id',
        'create_time',
        'update_time',
        'delete_time',
    ];

    protected $hidden = ['delete_time'];

    public function __construct(array $attributes = [])
    {
        if (is_array($default = $this->defaultAttributes())) {
            $attributes = array_merge($default, $attributes);
        }

        parent::__construct($attributes);
    }

    public function defaultAttributes()
    {
        return [];
    }

    public function toApi()
    {
        return $this->toArray();
    }
}
