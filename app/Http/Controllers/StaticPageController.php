<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    
    public function test (Request $request) {
        return view('test');
    }


    public function index (Request $request) {

        return view('index');

    }


    public function confirm (Request $request) {

        return view('confirm');

    }

}
