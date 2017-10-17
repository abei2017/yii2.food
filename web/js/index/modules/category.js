/**
 * 分类
 */
define(function(require, exports, module) {

    /**
     * 得到一个二级分类下的所有菜品
     */
    exports.dishes = function(){
        $('._category').click(function(){
            $('._category').removeClass('active');
            $(this).addClass('active');
        });
    }
});