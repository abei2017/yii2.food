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
        <input type="hidden" id="coupon" name="coupon" value="">
        <?php
            ActiveForm::end();
        ?>
        <div class="total-money">
            合计：
            <strong id="totalMoney">0.00</strong>
        </div>
        <ul class="btns">
            <li data-url="<?= Url::to(['/cart/submit']);?>" id="wxBtn">微信支付</li>
            <li class="coupon">
                <a href="javascript:;" class="_add_coupon">优惠券</a>
            </li>
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
    <div class="dish-in-cart" id="dish-in-cart-{$id}">
        <div class="title">
        {$title}
        <span id="item-total-price-{$id}" class="item-total-price">
            {$price}
        </span>
        </div>
        <div class="quantity-box">
            <i class="down _down" data-id="{$id}">-</i>
            <input type="text" readonly id="quantity-{$id}" class="_number" data-price="{$price}" name="quantity[{$id}]" value="1"/>
            <i class="up _up" data-id="{$id}">+</i>
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
        cart.addCoupon();
    });
</script>
