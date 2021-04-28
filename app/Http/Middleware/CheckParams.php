<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Custom\Common\CustomCommon;

class CheckParams
{


    /**
     * 构建错误返回信息
     * $res Validator::make返回的实例
     * $result  返回值，数组。msg为简单的信息，realMsg真实信息，msgArr关联数组
     */
    public function makeErrRes ($res) {
        $str = '';
        $arr = [];
        $msgArr = $res->errors()->toArray();
        foreach ($msgArr as $key => $val) {
            $arr[$key] = $val[0];
            $str .= ($val[0] . '\n');
        }
        $str = rtrim($str, '\n');

        $result = CustomCommon::makeErrRes($str, $msgArr);
        return $result;
    }


    private function confirm_confirm ($request) {
        
        $validateData = $request->input();
        $res = Validator::make($validateData, [
            'code' => 'required|numeric',
        ]);

        if ($res->fails() !== false) return $this->makeErrRes($res);

        return true;
    }

    
    /**
     * 检索出路由名，路由名即此类的方法名，如果返回非true值就是参数错误
     * 路由名对应的方法，接收一个$request，返回true或一个数组
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName();

        if (!method_exists($this, $routeName)) return $next($request);

        $res = $this->$routeName($request);
        if ($res !== true) {
            return response()->json($res);
        }
        
        return $next($request);
    }
}
