const $ = require('jquery')

import util from './util'
import apiUrl from './apiUrl'
require('./common')

/**
 * 显示php传递的msg数据
 */
function msgPHP (util) {

    if (!window.PHP_DATA || !window.PHP_DATA.msg) return

    let data = window.PHP_DATA.msg
    util.toast(data.msg, data.type)
}


class SendCode {

    constructor () {

        const $btn = $('[jshook=sendCodeBtn]');
        this.timeout = 0
        this.countDownTimer = null
        this.curCountDown = 0

        $btn.html(SendCode.label)
        this.bind($btn)
    }

    // 发送请求
    send () {
       
        $.post(apiUrl.SEND_CODE).then(res => {
            const {status, msg, realMsg} = util.deJson(res)

            if (status === 1) {

                util.toast(msg, 'success')
            } else {

                util.toast(realMsg, 'danger')
            }
        }) 
    }


    // 绑定事件
    bind ($btn) {
        
        $btn.on('click', (e) => {

            e.preventDefault()
            if (Date.now() < this.timeout) return

            this.countDown($btn)
            this.timeout = Date.now() + (SendCode.timeout * 1000)
            this.send()
        })
    }


    // 按钮倒计时
    countDown ($btn) {

        this.curCountDown = SendCode.timeout
        $btn.html(`${SendCode.label} (${SendCode.timeout})`)
        this.disableCss($btn)

        clearInterval(this.countDownTimer)
        this.countDownTimer = setInterval(() => {

            let n = this.curCountDown - 1 
            this.curCountDown = n        
            if (n === 0) {
                clearInterval(this.countDownTimer)
                $btn.html(SendCode.label)
                this.usableCss($btn)
                return
            }

            $btn.html(`${SendCode.label} (${n})`)
        }, 1000)
    }


    disableCss ($btn) {
        console.log($btn);
        $btn.removeClass('hover:bg-blue-600')
        $btn.removeClass('bg-blue-500')
        $btn.removeClass('cursor-default')
        $btn.addClass('bg-gray-500')
        $btn.addClass('cursor-not-allowed')
    }


    usableCss ($btn) {
        $btn.addClass('bg-blue-500')
        $btn.addClass('hover:bg-blue-600')
        $btn.addClass('cursor-default')
        $btn.removeClass('bg-gray-500')
        $btn.removeClass('cursor-not-allowed')
    }


    /**
     * 主动发起请求
     */
    do () {
        const $btn = $('[jshook=sendCodeBtn]');
        $btn.click()
    }
}
SendCode.timeout = 60
SendCode.label = '发送验证码'




$(() => {

    // 显示php传递的提示
    msgPHP(util)

    let $code = $('[jshook=code]');

    const sendCodeIns = new SendCode()
    sendCodeIns.do()

})