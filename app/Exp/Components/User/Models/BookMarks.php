<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class BookMarks extends BaseModel
{
        protected $table = 'bookmarks';
        protected $fillable = [
    'id',
    'user_id',
    'status',
 
    
    ];
}

