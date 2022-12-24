<?php
/*
* AbuseReportModel.php - Model file
*
* This file is part of the AbuseReport component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\AbuseReport\Models;

use App\Exp\Base\BaseModel;
use App\Exp\Components\User\Models\User;

class AbuseReportModel extends BaseModel
{
    /**
     * @var string - The database table used by the model.
     */
    protected $table = 'abuse_reports';

    /**
     * @var array - The attributes that should be casted to native types..
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer'
    ];

    /**
     * @var array - The attributes that are mass assignable.
     */
	protected $fillable = [];
	
	/**
      * Get users related to the role
      *
      * @return void
      *---------------------------------------------------------------- */
    public function reportedForUser()
    {
        return $this->hasMany(User::class, '_id', 'for_users__id');
	}

}
