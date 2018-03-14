/**
 * 菜品
 */
define(function(require, exports, module) {

    exports.buy = function(){
        $('._buy').click(function(){
            var id = $(this).attr('data-id');
            var quantity = $('#quantity-'+id).val();

            $.getJSON($(this).attr('data-url'),{quantity:quantity},function (d) {
                if(d.done === true){
                    $('#wxjs').html(d.data);
                }else{
                    alert(d.error);
                }
            });
        });
    };

    exports.upDown = function(){
        $('._dir').click(function(){
            var id = $(this).attr('data-id');
            var dir = $(this).attr('data-dir');
            var quantity = $('#quantity-'+id);
            var maxNumber = $(this).attr('data-max-number');

            if(dir === 'down'){
                // down
                if(parseInt(quantity.val()) === 1){
                    return false;
                }
                quantity.val(parseInt(quantity.val()) - 1);
            }else{
                // up
                if(maxNumber >= 0 && quantity.val() >= maxNumber){
                    alert('您最多只能买'+maxNumber+'个');
                    return false;
                }
                quantity.val(parseInt(quantity.val()) + 1);
            }

        });
    }
});