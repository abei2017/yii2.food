define(function (require, exports, module) {

    var init = require('init');

    exports.isPay = function () {
        $('._is_pay').click(function () {
            var url = $(this).attr('data-url');
            init.confirm(url, "您确定要订单么？", true);
        });
    }

});