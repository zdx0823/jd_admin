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


$(() => {

    // 显示php传递的提示
    msgPHP(util)

    let $code = $('[jshook=code]');
    let $sendCodeBtn = $('[jshook=sendCodeBtn]');

    $sendCodeBtn.on('click', function (e) {


        $.post(apiUrl.SEND_CODE).then(res => {
            const {status, msg} = util.deJson(res)

            let toastType = status === 1 ? 'success' : 'danger'
            util.toast(toastType, msg)
        })

        e.preventDefault()
        e.stopPropagation()
    })

    console.log($sendCodeBtn);

})