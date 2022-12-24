<?php

namespace App\Exp\Components\Event\Models;

use App\Exp\Base\BaseModel;

class Event extends BaseModel
{
        protected $table = 'events';
        protected $fillable = [
    'id',
    '_uid',
    'user_id',
    'meet_type',
    'dob',
    'title',
    'image',
    'location',
    'description',
    'status',
    
    ];
}
