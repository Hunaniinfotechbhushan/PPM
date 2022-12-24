<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class UserTag extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'user_tags';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];
}
