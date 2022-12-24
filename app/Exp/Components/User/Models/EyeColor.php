<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class EyeColor extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'eye_color';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];
}
