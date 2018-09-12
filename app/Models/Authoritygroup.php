<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class AuthorityGroup extends Base
{
    use SoftDeletes;
    protected $table = 'authority_group';

}
