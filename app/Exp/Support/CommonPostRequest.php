<?php
/*
* CommonPostRequest.php - Request file
*
* This file is part common support.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Support;

use App\Exp\Base\BaseRequest;

class CommonPostRequest extends BaseRequest
{

    /**
      * Set if you need form request secured.
      *------------------------------------------------------------------------ */
    protected $securedForm = true;
        
    /**
     * Authorization for request.
     *
     * @return bool
     *-----------------------------------------------------------------------*/
    public function authorize()
    {
        return true;
    }

    /**
     * Validation rules.
     *
     * @return bool
     *-----------------------------------------------------------------------*/
    public function rules()
    {
        return [];
    }
}
