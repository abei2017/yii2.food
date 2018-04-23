/**
 * 菜品
 */
define(function(require, exports, module) {

    /**
     * 提交购物车
     * @author abei<abei@nai8.me>
     */
    exports.submitCart = function(){
        $('._payBtn').click(function(){
            var url = $(this).attr('data-url');
            $.post(url,$('#Form').serializeArray(),function(d){
                if(d.done == false){
                    alert(d.error);
                    return false;
                }
                window.location.href = d.data;


            },'json');
        });
    };

    /**
     * 添加优惠券
     */
    exports.addCoupon = function(){
        $('._add_coupon').click(function(){
            var v = prompt("请输入您的优惠券编码","");
            $('#coupon').val(v);
        });
    }
});