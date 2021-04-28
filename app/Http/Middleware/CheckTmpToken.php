<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;

use Illuminate\Http\Request;

/**
 * 检查是否有本次操作的临时凭证
 * 1. 判断cookie是否有相关值，没有则跳转
 * 2. 有则下一步
 * 
 * 判断临时cookie是否存在，不存在则表示未进行二次验证
 */
class CheckTmpToken
{

    
    public function handle(Request $request, Closure $next)
    {

        // 已登录，是否有临时登录凭证
        $loggedTokenKey = \config('custom.cookie.logged_tmp');

        // 无凭证，返回邮箱验证码界面，二次验证
        if (Cookie::get($loggedTokenKey) == null) {

            return \redirect()->route('pageConfirm');
        }

        return $next($request);
    }
}
