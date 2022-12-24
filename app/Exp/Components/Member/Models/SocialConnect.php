<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class SocialConnect extends BaseModel
{
        protected $table = 'socail_login';
        protected $fillable = [
    'id',
    'name',
    'email',
    'social_type',
    '_uid',
    'user_id',
    'social_id',
    'status',
    ];
}

