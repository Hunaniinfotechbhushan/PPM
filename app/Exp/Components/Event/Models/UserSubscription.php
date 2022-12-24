<?php

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class UserSubscription extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_subscriptions';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        '_id'               => 'integer',
        'status'            => 'integer',
        'users__id'         => 'integer',
        'credit_wallet_transactions__id' => 'integer'
    ];

}
