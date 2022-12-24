<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{

    protected $table = 'user_profiles';
        protected $fillable = [
    '_id',
    '_uid',
    'users__id',
    'username',
    'countries__id',
    'profile_picture',
    'heading',
    'gender',
    'dob',
    'city',
    'about_me',
    'location_latitude',
    'location_longitude',
    'preferred_language',
    'relationship_status',
    'work_status',
    'education',
    'height',
    'body_type',
    'ethnicity',
    'children',
    'smoke',
    'drink',
    'hair_color',
    'net_worth',
    'income',
    'status',
    ];
  
}
