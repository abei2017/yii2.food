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

            var url = $(this).attr('data-url');
            $.getJSON(url,{},function(d){
                if(d.done === false){
                    alert(d.error);
                }

                var content = $('#dishTpl').html();
                var compiled = new jSmart(content);
                var output = compiled.fetch(d);

                $('#dish-box').empty().html(output);
            });
        });
    }
});