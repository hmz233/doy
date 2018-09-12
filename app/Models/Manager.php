<?php

namespace App\Models;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Manager extends Base implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use SoftDeletes;

    /**
     * 定义数据库表名
     *
     * @var string
     */
    protected $table = 'manager';

    protected $guarded = ['id', 'password'];

    protected $hidden = ['password', 'remember_token', 'delete_time'];


    public static $statusList=[
        1=>'正常',
        2=>'禁用'
    ];

    public function setPassword($pwd)
    {
        $this->password = Hash::make($pwd);

        return $this;
    }

    public function checkPassword($pwd)
    {
        return Hash::check($pwd, $this->password);
    }

    public function can($ability, $arguments = [])
    {
        return $this->group->allow($ability);
    }

    public function statusText()
    {
        return isset(static::$statusList[$this->status]) ?
            static::$statusList[$this->status] :
            '未知';
    }


    public function auditingInfo()
    {
        return $this->belongsTo(self::class, 'auditing_id')
            ->withDefault(['username'=>'系统生成'])
            ;
    }

    public function group()
    {
        return $this->belongsTo(AuthorityGroup::class, 'group_id')->withDefault(['name'=>'-']);
    }

}
