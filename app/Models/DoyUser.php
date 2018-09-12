<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class DoyUser extends Base
{
    use SoftDeletes;
    protected $table = 'doy_user';

    public static $sexList = [
        1 => '男',
        2 => '女',
        3 => '保密'
    ];

    public function province()
    {
        return $this->belongsTo(Area::class, 'province_id');
    }

    public function city()
    {
        return $this->belongsTo(Area::class, 'city_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function manager()
    {
        return $this->belongsTo(Manager::class,'manager_id');
    }

    public function sexText()
    {
        return isset(self::$sexList[$this->sex]) ? self::$sexList[$this->sex] : '未知';
    }

}
