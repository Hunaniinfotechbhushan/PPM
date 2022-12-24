<?php

namespace App\Exp\Components\Event\Models;

use App\Exp\Base\BaseModel;

class InterestedUser extends BaseModel
{
        protected $table = 'interested_user';
        protected $fillable = [
    '_id',
    'user_id',
    'by_user_interested',
    'to_user_interested',
    'event_id',
    'created_at',
    'updated_at',
    
    
    ];
}
