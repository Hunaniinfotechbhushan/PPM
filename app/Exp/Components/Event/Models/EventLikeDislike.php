<?php

namespace App\Exp\Components\Event\Models;

use App\Exp\Base\BaseModel;

class EventLikeDislike extends BaseModel
{
        protected $table = 'event_like_dislikes';
        protected $fillable = [
    'id',
    'user_id',
    'to_user_like',
    'by_user_like',
    'event_id',
    'created_at',
    'updated_at',
   ];
}
