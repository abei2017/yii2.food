<?php
use yii\helpers\Url;
$this->title = '';
?>

<div class="site-index">
    <div class="cart-box">
        <h1>购物车</h1>
        <div id="cart-items" class="cart-items">

        </div>
        <ul class="btns">
            <li>微信支付</li>
        </ul>
    </div>
    <div class="category-box" id="category-box">
        <?php foreach($cats as $cat):?>
        <ul>
            <li class="title"><?= $cat->name;?></li>
            <?php foreach($cat->children as $child):?>
            <li class="item _category" data-url="<?= Url::to(['/category/dishes','id'=>$child->id]);?>">
                <?= $child->name;?>
            </li>
            <?php endforeach;?>
        </ul>
        <?php endforeach;?>
    </div>
    <div class="dish-box" id="dish-box">

    </div>
</div>


<script id="dishTpl" type="text/x-jsmart-tmpl">
    {if $data|count eq 0}
        <div class="empty">暂无菜品</div>
    {else}
        {foreach $data as $key=>$dish}
        <div class="dish">
            <div class="title">{$dish.title}</div>
            <div class="price">
                ￥{$dish.price}
            </div>
        </div>
        {/foreach}
    {/if}
</script>

<script type="text/javascript">

    $(document).ready(function(){
        resizeLayout();
    });

    $(window).resize(function() {
        resizeLayout();
    });

    function resizeLayout(){
        var h = $(window).innerHeight();
        $('#cart-box').height(h);
        $('#category-box').height(h-30);
    };

    seajs.use(['category'],function(category){
        category.dishes();
    });
</script>
