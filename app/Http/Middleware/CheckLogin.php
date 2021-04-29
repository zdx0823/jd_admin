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


    /**
     * 登录用户是否有管理员权限
     */
    private static function isAdmin () {

        return false;
        $userSid = \config('custom.session.user_info');
        $userInfo = \session()->get($userSid);

        $level = config('custom.admin_level');

        if ($userInfo['level'] === $level) return true;

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

        // 拉取用户信息
        PullUserInfo::handle();

        // 已登录：是否有管理员权限
        if (!self::isAdmin()) {

            return \redirect()->route('forbidden');
        }

        // 有权限：返回已登录的重定向链接
        if (is_string($checkLoginRes)) {

            return \redirect($checkLoginRes);
        }

        // 有权限：下一步
        return $next($request);
    }
}
