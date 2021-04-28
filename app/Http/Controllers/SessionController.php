<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Cookie;
use Session;
use Mail;

use App\Custom\Common\CustomCommon;


class SendEmail {

    private const SENDED_ERR = '验证码已发送，请勿重复操作';

    /**
     * 发送邮件
     * $params:  email, view, data
     * 
     * 无返回值
     */
    private static function send ($params) {

        [
            'email' => $email,
            'view' => $view,
            'data' => $data,
        ] = $params;

        $name = 'JD';
        $to = $email;
        $subject = "$name 验证码";

        Mail::send($view, $data, function ($message) use ($name, $to, $subject) {
            $message->to($to)->subject($subject);
        });
    }


    /**
     * 生成6位数的数字验证码，并保存到用户数据session中
     * 返回验证码
     */
    private static function buildCode () {
        
        $userSid = config('custom.session.user_info');
        $userInfo = session()->get($userSid);
        
        $code = \random_int(100000, 999999);
        $userInfo['code'] = [
            'code' => $code,
            'timeout' => time() + intval(\config('custom.timeout.code')),
        ];

        session([$userSid => $userInfo]);

        return $code;
    }


    /**
     * 发送有效期1分钟的6位数验证码到邮箱
     * $email 邮箱
     * 1. 如已发送，1分钟内将不再发送，并返回提示文字
     * 
     * 正常无返回值，异常返回提示文字
     */
    public static function code ($email) {

        $userSid = config('custom.session.user_info');
        $userInfo = session()->get($userSid);

        // 是否已发送
        if (
            isset($userInfo['code']) &&
            time() < $userInfo['code']['timeout']
        ) {
            return self::SENDED_ERR;
        }

        $code = self::buildCode();
        $data = compact('code');
        $view = 'email.code';

        self::send(compact(
            'email',
            'data',
            'view'
        ));
    }

}


class SessionController extends Controller
{
    public const SEND_CODE_SUCC = '验证码发送成功，请到邮箱查看';
    
    public function ssoLogout () {

        // 登出
        CustomCommon::ssoLogout($request);
        
        // 返回
        return CustomCommon::makeSuccRes();

    }


    // 发送验证码
    public function sendCode (Request $request) {

        $userSid = config('custom.session.user_info');
        $email = session()->get($userSid)['email'];

        $msg = SendEmail::code($email);

        if ($msg != null) {
            return CustomCommon::makeErrRes($msg);
        }

        return CustomCommon::makeSuccRes([], self::SEND_CODE_SUCC);
    }
}
