/**
 * 菜品
 */
define(function(require, exports, module) {

    /**
     * 提交购物车
     * @author abei<abei@nai8.me>
     */
    exports.submitCart = function(){
        $('#wxBtn').click(function(){
            var url = $(this).attr('data-url');
            $.post(url,$('#Form').serializeArray(),function(d){
                if(d.done == false){
                    alert(d.error);
                    return false;
                }

                //todo
            },'json');
        });
    }
});