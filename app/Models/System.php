<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Base
{
    use SoftDeletes;
    protected $table = 'system';

    public function logo()
    {
        return $this->belongsTo(File::class,'logo_id');
    }

}
