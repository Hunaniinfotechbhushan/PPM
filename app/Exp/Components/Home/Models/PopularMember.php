<?php

namespace App\Exp\Components\Home\Models;

use App\Exp\Base\BaseModel;

class PopularMember extends BaseModel
{
        protected $table = 'popular_member';
        protected $fillable = [
                '_id',
                '_uid',
                'created_at',
                'updated_at',
                'status',
                'to_user_id',
                'by_user_id',
                'popular',
                'users__id',
                'moderated_by_users__id',
     
    ];
}

