<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Http\Request;

use App\Custom\CheckLogin\CheckLogin as tCheckLogin;
use App\Custom\CheckSt\CheckSt;
use App\Custom\Common\CustomCommon;

/**
 * 检查权限
 * 1. 是否已登录，未登录跳转到SSO进行登录
 * 2. 已登录正常下一步
 */
class CheckLogin
{

    /**
     * 是否登录，未登录是否有st
     * 已登录返回true，st验证成功返回重定向链接
     * 未登录，且st无效返回false
     */
    private static function checkLogin($request) {

        if (tCheckLogin::handle()) return true;

        // 未登录，验证ST
        if (CheckSt::handle($request)) {
            // st存在且有效

            // 删掉st
            $uri = $request->getUri();

            // 重定向链接
            $redirectUrl = CustomCommon::delQuery($uri, ['st']);

            // 下一步
            return $redirectUrl;
        }

        return false;
    }

    
    public function handle(Request $request, Closure $next)
    {

        // 是否登录
        $checkLoginRes = self::checkLogin($request);

        // 返回重定向链接
        if (is_string($checkLoginRes)) {
            return \redirect($checkLoginRes);
        }

        // 未登录，重定向到SSO
        if ($checkLoginRes === false) {
            $ssoLogin = config('custom.sso.login');
            $url = "$ssoLogin?serve=" . route('pageIndex');
            return \redirect()->away($url);
        }

        // 已登录，下一步
        return $next($request);
    }
}
