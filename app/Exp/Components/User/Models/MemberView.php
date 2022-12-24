<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class MemberView extends BaseModel
{
        protected $table = 'member_view';
        protected $fillable = [
    '_id',
    'user_id',
    '_uid',
    'to_view_id',
    'by_view_id',
    'created_at',
    'updated_at',
 
    
    ];
}

