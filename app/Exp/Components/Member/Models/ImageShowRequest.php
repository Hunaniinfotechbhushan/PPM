<?php

namespace App\Exp\Components\Member\Models;

use App\Exp\Base\BaseModel;
use App\Exp\Components\UserSetting\Models\UserPhotosModel;
use App\Exp\Components\User\Models\User;

class ImageShowRequest extends BaseModel
{
    protected $table = 'image_show_request';

    public function userPhotos()
    {
        return $this->hasMany(UserPhotosModel::class, 'users__id', 'reciver_id')->where('type','2')->where('is_verified','1');
    }

    public function users()
    {
        return $this->hasMany(User::class, '_id', 'sender_id');
    }
}

