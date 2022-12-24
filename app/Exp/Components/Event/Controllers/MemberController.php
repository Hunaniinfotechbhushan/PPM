<?php
/*
* UserController.php - Controller file
*
* This file is part of the User component.
*-----------------------------------------------------------------------------*/

namespace App\Exp\Components\Member\Controllers;

use App\Exp\Base\BaseController;
use Illuminate\Http\Request;

class MemberController extends BaseController
{


public function getUserProfile($userName)
{
    return view('member/profile-visitor');
}
}