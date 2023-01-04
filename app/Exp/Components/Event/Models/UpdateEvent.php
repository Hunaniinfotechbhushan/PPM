<?php

namespace App\Exp\Components\Event\Models;

use App\Exp\Base\BaseModel;
use App\Exp\Components\User\Models\User;

class UpdateEvent extends BaseModel
{
        protected $table = 'event_update';

        public function user()
        {
            return $this->hasMany(User::class, '_id', 'user_id');
        }
}
