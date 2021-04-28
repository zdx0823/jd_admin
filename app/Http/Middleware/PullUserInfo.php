<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Custom\PullUserInfo\PullUserInfo as tPullUserInfo;

/**
 * 使用tgc向SSO拉取该用户信息
 * 1. 调用App\Custom\PullUserInfo类的handle方法
 * 2. 执行成功将在赋值在session中
 */
class PullUserInfo
{

    public function handle(Request $request, Closure $next)
    {
        tPullUserInfo::handle();
        return $next($request);
    }
}
