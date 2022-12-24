<?php

namespace App\Exp\Components;

use App\Exp\Base\BaseController;
use Request;

class __Igniter extends BaseController
{
    /**
      * Get ac master view template
      *
      * @return void
      *---------------------------------------------------------------- */
    
    public function baseData()
    {
        return $this->processResponse(1, [], array_merge($this->prepareForBrowser(), [
            'auth_info' => getUserAuthInfo()
        ]));
    }
}