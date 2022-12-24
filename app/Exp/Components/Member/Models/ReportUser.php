<?php

namespace App\Exp\Components\Member\Models;

use App\Exp\Base\BaseModel;

class ReportUser extends BaseModel
{
        protected $table = 'abuse_reports';
        protected $fillable = [
                '_id',
                '_uid',
                'created_at',
                'updated_at',
                'status',
                'for_users__id',
                'by_users__id',
                'reason',
                'moderator_remarks',
                'moderated_by_users__id',
     
    ];
}

