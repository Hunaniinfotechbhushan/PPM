<?php
/*
* UserResetPasswordRequest.php - Request file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\User\Requests;

use App\Exp\Base\BaseRequest;

class UserResetPasswordRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *-----------------------------------------------------------------------*/
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the user reset password request.
     *
     * @return bool
     *-----------------------------------------------------------------------*/
    public function rules()
    {
        return  [
			'email'	=>	'required|email',
			'password'	=>	'required|min:6|max:30',
			'password_confirmation'	=>	'required|min:6|max:30|same:password'
        ];
    }
}
