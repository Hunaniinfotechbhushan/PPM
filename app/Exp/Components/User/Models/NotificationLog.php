<?php
/*
* NotificationLog.php - Model file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\User\Models;

use App\Exp\Base\BaseModel;

class NotificationLog extends BaseModel
{
    /**
     * @var string - The database table used by the model.
     */
    protected $table = 'notifications';

    protected $fillable = ['status', 'users__id','photo_id', 'message', 'action', 'is_read','slug'];
}
