<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    
    private static function checkCode () {
        return true;
    }


    /**
     * 验证邮箱验证码是否正确
     */
    public function confirmCode (Request $request) {

        \session()->flash('code', $request->code);
        $this->validate($request, [
            'code' => 'required',
        ]);

        // 正确重定向回首页
        if (self::checkCode()) {
            return \redirect()->route('pageIndex');
        }

        // 失败，闪存一个错误到session
        \session()->flash('codeErr', '验证码错误');
        return \back();
    }

}
