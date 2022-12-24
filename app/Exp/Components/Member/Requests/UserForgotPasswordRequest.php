<?php

/*
* UserLoginRequest.php - Request file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\User\Requests;

use App\Exp\Base\BaseRequest;

class UserForgotPasswordRequest extends BaseRequest 
{	
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
		return  [
            'email' => 'required|email'
		];
    }
}