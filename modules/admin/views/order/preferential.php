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


<?php if($upoff):?>
    <div>
        <h1>满减</h1>
        <div>
            <?= $upoff->money;?>
            <br>
            <?php
            $info = \yii\helpers\Json::decode($upoff->info);
            ?>
            <br>
            满<?= $info['up_money'];?>减<?= $info['off_money'];?>
        </div>
    </div>
<?php endif;?>
