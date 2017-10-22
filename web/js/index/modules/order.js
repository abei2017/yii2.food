/**
 * 订单模块
 */
define(function(require, exports, module) {

    /**
     * 检测订单是否支付成功
     * @param id
     */
    exports.checkPay = function(id){
        var url = '/order-check.html';
        $.getJSON(url,{id:id},function(d){
            if(d.done == true){
                $('#order-pay').empty().html('支付成功，开始打印。。。');

            }else{
                setTimeout(function(){
                    exports.checkPay(d.data);
                },3000)
            }
        });
    }
});