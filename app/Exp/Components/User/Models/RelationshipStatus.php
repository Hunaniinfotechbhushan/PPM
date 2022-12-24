<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class RelationshipStatus extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
	protected $table = 'relationship_status';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];
}