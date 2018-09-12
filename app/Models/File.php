<?php

namespace App\Models;

class File extends Base
{
    /**
     * 定义数据库表名
     *
     * @var string
     */
    protected $table = 'upload_file';

    protected $hidden = [
        'server',
        'path',
        'create_time',
        'update_time',
    ];

    public function url()
    {
        return $this->url;
    }

}
