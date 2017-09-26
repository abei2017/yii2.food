define(function(require, exports, module) {

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
    }

});