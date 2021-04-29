<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cookie;

class StaticPageController extends Controller
{
    
    public function test (Request $request) {
        return view('test');
    }


    public function index (Request $request) {

        return view('index');

    }


    public function confirm (Request $request) {

        // 已验证过的跳转回主页
        $loggedTmpKey = \config('custom.cookie.logged_tmp');
        if (Cookie::get($loggedTmpKey)) {

            return \redirect()->route('pageIndex');
        }

        return view('confirm');

    }


    public function forbidden (Request $request) {

        return view('forbidden');

    }

}
