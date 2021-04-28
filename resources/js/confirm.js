const $ = require('jquery')

import util from './util'

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
})