<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class SaveFilterSerach extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'save_filter_serach';

        protected $fillable = [
        'id',
        'user_id',
        'name',
        'url',
        '_uid',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];
}
