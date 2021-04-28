<?php

return [
    'sso' => [
        'login' => env('SSO_LOGIN'),
        'regiest' => env('SSO_REGIEST'),
        'check_st' => env('SSO_CHECK_ST'),
        'check_tgc' => env('SSO_CHECK_TGC'),
        'logout' => env('SSO_LOGOUT'),
        'user_info' => env('SSO_USER_INFO'),
    ],

    'session' => [
        'user_info' => env('SESSION_USER_INFO', env('APP_NAME') . 'session_user_info_key')
    ]
];