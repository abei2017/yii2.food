define(function(require, exports, module) {

    /**
     * 检查取餐码并且打印
     */
    exports.checkCodeThenPrint = function(){
        $('#actBtn').click(function(){
            var that = $(this);
            $.post($(this).attr('data-url'),$('#Form').serializeArray(),function(d){
                if(d.done === true){
                    that.html('验证通过，打印中');

                    var content = $('#printTpl').html();
                    var compiled = new jSmart(content);
                    var output = compiled.fetch(d);
                    //
                    var LODOP=getLodop(document.getElementById('LODOP_OB'),document.getElementById('LODOP_EM'));

                    LODOP.PRINT_INIT("Piao");
                    LODOP.SET_PRINT_PAGESIZE(3,720,0,"");
                    LODOP.ADD_PRINT_HTM("0mm","0mm","100%","100%",output);

                    LODOP.PRINT();

                    window.location.href = "/";
                }else{
                    alert(d.error);
                }
            },'json');
        });
    }
});