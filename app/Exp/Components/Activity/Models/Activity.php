<?php

namespace App\Exp\Components\Activity\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $table = 'activity';
    protected $fillable = [
        'id',
        '_uid',
        'user_id',
        'slug',
        'activity_log',
        'event_id',
        'status',
        'updated_at',
        'created_at'
    ];
    
}
