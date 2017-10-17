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

            var json = {title:title,id:id};

            var content = $('#cartItemTpl').html();
            var compiled = new jSmart(content);
            var output = compiled.fetch(json);

            $('#cart-items').append(output);
        });
    }
});