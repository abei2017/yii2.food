/**
 * 菜品
 */
define(function(require, exports, module) {

    /**
     * 添加一个菜品到购物车
     * @author abei<abei@nai8.me>
     */
    exports.addToCart = function(){
        $('._dish').click(function(){
            var title = $(this).attr('data-title');
            var price = $(this).attr('data-price');
            var id = $(this).attr('data-id');

            var had = $('#dish-in-cart-'+id);
            if(had.css('display') != undefined){
                alert('此菜品已经在购物车内，不用再添加。');
                return false;
            }

            var json = {title:title,id:id,price:price};

            var content = $('#cartItemTpl').html();
            var compiled = new jSmart(content);
            var output = compiled.fetch(json);

            $('#cart-items').append(output);

            exports.up();
            exports.down();
            exports.doTotalMoney();
        });
    };

    exports.up = function(){
        $('._up').off().click(function(){
            var id = $(this).attr('data-id');
            var numberObj = $('#quantity-'+id);
            numberObj.val(parseInt(numberObj.val())+1);

            var price = numberObj.attr('data-price');
            $('#item-total-price-'+id).html(parseFloat(price)*numberObj.val());

            exports.doTotalMoney();
        });
    };

    exports.down = function(){
        $('._down').off().click(function(){
            var id = $(this).attr('data-id');
            var numberObj = $('#quantity-'+id);

            if(parseInt(numberObj.val()) <= 1){
                $('#dish-in-cart-'+id).remove();
            }else{
                numberObj.val(parseInt(numberObj.val())-1);
            }

            var price = numberObj.attr('data-price');
            $('#item-total-price-'+id).html(parseFloat(price)*numberObj.val());

            exports.doTotalMoney();
        });
    };

    exports.doTotalMoney = function(){
        var totalMoney = 0;
        $('._number').each(function(val){
            var money = parseFloat($(this).attr('data-price'));
            var quantity = $(this).val();
            totalMoney += money*quantity;
        });

        $('#totalMoney').html(totalMoney.toFixed(1));
    }
});