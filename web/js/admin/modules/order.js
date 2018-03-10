define(function (require, exports, module) {

    var init = require('init');

    exports.isPay = function () {
        $('._is_pay').click(function () {
            var url = $(this).attr('data-url');
            init.confirm(url, "您确定要付款核查么？", true);
        });
    };

    exports.close = function () {
        $('._close').click(function () {
            var url = $(this).attr('data-url');
            init.confirm(url, "您确定要关闭么？", true);
        });
    };


});