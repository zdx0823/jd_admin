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

        $isLogged = $request->isLogged;
        return view('index', compact('isLogged'));

    }


    public function confirm (Request $request) {

        // 已验证过的跳转回主页
        $loggedTmpKey = \config('custom.cookie.logged_tmp');
        if (Cookie::get($loggedTmpKey)) {

            return \redirect()->route('pageIndex');
        }

        $isLogged = $request->isLogged;
        return view('confirm', compact('isLogged'));

    }


    public function forbidden (Request $request) {

        $isLogged = $request->isLogged;
        return view('forbidden', compact('isLogged'));

    }

}
