<?php
use yii\grid\GridView;
use yii\grid\ActionColumn;
?>

<?php if($couponItem):?>
<div>
    <h1>优惠券</h1>
    <div>
        <?= $couponItem->number;?>
        <br>
        面值：<?= $couponItem->coupon->price;?>
        <br>
        优惠了<?= $couponItem->used_money;?>
    </div>
</div>
<?php endif;?>