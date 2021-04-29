<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Http\Request;

use App\Custom\CheckLogin\CheckLogin as tCheckLogin;
use App\Custom\CheckSt\CheckSt;
use App\Custom\Common\CustomCommon;
use App\Custom\PullUserInfo\PullUserInfo;

/**
 * 检查权限
 * 1. 是否已登录，未登录跳转到SSO进行登录
 * 2. 已登录正常下一步
 */
class CheckLogin
{

    /**
     * 是否登录，未登录是否有st
     * 1. 已登录返回true
     * 2. 未登录，返回false
     * 3. 未登录，有st
     * 3-1. st有效，添加Cookie队列，返回重定向链接
     * 3-2. st无效，返回false
     * 
     * 返回 false 或重定向链接
     * 副作用：添加若干个Cookie队列
     */
    public static function checkLogin($request) {

        if (tCheckLogin::handle()) return true;

        // 未登录，删掉临时凭证
        $loggedTmpKey = config('custom.cookie.logged_tmp');
        Cookie::queue(Cookie::forget($loggedTmpKey));

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


    /**
     * 登录用户是否有管理员权限
     */
    private static function isAdmin ($userInfo) {

        if ($userInfo['isAdmin'] === true) return true;
        return false;
    }

    
    public function handle(Request $request, Closure $next)
    {

        // 是否登录
        $checkLoginRes = self::checkLogin($request);

        // 未登录，重定向到SSO
        if ($checkLoginRes === false) {
            $ssoLogin = config('custom.sso.login');
            $url = "$ssoLogin?serve=" . route('pageIndex');
            return \redirect()->away($url);
        }

        // 已登录：$request->isLogged = true
        $request->isLogged = true;

        // 返回链接，重定向，生成cookie
        if (is_string($checkLoginRes)) {

            return \redirect($checkLoginRes);
        }

        // 拉取用户信息
        $userInfo = PullUserInfo::handle();

        // 已登录：是否有管理员权限
        if (!self::isAdmin($userInfo)) {

            return \redirect()->route('forbidden');
        }

        // 有权限：下一步
        return $next($request);
    }
}
