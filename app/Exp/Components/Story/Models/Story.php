<?php

namespace App\Exp\Components\Story\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{

    protected $table = 'story';
    protected $fillable = [
        'id',
        'users_id',
        'type',
        'file',
        'video_thumbnail',
        'view',
        'status',
        'updated_at',
        'created_at'
    ];
    
}
