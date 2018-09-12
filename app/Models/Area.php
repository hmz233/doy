<?php
#@author 1043744868zxg@gmail.com

namespace App\Models;


class Area extends Base
{
    protected $table = 'area';

    public function children()
    {
        return $this->hasMany(static::class, 'parentid');
    }

    public function parent()
    {
        return $this->belongsTo(static::class,'parentid');
    }
}