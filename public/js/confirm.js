(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/confirm"],{

/***/ "./resources/js/apiUrl.js":
/*!********************************!*\
  !*** ./resources/js/apiUrl.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
var prefix = 'http://localhost:8686';
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  'SEND_CODE': "".concat(prefix, "/confirm/send_code")
});

/***/ }),

/***/ "./resources/js/common.js":
/*!********************************!*\
  !*** ./resources/js/common.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

var csrfToken = jquery__WEBPACK_IMPORTED_MODULE_0___default()('meta[name="csrf-token"]').attr('content');
jquery__WEBPACK_IMPORTED_MODULE_0___default().ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': csrfToken
  }
});

/***/ }),

/***/ "./resources/js/confirm.js":
/*!*********************************!*\
  !*** ./resources/js/confirm.js ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./util */ "./resources/js/util.js");
/* harmony import */ var _apiUrl__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./apiUrl */ "./resources/js/apiUrl.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var $ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");




__webpack_require__(/*! ./common */ "./resources/js/common.js");
/**
 * ??????php?????????msg??????
 */


function msgPHP(util) {
  if (!window.PHP_DATA || !window.PHP_DATA.msg) return;
  var data = window.PHP_DATA.msg;
  util.toast(data.msg, data.type);
}

var SendCode = /*#__PURE__*/function () {
  function SendCode() {
    _classCallCheck(this, SendCode);

    var $btn = $('[jshook=sendCodeBtn]');
    this.timeout = 0;
    this.countDownTimer = null;
    this.curCountDown = 0;
    $btn.html(SendCode.label);
    this.bind($btn);
  } // ????????????


  _createClass(SendCode, [{
    key: "send",
    value: function send() {
      $.post(_apiUrl__WEBPACK_IMPORTED_MODULE_1__.default.SEND_CODE).then(function (res) {
        var _util$deJson = _util__WEBPACK_IMPORTED_MODULE_0__.default.deJson(res),
            status = _util$deJson.status,
            msg = _util$deJson.msg,
            realMsg = _util$deJson.realMsg;

        if (status === 1) {
          _util__WEBPACK_IMPORTED_MODULE_0__.default.toast(msg, 'success');
        } else {
          _util__WEBPACK_IMPORTED_MODULE_0__.default.toast(realMsg, 'danger');
        }
      });
    } // ????????????

  }, {
    key: "bind",
    value: function bind($btn) {
      var _this = this;

      $btn.on('click', function (e) {
        e.preventDefault();
        if (Date.now() < _this.timeout) return;

        _this.countDown($btn);

        _this.timeout = Date.now() + SendCode.timeout * 1000;

        _this.send();
      });
    } // ???????????????

  }, {
    key: "countDown",
    value: function countDown($btn) {
      var _this2 = this;

      this.curCountDown = SendCode.timeout;
      $btn.html("".concat(SendCode.label, " (").concat(SendCode.timeout, ")"));
      this.disableCss($btn);
      clearInterval(this.countDownTimer);
      this.countDownTimer = setInterval(function () {
        var n = _this2.curCountDown - 1;
        _this2.curCountDown = n;

        if (n === 0) {
          clearInterval(_this2.countDownTimer);
          $btn.html(SendCode.label);

          _this2.usableCss($btn);

          return;
        }

        $btn.html("".concat(SendCode.label, " (").concat(n, ")"));
      }, 1000);
    }
  }, {
    key: "disableCss",
    value: function disableCss($btn) {
      console.log($btn);
      $btn.removeClass('hover:bg-blue-600');
      $btn.removeClass('bg-blue-500');
      $btn.removeClass('cursor-default');
      $btn.addClass('bg-gray-500');
      $btn.addClass('cursor-not-allowed');
    }
  }, {
    key: "usableCss",
    value: function usableCss($btn) {
      $btn.addClass('bg-blue-500');
      $btn.addClass('hover:bg-blue-600');
      $btn.addClass('cursor-default');
      $btn.removeClass('bg-gray-500');
      $btn.removeClass('cursor-not-allowed');
    }
    /**
     * ??????????????????
     */

  }, {
    key: "do",
    value: function _do() {
      var $btn = $('[jshook=sendCodeBtn]');
      $btn.click();
    }
  }]);

  return SendCode;
}();

SendCode.timeout = 60;
SendCode.label = '???????????????';
$(function () {
  // ??????php???????????????
  msgPHP(_util__WEBPACK_IMPORTED_MODULE_0__.default);
  var $code = $('[jshook=code]');
  var sendCodeIns = new SendCode();
  sendCodeIns["do"]();
});

/***/ }),

/***/ "./resources/js/util.js":
/*!******************************!*\
  !*** ./resources/js/util.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }


window.jQuery = (jquery__WEBPACK_IMPORTED_MODULE_0___default());

__webpack_require__(/*! jquery-toast-plugin */ "./node_modules/jquery-toast-plugin/dist/jquery.toast.min.js");

__webpack_require__(/*! jquery-toast-plugin/dist/jquery.toast.min.css */ "./node_modules/jquery-toast-plugin/dist/jquery.toast.min.css"); // ??????toast??????


function toast(msg) {
  var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'info';
  var colorList = {
    success: '#059669',
    danger: '#DC2626',
    info: '#4B5563',
    warning: '#D97706'
  };
  var loaderBgList = {
    success: '#10B981',
    danger: '#EF4444',
    info: '#6B7280',
    warning: '#F59E0B'
  };
  var bgColor = colorList[type] ? colorList[type] : colorList['info'];
  var loaderBg = loaderBgList[type] ? loaderBgList[type] : loaderBgList['info'];
  jquery__WEBPACK_IMPORTED_MODULE_0___default().toast({
    text: msg,
    showHideTransition: 'fade',
    allowToastClose: true,
    hideAfter: 3000,
    stack: false,
    position: 'top-center',
    bgColor: bgColor,
    textColor: '#ffffff',
    textAlign: 'center',
    loader: true,
    loaderBg: loaderBg
  });
} // ????????????json???????????????status??????-1


function deJson(res) {
  if (_typeof(res) === 'object') return res;
  var data = {};

  try {
    data = JSON.parse(res);
  } catch (error) {
    data = {
      status: -1,
      msg: '????????????????????????'
    };
  }

  return data;
}

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  toast: toast,
  deJson: deJson
});

/***/ }),

/***/ "./node_modules/css-loader/dist/runtime/api.js":
/*!*****************************************************!*\
  !*** ./node_modules/css-loader/dist/runtime/api.js ***!
  \*****************************************************/
/***/ ((module) => {

"use strict";


/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
// eslint-disable-next-line func-names
module.exports = function (cssWithMappingToString) {
  var list = []; // return the list of modules as css string

  list.toString = function toString() {
    return this.map(function (item) {
      var content = cssWithMappingToString(item);

      if (item[2]) {
        return "@media ".concat(item[2], " {").concat(content, "}");
      }

      return content;
    }).join("");
  }; // import a list of modules into the list
  // eslint-disable-next-line func-names


  list.i = function (modules, mediaQuery, dedupe) {
    if (typeof modules === "string") {
      // eslint-disable-next-line no-param-reassign
      modules = [[null, modules, ""]];
    }

    var alreadyImportedModules = {};

    if (dedupe) {
      for (var i = 0; i < this.length; i++) {
        // eslint-disable-next-line prefer-destructuring
        var id = this[i][0];

        if (id != null) {
          alreadyImportedModules[id] = true;
        }
      }
    }

    for (var _i = 0; _i < modules.length; _i++) {
      var item = [].concat(modules[_i]);

      if (dedupe && alreadyImportedModules[item[0]]) {
        // eslint-disable-next-line no-continue
        continue;
      }

      if (mediaQuery) {
        if (!item[2]) {
          item[2] = mediaQuery;
        } else {
          item[2] = "".concat(mediaQuery, " and ").concat(item[2]);
        }
      }

      list.push(item);
    }
  };

  return list;
};

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

"use strict";


var isOldIE = function isOldIE() {
  var memo;
  return function memorize() {
    if (typeof memo === 'undefined') {
      // Test for IE <= 9 as proposed by Browserhacks
      // @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
      // Tests for existence of standard globals is to allow style-loader
      // to operate correctly into non-standard environments
      // @see https://github.com/webpack-contrib/style-loader/issues/177
      memo = Boolean(window && document && document.all && !window.atob);
    }

    return memo;
  };
}();

var getTarget = function getTarget() {
  var memo = {};
  return function memorize(target) {
    if (typeof memo[target] === 'undefined') {
      var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

      if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
        try {
          // This will throw an exception if access to iframe is blocked
          // due to cross-origin restrictions
          styleTarget = styleTarget.contentDocument.head;
        } catch (e) {
          // istanbul ignore next
          styleTarget = null;
        }
      }

      memo[target] = styleTarget;
    }

    return memo[target];
  };
}();

var stylesInDom = [];

function getIndexByIdentifier(identifier) {
  var result = -1;

  for (var i = 0; i < stylesInDom.length; i++) {
    if (stylesInDom[i].identifier === identifier) {
      result = i;
      break;
    }
  }

  return result;
}

function modulesToDom(list, options) {
  var idCountMap = {};
  var identifiers = [];

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var count = idCountMap[id] || 0;
    var identifier = "".concat(id, " ").concat(count);
    idCountMap[id] = count + 1;
    var index = getIndexByIdentifier(identifier);
    var obj = {
      css: item[1],
      media: item[2],
      sourceMap: item[3]
    };

    if (index !== -1) {
      stylesInDom[index].references++;
      stylesInDom[index].updater(obj);
    } else {
      stylesInDom.push({
        identifier: identifier,
        updater: addStyle(obj, options),
        references: 1
      });
    }

    identifiers.push(identifier);
  }

  return identifiers;
}

function insertStyleElement(options) {
  var style = document.createElement('style');
  var attributes = options.attributes || {};

  if (typeof attributes.nonce === 'undefined') {
    var nonce =  true ? __webpack_require__.nc : 0;

    if (nonce) {
      attributes.nonce = nonce;
    }
  }

  Object.keys(attributes).forEach(function (key) {
    style.setAttribute(key, attributes[key]);
  });

  if (typeof options.insert === 'function') {
    options.insert(style);
  } else {
    var target = getTarget(options.insert || 'head');

    if (!target) {
      throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
    }

    target.appendChild(style);
  }

  return style;
}

function removeStyleElement(style) {
  // istanbul ignore if
  if (style.parentNode === null) {
    return false;
  }

  style.parentNode.removeChild(style);
}
/* istanbul ignore next  */


var replaceText = function replaceText() {
  var textStore = [];
  return function replace(index, replacement) {
    textStore[index] = replacement;
    return textStore.filter(Boolean).join('\n');
  };
}();

function applyToSingletonTag(style, index, remove, obj) {
  var css = remove ? '' : obj.media ? "@media ".concat(obj.media, " {").concat(obj.css, "}") : obj.css; // For old IE

  /* istanbul ignore if  */

  if (style.styleSheet) {
    style.styleSheet.cssText = replaceText(index, css);
  } else {
    var cssNode = document.createTextNode(css);
    var childNodes = style.childNodes;

    if (childNodes[index]) {
      style.removeChild(childNodes[index]);
    }

    if (childNodes.length) {
      style.insertBefore(cssNode, childNodes[index]);
    } else {
      style.appendChild(cssNode);
    }
  }
}

function applyToTag(style, options, obj) {
  var css = obj.css;
  var media = obj.media;
  var sourceMap = obj.sourceMap;

  if (media) {
    style.setAttribute('media', media);
  } else {
    style.removeAttribute('media');
  }

  if (sourceMap && typeof btoa !== 'undefined') {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    while (style.firstChild) {
      style.removeChild(style.firstChild);
    }

    style.appendChild(document.createTextNode(css));
  }
}

var singleton = null;
var singletonCounter = 0;

function addStyle(obj, options) {
  var style;
  var update;
  var remove;

  if (options.singleton) {
    var styleIndex = singletonCounter++;
    style = singleton || (singleton = insertStyleElement(options));
    update = applyToSingletonTag.bind(null, style, styleIndex, false);
    remove = applyToSingletonTag.bind(null, style, styleIndex, true);
  } else {
    style = insertStyleElement(options);
    update = applyToTag.bind(null, style, options);

    remove = function remove() {
      removeStyleElement(style);
    };
  }

  update(obj);
  return function updateStyle(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {
        return;
      }

      update(obj = newObj);
    } else {
      remove();
    }
  };
}

module.exports = function (list, options) {
  options = options || {}; // Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
  // tags it will allow on a page

  if (!options.singleton && typeof options.singleton !== 'boolean') {
    options.singleton = isOldIE();
  }

  list = list || [];
  var lastIdentifiers = modulesToDom(list, options);
  return function update(newList) {
    newList = newList || [];

    if (Object.prototype.toString.call(newList) !== '[object Array]') {
      return;
    }

    for (var i = 0; i < lastIdentifiers.length; i++) {
      var identifier = lastIdentifiers[i];
      var index = getIndexByIdentifier(identifier);
      stylesInDom[index].references--;
    }

    var newLastIdentifiers = modulesToDom(newList, options);

    for (var _i = 0; _i < lastIdentifiers.length; _i++) {
      var _identifier = lastIdentifiers[_i];

      var _index = getIndexByIdentifier(_identifier);

      if (stylesInDom[_index].references === 0) {
        stylesInDom[_index].updater();

        stylesInDom.splice(_index, 1);
      }
    }

    lastIdentifiers = newLastIdentifiers;
  };
};

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ "use strict";
/******/ 
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["/js/vendor"], () => (__webpack_exec__("./resources/js/confirm.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);