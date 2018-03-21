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
            if(d.done === true){
                $('#order-pay').empty().html('支付成功，开始打印。。。');
                var content = $('#printTpl').html();
                var compiled = new jSmart(content);
                var output = compiled.fetch(d);
                //
                var LODOP=getLodop(document.getElementById('LODOP_OB'),document.getElementById('LODOP_EM'));

                LODOP.PRINT_INIT("Piao");
                LODOP.SET_PRINT_PAGESIZE(3,720,0,"");
                LODOP.ADD_PRINT_HTM("0mm","0mm","100%","100%",output);

                LODOP.PREVIEW();

                window.location.href = "/";
            }else{
                setTimeout(function(){
                    exports.checkPay(d.data);
                },3000)
            }
        });
    }
});