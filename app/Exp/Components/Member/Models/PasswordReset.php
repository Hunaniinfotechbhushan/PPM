<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class PasswordReset extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'password_resets';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
}
