<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class LoginAttempt extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'login_attempts';
	
	/**
     * The generate UID or not
     *
     * @var string
     *----------------------------------------------------------------------- */
    
    protected $isGenerateUID = false;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'attempts' => 'integer',
    ];

}
