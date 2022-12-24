<?php

namespace App\Exp\Components\Team\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $table = 'users';
        protected $fillable = [
    '_id',
    '_uid',
    'username',
    'email',
    'password',
    'first_name',
    'last_name',
    'designation',
    'heading',
    'mobile_number',
    'is_verified',
    'gender_selection',
    'interest_selection',
    'type_selection_generous',
    'timezone',
    'registered_via',
    'block_reason',
    'is_fake',
    'address',
    'role',
    'created_at'
    ];
  
}
