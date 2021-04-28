<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cookie;
use Session;

use App\Custom\Common\CustomCommon;

class SessionController extends Controller
{
    
    public function ssoLogout () {

        // 登出
        CustomCommon::ssoLogout($request);
        
        // 返回
        return CustomCommon::makeSuccRes();

    }

}
