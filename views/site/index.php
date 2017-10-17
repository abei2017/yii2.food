<?php
use yii\helpers\Url;
$this->title = '';
use yii\widgets\ActiveForm;
?>

<div class="site-index">
    <div class="cart-box">
        <h1>购物车</h1>
        <?php
        $form = ActiveForm::begin([
            'action'=>'javascript:;',
            'id'=>'Form'
        ]);
        ?>
        <div id="cart-items" class="cart-items">

        </div>
        <?php
            ActiveForm::end();
        ?>
        <ul class="btns">
            <li data-url="<?= Url::to(['/cart/submit']);?>" id="wxBtn">微信支付</li>
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

<script id="cartItemTpl" type="text/x-jsmart-tmpl">
    <div class="item-in-cart">
        <div>{$title}</div>
        <div>
            <input type="text" name="quantity[{$id}]" value="1"/>
        </div>
    </div>
</script>

<script id="dishTpl" type="text/x-jsmart-tmpl">
    {if $data|count eq 0}
        <div class="empty">暂无菜品</div>
    {else}
        {foreach $data as $key=>$dish}
        <div class="dish _dish" data-title="{$dish.title}" data-price="{$dish.price}" data-id="{$dish.id}">
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

    seajs.use(['category','cart'],function(category,cart){
        category.dishes();
        cart.submitCart();
    });
</script>
