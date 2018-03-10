define(function (require, exports, module) {
    var init = require('init');

    /**
     *
     */
    exports.deleteWechat = function(){
        $('._delete').click(function(){
            var url = $(this).attr('data-url');
            init.confirm(url,"您确定要删除么？",true);
        });
    }

});