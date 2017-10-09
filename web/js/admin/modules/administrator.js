define(function(require, exports, module) {

    var init = require('init');

    /**
     * 管理员登录
     */
    exports.login = function(){
        $('#actLogin').click(function(){
            var url = $(this).attr('data-url');
            $.post(url,$('#Form').serializeArray(),function(d){
                if(d.done === true){
                    window.location.href = '/index.php?r=admin';
                }else{
                    alert(d.error);
                }
            },'json');
        });
    },

    exports.delete = function(){
        $('._delete').click(function(){
            var url = $(this).attr('data-url');
            init.confirm(url,"您确定要删除么？",true);
        });
    }

});